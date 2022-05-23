<?php

namespace App\Http\Controllers\Storefront;

use DB;
use Auth;
use App\Cart;
use App\Shop;
use App\User;
use App\Order;
use App\Account;
use App\Customer;
use Paypalpayment;
use App\Helpers\Twilio;
use Instamojo\Instamojo;
use App\Helpers\Payments;
use App\Helpers\Messaging;
use Illuminate\Http\Request;
use App\Events\Order\OrderPaid;
use App\Events\Order\OrderCreated;
use App\Http\Controllers\Controller;
use App\Exceptions\AuthorizeNetException;
use App\Http\Requests\Validations\OrderDetailRequest;
use net\authorize\api\contract\v1 as AuthorizeNetAPI;
use App\Http\Requests\Validations\CheckoutCartRequest;
use App\Http\Requests\Validations\CheckoutAllCartRequest;
use net\authorize\api\controller as AuthorizeNetController;
use App\Http\Requests\Validations\ConfirmGoodsReceivedRequest;
use App\Notifications\Auth\SendVerificationEmail as EmailVerificationNotification;

class OrderController extends Controller
{
    /**
     * Checkout the specified cart.
     *
     * @param \Illuminate\Http\Request $request
     * @param Cart $cart
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CheckoutCartRequest $request, Cart $cart)
    {
        $customer_id = $cart->customer_id;
        $mobile_number = $request->phone;

        $order = $this->createOrder($request, $cart);

        $this->afterCheckout([$order], $order->grand_total, $mobile_number, $customer_id, $order->paymentMethod, 0);

        return redirect()->route('order.success', $order)->with('success', trans('theme.notify.order_placed'));
    }

    public function checkoutAllOrders(CheckoutAllCartRequest $request)
    {
        // dd($request->all());
        $mobile_number = $request->phone;
        $customer_id = null;

        $carts = Cart::where('ip_address', $request->ip())->get();

        $orders = [];
        $total_order_amount = 0;
        $paymentMethod = null;
        foreach ($carts as $cart) {
            $owner = $cart->shop->owner;
            $orderInventory = $cart->inventories->where('customer_points_discount_percentage')->first();
            if (!$customer_id) {
                $customer_id = $cart->customer_id;
            }

            $discount = 0;
            if ($request->payment_points && $owner->service_merchant && $orderInventory) {
                $customer = Customer::find($customer_id);
                $discount = $customer->points;
                $maximDiscount = round(($orderInventory->customer_points_discount_percentage / 100) * $cart->total);
                if (!($discount <= $maximDiscount)) {
                    // $total_order_amount -= $cart->total - $maximDiscount;
                    $discount = $maximDiscount;

                    $customer->update(['points' => $customer->points - $discount]);
                }
            }
            // dd($discount, $total_order_amount, $maximDiscount);
            $order = $this->createOrder($request, $cart, $discount);
            $orders[] = $order;
            $total_order_amount += $order->grand_total;
            if (!$paymentMethod) {
                $paymentMethod = $order->paymentMethod;
            }
        }

        $this->afterCheckout($orders, $total_order_amount, $mobile_number, $customer_id, $paymentMethod, $discount);

        return redirect()->route('order.success', $orders[0])->with('success', trans('theme.notify.order_placed'));
    }

    public function createOrder(Request $request, Cart $cart, $discount = 0)
    {
        if ($request->email && $request->has('create-account') && $request->password) {
            $customer = $this->createNewCustomer($request);
            $request->merge(['customer_id' => $customer->id]); //Set customer_id
        }

        crosscheckAndUpdateOldCartInfo($request, $cart);

        // Get shipping address
        if (is_numeric($request->ship_to)) {
            $address = \App\Address::find($request->ship_to)->toString(true);
        } else {
            $address = get_address_str_from_request_data($request);
        }

        // Push shipping address into the request
        $request->merge(['shipping_address' => $address]);

        // Start transaction!
        DB::beginTransaction();

        // echo "yes"; exit;
        try {
            // Create the order
            $order = saveOrderFromCart($request, $cart, $discount);
        } catch (\Exception $e) {
            \Log::error($e);        // Log the error

            DB::rollback();         // rollback the transaction and log the error

            // Set error messages:
            if (
                $e instanceof \Stripe\Error\Base ||
                $e instanceof \Yabacon\Paystack\Exception\ApiException ||
                $e instanceof AuthorizeNetException
            ) {
                \Log::error('Payment failed:: ' . $e->getMessage());
                $error = trans('theme.notify.invalid_request');
            } else {
                $error = trans('theme.notify.order_creation_failed');
            }

            return redirect()->back()->with('error', $error)->withInput();
        }

        DB::commit();           // Everything is fine. Now commit the transaction

        $cart->forceDelete();   // Delete the cart

        // Decrease the stock of the order items from the listing
        // $this->syncInventory($order);

        event(new OrderCreated($order));   // Trigger the Event

        return $order;
    }

    public function afterCheckout($orders, $total_order_amount, $phone, $customer_id, $paymentMethod, $discount)
    {
        $customer = Customer::find($customer_id);

        $points = round((5 / 100) * $total_order_amount);
        $mobile_number = $phone;

        if ($customer) {
            $customer->update(['points' => $customer->points + $points]);
            if (!$mobile_number) {
                $mobile_number = $customer->stripe_id;
            }
        }

        $method = Account::TYPE_CASH;
        if ('paypal-express' == optional($paymentMethod)->code) {
            $response = json_decode(Payments::stkPush($mobile_number, $orders[0]->order_number, $total_order_amount));
            foreach ($orders as $order) {
                $order->checkout_request_id = $response->CheckoutRequestID;
                $order->merchant_request_id = $response->MerchantRequestID;
                $order->save();
            }
            $method = Account::TYPE_MPESA;
        }

        $order_numbers = '[';
        foreach ($orders as $order) {
            $order_numbers = $order_numbers . $order->order_number . ',';
        }
        $order_numbers = rtrim($order_numbers, ',');
        $order_numbers .= ']';

        // send message to customer
        $message = "Thank you for choosing us. Your orders $order_numbers have been successfully placed and delivery is due within an hour";
        Messaging::sendMessage($mobile_number, $message);

        // Send messages to Merchants for both cash and m-pesa transactions

        if ($method == Account::TYPE_CASH) {
            foreach ($orders as $order) {
                // Is a COD order so mark as paid
                $order->payment_status = Order::PAYMENT_STATUS_PAID;
                $order->save();

                // Update account details for the records
                $shopId = $order->shop;
                if ($shopId) {
                    // Save a +ve account
                    $account = new Account();
                    $account->fill([
                        'user_id' => $shopId->owner_id,
                        'amount' => $order->grand_total,
                        'order_id' => $order->id,
                        'type' => Account::TYPE_CASH,
                    ]);
                    $account->save();
                    $discount = 0;
                }

                // send message to merchant
                $owner = null;
                $shops = Shop::where('id', $order->shop_id)->get();
                if ($shops && count($shops) > 0) {
                    $owners = User::where('id', $shops[0]->owner_id)->get();
                    if ($owners && count($owners) > 0) {
                        $owner = $owners[0];
                    }
                }

                if ($owner) {
                    $shipping_address = $order->shipping_address;
                    $message = "Cash on delivery order [$order->order_number] $shipping_address";
                    Messaging::sendMessage($owner->mobile, $message);

                    // Send whatsapp notification

                    $clientNumber = Twilio::formatPhoneNumber($owner->mobile);
                    $view = \View::make('admin.mail.order.merchant_order_created_notification', ['url' => url('admin.order.order.show', $order->id), 'order' => $order]);
                    $whatsapp_message = $view->render();
                    Twilio::sendMaytapiMessage($clientNumber, $whatsapp_message);
                }
            }
        }
    }

    public function stripSpaces($str)
    {
        return preg_replace('/\s+/', '', $str);
    }

    public static function starts_with($haystack, $needle)
    {
        // search backwards starting from haystack length characters from the end
        return $needle === '' || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

    /**
     * Charge using Stripe.
     *
     * @param \Illuminate\Http\Request $request
     * @param Order $order
     *
     * @return [type]
     */
    // private function chargeWithStripe($request, Order $order)
    // {
    //     // Get stripe user id for the connected stripe account of the vendor
    //     $vendorStripeAccountId = $order->shop->stripe->stripe_user_id;

    //     // If the stripe is not cofigured
    //     if( ! $vendorStripeAccountId )
    //         return redirect()->back()->with('success', trans('theme.notify.payment_method_config_error'))->withInput();

    //     // Get customer
    //     if(Auth::guard('customer')->check())
    //         $customer = Auth::guard('customer')->user();

    //     \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

    //     if ('saved_card' == $request->payment_method) {  // Charge old card
    //         // Create stripe token
    //         $token = \Stripe\Token::create([
    //           "customer" => $customer->stripe_id,
    //         ], ["stripe_account" => $vendorStripeAccountId]);

    //         $stripeToken = $token->id;
    //     }
    //     else if ($request->has('cc_token')){    // This is a new card with stripe token

    //         if ($request->has('remember_the_card')) {  // Create Stripe Customer for future use
    //             $stripeCustomer = \Stripe\Customer::create([
    //                 'email' => $customer->email,
    //                 'source' => $request->cc_token,
    //             ]);

    //             // Save cart info for future use
    //             $customer->stripe_id = $stripeCustomer->id;
    //             if ( count($stripeCustomer->sources->data) > 0 ) {
    //                 $customer->card_brand = $stripeCustomer->sources->data[0]->brand;
    //                 $customer->card_holder_name = $stripeCustomer->sources->data[0]->name;
    //                 $customer->card_last_four = $stripeCustomer->sources->data[0]->last4;
    //             }
    //             $customer->save();

    //             // Create stripe token
    //             $token = \Stripe\Token::create([
    //               "customer" => $customer->stripe_id,
    //             ], ["stripe_account" => $vendorStripeAccountId]);

    //             $stripeToken = $token->id;
    //         }
    //         else {      // Just charge the new card (Don't save)
    //             $stripeToken = $request->cc_token;
    //         }
    //     }

    //     // Get calculated application fee for the order
    //     $application_fee = getPlatformFeeForOrder($order);

    //     return \Stripe\Charge::create([
    //         'amount' => get_cent_from_doller($order->grand_total),
    //         'currency' => get_currency_code(),
    //         'description' => trans('app.purchase_from', ['marketplace' => get_platform_title()]),
    //         'source' => $stripeToken,
    //         'application_fee' => get_cent_from_doller($application_fee),
    //         'metadata' => [
    //             'order_number' => $order->order_number,
    //             'shipping_address' => $order->shipping_address,
    //             'buyer_note' => $order->buyer_note
    //         ],
    //     ], ["stripe_account" => $vendorStripeAccountId]);
    // }

    private function chargeWithStripe($request, Order $order)
    {
        // Get stripe user id for the connected stripe account of the vendor
        $vendorStripeAccountId = $order->shop->stripe->stripe_user_id;

        // If the stripe is not cofigured
        if (!$vendorStripeAccountId) {
            return redirect()->back()->with('success', trans('theme.notify.payment_method_config_error'))->withInput();
        }

        $stripeToken = null;

        // // Get customer
        // if(Auth::guard('customer')->check())
        //     $customer = Auth::guard('customer')->user();

        // \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        // if ('saved_card' == $request->payment_method) {  // Charge old card
        //     // Create stripe token
        //     $token = \Stripe\Token::create([
        //       "customer" => $customer->stripe_id,
        //     ], ["stripe_account" => $vendorStripeAccountId]);

        //     $stripeToken = $token->id;
        // }
        // else if ($request->has('cc_token')){    // This is a new card with stripe token

        //     if ($request->has('remember_the_card')) {  // Create Stripe Customer for future use
        //         $stripeCustomer = \Stripe\Customer::create([
        //             'email' => $customer->email,
        //             'source' => $request->cc_token,
        //         ]);

        //         // Save cart info for future use
        //         $customer->stripe_id = $stripeCustomer->id;
        //         if ( count($stripeCustomer->sources->data) > 0 ) {
        //             $customer->card_brand = $stripeCustomer->sources->data[0]->brand;
        //             $customer->card_holder_name = $stripeCustomer->sources->data[0]->name;
        //             $customer->card_last_four = $stripeCustomer->sources->data[0]->last4;
        //         }
        //         $customer->save();

        //         // Create stripe token
        //         $token = \Stripe\Token::create([
        //           "customer" => $customer->stripe_id,
        //         ], ["stripe_account" => $vendorStripeAccountId]);

        //         $stripeToken = $token->id;
        //     }
        //     else {      // Just charge the new card (Don't save)
        //         $stripeToken = $request->cc_token;
        //     }
        // }

        //dd($request);die;

        // Get calculated application fee for the order
        $application_fee = getPlatformFeeForOrder($order);

        return \Stripe\Charge::create([
            'amount' => get_cent_from_doller($order->grand_total),
            'currency' => get_currency_code(),
            'description' => trans('app.purchase_from', ['marketplace' => get_platform_title()]),
            'source' => $stripeToken,
            'application_fee' => get_cent_from_doller($application_fee),
            'metadata' => [
                'order_number' => $order->order_number,
                'shipping_address' => $order->shipping_address,
                'buyer_note' => $order->buyer_note,
            ],
        ], ['stripe_account' => $vendorStripeAccountId]);
    }

    /**
     * [chargeWithInstamojo description].
     *
     * @param  [type] $request [description]
     * @param Order $order [description]
     * @param Cart $cart [description]
     *
     * @return [type]          [description]
     */
    private function chargeWithInstamojo($request, Order $order, Cart $cart)
    {
        // Get the vendor configs
        $vendorInstamojoConfig = $order->shop->instamojo;
        // If the stripe is not cofigured
        if (!$vendorInstamojoConfig) {
            return redirect()->back()->with('success', trans('theme.notify.payment_method_config_error'))->withInput();
        }

        $instamojoApi = new Instamojo(
            $vendorInstamojoConfig->api_key,
            $vendorInstamojoConfig->auth_token,
            $vendorInstamojoConfig->sandbox == 1 ? 'https://test.instamojo.com/api/1.1/' : null
        );

        try {
            $response = $instamojoApi->paymentRequestCreate([
                'purpose' => trans('theme.order_id') . ': ' . $order->order_number,
                'amount' => number_format($order->grand_total, 2),
                'buyer_name' => Auth::guard('customer')->check() ?
                    Auth::guard('customer')->user()->getName() : $request->address_title,
                'send_email' => true,
                'email' => Auth::guard('customer')->check() ?
                    Auth::guard('customer')->user()->email : $request->email,
                'phone' => Auth::guard('customer')->check() ? '' : $request->phone,
                'redirect_url' => route('instamojo.redirect', ['order' => $order, 'cart' => $cart]),
            ]);

            // $response = $instamojoApi->paymentRequestStatus($response['id']);
            // print_r($response);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        // redirect to page so User can pay
        header('Location: ' . $response['longurl']);
        exit();
    }

    /**
     * [instamojoRedirect description].
     *
     * @param Request $request [description]
     * @param  [type]  $order   [description]
     * @param  [type]  $cart    [description]
     *
     * @return [type]           [description]
     */
    public function instamojoSuccess(Request $request, $order, $cart)
    {
        if ($request->payment_status != 'Credit' || !$request->has('payment_request_id') || !$request->has('payment_id')) {
            return redirect()->route('payment.failed', $order);
        }

        if (!$order instanceof Order) {
            $order = Order::find($order);
        }

        // Delete the cart
        Cart::find($cart)->forceDelete();   // Delete the cart

        // Order has been paided
        $this->markOrderAsPaid($order);

        // Decrease the stock of the order items from the listing
        // $this->syncInventory($order);

        event(new OrderCreated($order));   // Trigger the Event

        return redirect()->route('order.success', $order)->with('success', trans('theme.notify.order_placed'));
    }

    /**
     * [chargeWithAuthorizeNet description].
     *
     * @param  [type] $request [description]
     * @param Order $order [description]
     *
     * @return [type]          [description]
     */
    private function chargeWithAuthorizeNet($request, Order $order)
    {
        // Get the vendor configs
        $vendorAuthorizeNetConfig = $order->shop->authorizeNet;
        // If the stripe is not cofigured
        if (!$vendorAuthorizeNetConfig) {
            return redirect()->back()->with('success', trans('theme.notify.payment_method_config_error'))->withInput();
        }

        // Common setup for API credentials
        $merchantAuthentication = new AuthorizeNetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($vendorAuthorizeNetConfig->api_login_id);
        $merchantAuthentication->setTransactionKey($vendorAuthorizeNetConfig->transaction_key);
        $refId = 'ref' . time();

        // Create the payment data for a credit card
        $creditCard = new AuthorizeNetAPI\CreditCardType();
        $creditCard->setCardNumber($request->cnumber);
        // $creditCard->setExpirationDate( "2038-12");
        $expiry = $request->card_expiry_year . '-' . $request->card_expiry_month;
        $creditCard->setExpirationDate($expiry);
        $paymentOne = new AuthorizeNetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create a transaction
        $transactionRequestType = new AuthorizeNetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType('authCaptureTransaction');
        $transactionRequestType->setAmount(get_formated_decimal($order->grand_total));
        $transactionRequestType->setPayment($paymentOne);
        $ApiRequest = new AuthorizeNetAPI\CreateTransactionRequest();
        $ApiRequest->setMerchantAuthentication($merchantAuthentication);
        $ApiRequest->setRefId($refId);
        $ApiRequest->setTransactionRequest($transactionRequestType);
        $controller = new AuthorizeNetController\CreateTransactionController($ApiRequest);
        $response = $controller->executeWithApiResponse(
            $vendorAuthorizeNetConfig->sandbox == 1 ?
                \net\authorize\api\constants\ANetEnvironment::SANDBOX :
                \net\authorize\api\constants\ANetEnvironment::PRODUCTION
        );

        if ($response != null) {
            $tresponse = $response->getTransactionResponse();
            if (($tresponse != null) && ($tresponse->getResponseCode() == '1')) { // Approved
                \Log::info('Charge Credit Card AUTH CODE : ' . $tresponse->getAuthCode() . "\n");
                \Log::info('Charge Credit Card TRANS ID  : ' . $tresponse->getTransId() . "\n");

                return true;
            } else {
                $errMsg = $tresponse == null ? trans('theme.notify.invalid_request') : $tresponse->getErrors()[0]->getErrorText();
                throw new AuthorizeNetException($errMsg);

                return false;
            }
        }

        \Log::error('AuthorizeNetException:: Charge Credit Card Null response returned');

        throw new AuthorizeNetException(trans('theme.notify.payment_failed'));

        return false;
    }

    /**
     * [chargeWithPaystack description].
     *
     * @param  [type] $request [description]
     * @param Order $order [description]
     * @param Cart $cart [description]
     *
     * @return [type]          [description]
     */
    private function chargeWithPaystack($request, Order $order, Cart $cart)
    {
        // Get the vendor configs
        $vendorPaystackConfig = $order->shop->paystack;
        // If the stripe is not cofigured
        if (!$vendorPaystackConfig) {
            return redirect()->back()->with('success', trans('theme.notify.payment_method_config_error'))->withInput();
        }

        $paystack = new \Yabacon\Paystack($vendorPaystackConfig->secret);
        $tranx = $paystack->transaction->initialize([
            'email' => $request->email,
            'amount' => (int) ($order->grand_total * 100),
            'quantity' => $order->quantity,
            'orderID' => $order->id,
            'callback_url' => route('paystack.success', ['order' => $order, 'cart' => $cart]),
            // 'reference' => $order->order_number,
            'metadata' => json_encode([
                'order_number' => $order->order_number,
                'custom_fields' => [
                    [
                        'display_name' => 'Order Number',
                        'variable_name' => 'order_number',
                        'value' => $order->order_number,
                    ], [
                        'display_name' => 'Shipping Address',
                        'variable_name' => 'shipping_address',
                        'value' => $order->order_number,
                    ],
                ],
            ]),
        ]);

        if (!$tranx->status) {
            throw new \Yabacon\Paystack\Exception\ApiException();
        }
        // store transaction reference so we can query in case user never comes back
        // perhaps due to network issue
        // save_last_transaction_reference($tranx->data->reference);

        // redirect to page so User can pay
        header('Location: ' . $tranx->data->authorization_url);
        exit();
    }

    /**
     * [paystackPaymentSuccess description].
     *
     * @param Request $request [description]
     * @param  [type]  $order   [description]
     * @param  [type]  $cart    [description]
     *
     * @return [type]           [description]
     */
    public function paystackPaymentSuccess(Request $request, $order, $cart)
    {
        if (!$request->has('trxref') || !$request->has('reference')) {
            return redirect()->route('payment.failed', $order);
        }

        if (!$order instanceof Order) {
            $order = Order::find($order);
        }

        // Delete the cart
        Cart::find($cart)->forceDelete();   // Delete the cart

        // Order has been paided
        $this->markOrderAsPaid($order);

        // Decrease the stock of the order items from the listing
        // $this->syncInventory($order);

        event(new OrderCreated($order));   // Trigger the Event

        return redirect()->route('order.success', $order)->with('success', trans('theme.notify.order_placed'));
    }

    /**
     * Charge using Stripe.
     *
     * @param \Illuminate\Http\Request $request
     * @param Order $order
     *
     * @return [type]
     */
    private function chargeWithPayPal($request, Order $order)
    {
        // Get the vendor configs
        $vendorPaypalConfig = $order->shop->paypalExpress;

        // If the stripe is not cofigured
        if (!$vendorPaypalConfig) {
            return redirect()->back()->with('success', trans('theme.notify.payment_method_config_error'))->withInput();
        }

        // Set vendor's paypal config
        config()->set('paypal_payment.mode', $vendorPaypalConfig->sandbox == 1 ? 'sandbox' : 'live');
        config()->set('paypal_payment.account.client_id', $vendorPaypalConfig->client_id);
        config()->set('paypal_payment.account.client_secret', $vendorPaypalConfig->secret);

        // ### Address
        // Base Address object used as shipping or billing
        // address in a payment. [Optional]
        // $shippingAddress= Paypalpayment::shippingAddress();
        // $shippingAddress->setLine1("3909 Witmer Road")
        //     ->setLine2("Niagara Falls")
        //     ->setCity("Niagara Falls")
        //     ->setState("NY")
        //     ->setPostalCode("14305")
        //     ->setCountryCode("US")
        //     ->setPhone("716-298-1822")
        //     ->setRecipientName("Jhone");

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod('paypal');

        $allItems = [];
        foreach ($order->inventories as $item) {
            $tempItem = Paypalpayment::item();
            $tempItem->setName($item->title)->setDescription($item->pivot->item_description)
                ->setCurrency(get_currency_code())->setQuantity($item->pivot->quantity)
                ->setTax($order->taxrate)->setPrice($item->pivot->unit_price);

            $allItems[] = $tempItem;
        }

        $itemList = Paypalpayment::itemList();
        $itemList->setItems($allItems);
        // ->setShippingAddress($shippingAddress);

        $details = Paypalpayment::details();
        $details->setShipping($order->get_shipping_cost())->setTax($order->taxes)
            ->setGiftWrap($order->packaging)->setShippingDiscount($order->discount)
            ->setSubtotal($order->calculate_total_for_paypal()); //total of items prices

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency(get_currency_code())
            ->setTotal($order->grand_total_for_paypal())
            ->setDetails($details);

        // ### Transaction
        // A transaction defines the contract of a payment - what is the payment for and who
        // is fulfilling it. Transaction is created with a `Payee` and `Amount` types
        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription(trans('app.purchase_from', ['marketplace' => get_platform_title()]))
            ->setInvoiceNumber($order->order_number);

        // ### Payment
        // A Payment Resource; create one using the above types and intent as 'sale'
        $redirectUrls = Paypalpayment::redirectUrls();
        $redirectUrls->setReturnUrl(route('payment.success', $order->id))
            ->setCancelUrl(route('payment.failed', $order->id));

        $payment = Paypalpayment::payment();

        $payment->setIntent('sale')->setPayer($payer)->setRedirectUrls($redirectUrls)->setTransactions([$transaction]);

        try {
            // ### Create Payment
            // Create a payment by posting to the APIService using a valid ApiContext The return object contains the status;
            $payment->create(Paypalpayment::apiContext());
        } catch (\PPConnectionException $ex) {
            return response()->json(['error' => $ex->getMessage()], 400);
        }

        return response()->json([$payment->toArray(), 'approval_url' => $payment->getApprovalLink()], 200);
    }

    /**
     * Payment done successfully. Sync inventory and trigger event.
     *
     * @param \Illuminate\Http\Request $request
     * @param Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentSuccess(Request $request, $order)
    {
        if (!$request->has('token') || !$request->has('paymentId') || !$request->has('PayerID')) {
            return redirect()->route('payment.failed', $order);
        }

        if (!$order instanceof Order) {
            $order = Order::find($order);
        }

        // Order has been paided
        $this->markOrderAsPaid($order);

        // Decrease the stock of the order items from the listing
        // $this->syncInventory($order);

        event(new OrderCreated($order));   // Trigger the Event

        return redirect()->route('order.success', $order)->with('success', trans('theme.notify.order_placed'));
    }

    /**
     * Payment failed. revert the order.
     *
     * @param \Illuminate\Http\Request $request
     * @param Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentFailed(Request $request, $order)
    {
        // $cart = $this->revertOrder($order);
        $cart = revertOrderAndMoveToCart($order);

        return redirect()->route('cart.checkout', $cart)->with('error', trans('theme.notify.payment_failed'))->withInput();
    }

    /**
     * Order placed successfully.
     *
     * @param App\Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function orderPlaced($order)
    {
        if (!$order instanceof Order) {
            $order = Order::find($order);
        }
        // session(['selected_country' => $location]);
        // if ($location != null) {
        //     $cat = ListHelper::location_categories($location);
        //     $catr = [];
        //     foreach ($cat as $c) {
        //         $catr[] = [$c->id];
        //     }
        //     $categories = Category::whereIn('id', $catr)->get();
        // }
        // else {
        //     $categories = Category::all();
        // }
        // return view('ecommerce_frontend.categories')->with('categories', $categories);
        return view('ecommerce_frontend.thanks', compact('order'));
        //return view('order_complete', compact('order'));
    }

    /**
     * Display order detail page.
     *
     * @param \Illuminate\Http\Request $request
     * @param App\Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(OrderDetailRequest $request, Order $order)
    {
        $order->load(['inventories.image', 'conversation.replies.attachments']);

        return view('order_detail', compact('order'));
    }

    /**
     * Buyer confirmed goods received.
     *
     * @param \Illuminate\Http\Request $request
     * @param App\Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function goods_received(ConfirmGoodsReceivedRequest $request, Order $order)
    {
        $order->goods_received();

        return redirect()->route('order.feedback', $order)->with('success', trans('theme.notify.order_updated'));
    }

    /**
     * Track order shippping.
     *
     * @param \Illuminate\Http\Request $request
     * @param App\Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function track(Request $request, Order $order)
    {
        return view('order_tracking', compact('order'));
    }

    /**
     * Create a new Customer.
     *
     * @param Request $request
     *
     * @return App\Customer
     */
    private function createNewCustomer($request)
    {
        $customer = Customer::create([
            'name' => $request->address_title,
            'email' => $request->email,
            'password' => $request->password,
            'accepts_marketing' => $request->subscribe,
            'verification_token' => str_random(40),
            'active' => 1,
        ]);

        // Sent email address verification notich to customer
        $customer->notify(new EmailVerificationNotification($customer));

        $customer->addresses()->create($request->all()); //Save address

        if (Auth::guard('web')->check()) {
            Auth::logout();
        }

        Auth::guard('customer')->login($customer); //Login the customer

        return $customer;
    }

    /**
     * Create a new order from the cart.
     *
     * @param Request $request
     * @param App\Cart $cart
     * @param mixed $order
     *
     * @return App\Order
     */
    // private function saveOrderFromCart($request, $cart)
    // {
    //     // Get shipping address
    //     if(is_numeric($request->ship_to))
    //         $address = \App\Address::find($request->ship_to)->toString(True);
    //     else
    //         $address = get_address_str_from_request_data($request);

    //     // Set shipping_rate_id and handling cost to NULL if its free shipping
    //     if($cart->is_free_shipping()) {
    //         $cart->shipping_rate_id = Null;
    //         $cart->handling = Null;
    //     }

    //     // Save the order
    //     $order = new Order;
    //     $order->fill(
    //         array_merge($cart->toArray(), [
    //             'grand_total' => $cart->grand_total(),
    //             'order_number' => get_formated_order_number($cart->shop_id),
    //             'carrier_id' => $cart->carrier() ? $cart->carrier->id : NULL,
    //             'shipping_address' => $address,
    //             'billing_address' => $address,
    //             'email' => $request->email,
    //             'buyer_note' => $request->buyer_note
    //         ])
    //     );
    //     $order->save();

    //     // Add order item into pivot table
    //     $cart_items = $cart->inventories->pluck('pivot');
    //     $order_items = [];
    //     foreach ($cart_items as $item) {
    //         $order_items[] = [
    //             'order_id'          => $order->id,
    //             'inventory_id'      => $item->inventory_id,
    //             'item_description'  => $item->item_description,
    //             'quantity'          => $item->quantity,
    //             'unit_price'        => $item->unit_price,
    //             'created_at'        => $item->created_at,
    //             'updated_at'        => $item->updated_at,
    //         ];
    //     }
    //     \DB::table('order_items')->insert($order_items);

    //     return $order;
    // }

    // /**
    //  * Revert order to cart
    //  *
    //  * @param  App\Order $Order
    //  *
    //  * @return App\Cart
    //  */
    // private function revertOrder($order)
    // {
    //     if( !$order instanceOf Order )
    //         $order = Order::find($order);

    //     if (!$order) return;

    //     // Save the cart
    //     $cart = Cart::create(array_merge($order->toArray(), ['ip_address' => request()->ip()]));

    //     // Add order item into pivot table
    //     $order_items = $order->inventories->pluck('pivot');
    //     $cart_items = [];
    //     foreach ($order_items as $item) {
    //         $cart_items[] = [
    //             'cart_id'           => $cart->id,
    //             'inventory_id'      => $item->inventory_id,
    //             'item_description'  => $item->item_description,
    //             'quantity'          => $item->quantity,
    //             'unit_price'        => $item->unit_price,
    //             'created_at'        => $item->created_at,
    //             'updated_at'        => $item->updated_at,
    //         ];
    //     }
    //     \DB::table('cart_items')->insert($cart_items);

    //     $order->forceDelete();   // Delete the order

    //     return $cart;
    // }

    /**
     * MarkOrderAsPaid.
     */
    private function markOrderAsPaid($order)
    {
        if (!$order instanceof Order) {
            $order = Order::find($order);
        }

        $order->payment_status = Order::PAYMENT_STATUS_PAID;

        $order->save();

        event(new OrderPaid($order));

        return $order;
    }

    // /**
    //  * Sync up the inventory
    //  * @param  Order $order
    //  *
    //  * @return void
    //  */
    // private function syncInventory(Order $order)
    // {
    //     foreach ($order->inventories as $item) {
    //         $item->decrement('stock_quantity', $item->pivot->quantity);
    //     }

    //     return;
    // }

    private function logErrors($error, $feedback)
    {
        \Log::error($error);

        // Set error messages:
        // $error = new \Illuminate\Support\MessageBag();
        // $error->add('errors', $feedback);

        return $error;
    }
}
