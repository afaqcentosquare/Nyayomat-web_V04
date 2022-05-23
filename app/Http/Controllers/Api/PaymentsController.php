<?php

namespace App\Http\Controllers\Api;

use App\Account;
use App\Customer;
use App\Disbursement;
use App\Events\Order\OrderPaid;
use App\Helpers\Messaging;
use App\Helpers\Payments;
use App\Helpers\Twilio;
use App\Http\Controllers\Controller;
use App\Order;
use App\Shop;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentsController extends Controller
{
    /**
     * Receive STK Push callback
     *
     * Data:
     *       {
     *       "Body":
     *       {"stkCallback":
     *        {
     *         "MerchantRequestID": "21605-295434-4",
     *         "CheckoutRequestID": "ws_CO_04112017184930742",
     *         "ResultCode": 0,
     *         "ResultDesc": "The service request is processed successfully.",
     *         "CallbackMetadata":
     *          {
     *           "Item":
     *           [
     *           {
     *             "Name": "Amount",
     *             "Value": 1
     *           },
     *           {
     *             "Name": "MpesaReceiptNumber",
     *             "Value": "LK451H35OP"
     *           },
     *           {
     *             "Name": "Balance"
     *           },
     *           {
     *             "Name": "TransactionDate",
     *             "Value": 20171104184944
     *            },
     *           {
     *             "Name": "PhoneNumber",
     *             "Value": 254727894083
     *           }
     *           ]
     *          }
     *        }
     *       }
     *      }
     */
    public function stkCallback(Request $request)
    {
        Log::debug("stkCallback: " . $request->getContent());
        $request = json_decode($request->getContent());
        $body = $request->Body;
        if (!$body) {
            Payments::returnJsonError(array(
                'ResultCode' => 1,
                'ResultDesc' => 'Some fields missing'
            ));
        }

        $callback = $body->stkCallback;
        if (!$callback) {
            Payments::returnJsonError(array(
                'ResultCode' => 1,
                'ResultDesc' => 'Some fields missing'
            ));
        }

        $checkout_request_id = $callback->CheckoutRequestID;
        $result_code = $callback->ResultCode;
        $result_desc = $callback->ResultDesc;
        $callback_metadata = $callback->CallbackMetadata;
        if ($result_code != '0') {
            Payments::returnJsonError(array(
                'ResultCode' => 1,
                'ResultDesc' => 'Stk push failed with ' . $result_desc
            ));
        }

        $transaction_id = null;
        $payment_date = null;
        $amount = 0.0;
        $phone_number = null;
        if ($callback_metadata && isset($callback_metadata->Item) && count($callback_metadata->Item) > 0) {
            for ($i = 0; $i < count($callback_metadata->Item); $i++) {
                $item = $callback_metadata->Item[$i];
                $name = isset($item->Name) ? $item->Name : '';
                $value = isset($item->Value) ? $item->Value : '';
                if ($name == 'Amount') {
                    $amount = floatval($value);
                } elseif ($name == 'MpesaReceiptNumber') {
                    $transaction_id = $value;
                } elseif ($name == 'PhoneNumber') {
                    $phone_number = $value;
                } elseif ($name == 'TransactionDate') {
                    $payment_date = Payments::parseDateToUTC($value, 'YmdHis');
                }
            }
        }

        $orders = Order::where('checkout_request_id', $checkout_request_id)->get();
        if (!$orders || count($orders) <= 0) {
            Payments::returnJsonError(array(
                'ResultCode' => 1,
                'ResultDesc' => 'no order available',
            ));
        }

        $total_order_amount = 0;
        foreach ($orders as $order) {
            $total_order_amount += $order->grand_total;
        }

        if ($amount < $total_order_amount) {
            Payments::returnJsonError(array(
                'ResultCode' => 1,
                'ResultDesc' => 'insufficient',
            ));
        }

        foreach ($orders as $order) {
            $order->transaction_id = $transaction_id;
            $order->amount_paid = $order->grand_total;
            $order->sender_phone_number = $phone_number;
            $order->transaction_date = $payment_date;
            $order->payment_status = Order::PAYMENT_STATUS_PAID;
            $order->save();

            $shop = DB::table("shops")->where('id', $order->shop_id)->first();
            if (!$shop instanceof Shop) {
                $shop = Shop::findOrFail($shop->id);
            }

            if ($shop) {
                // Save a +ve account
                $account = new Account;
                $account->fill([
                    'user_id' => $shop->owner_id,
                    'amount' => $order->grand_total,
                    'order_id' => $order->id,
                    'type' => Account::TYPE_MPESA,
                ]);
                $account->save();

                $user = DB::table("users")->where('id', $shop->owner_id)->first();
                if (!$user instanceof User) {
                    $user = User::findOrFail($user->id);
                }

                if ($user) {
                    // send message to merchant
                    $shipping_address = $order->shipping_address;
                    $message = "KSh " . number_format($order->grand_total, 2) . " received for order [$order->order_number] $shipping_address";
                    Messaging::sendMessage($user->mobile, $message);

                    // Send whatsapp notification

                    $clientNumber = Twilio::formatPhoneNumber($user->mobile);
                    $whatsapp_message = $this->formWhatsappNotification($order);
                    Twilio::sendMaytapiMessage($clientNumber, $whatsapp_message);
                }
            }

            event(new OrderPaid($order));
        }

        Payments::returnJsonError(array(
            'ResultCode' => 0,
            'ResultDesc' => 'ok',
        ));
    }

    /**
     * Receive Disburse callback
     *
     *      Incoming request:
     *      {
     *          "Result":
     *          {
     *            "ResultType":0,
     *            "ResultCode":0,
     *            "ResultDesc":"The service request has been accepted successfully.",
     *            "OriginatorConversationID":"14593-80515-2",
     *            "ConversationID":"AG_20170821_000049448b24712383de",
     *            "TransactionID":"LHL41AHJ6G",
     *            "ResultParameters":
     *            {
     *             "ResultParameter":
     *             [
     *              {
     *                "Key":"TransactionAmount",
     *                "Value":100
     *              },
     *              {
     *                "Key":"TransactionReceipt",
     *                "Value":"LHL41AHJ6G"
     *              },
     *              {
     *                "Key":"B2CRecipientIsRegisteredCustomer",
     *                "Value":"Y"
     *              },
     *              {
     *                "Key":"B2CChargesPaidAccountAvailableFunds",
     *                "Value":0.00
     *              },
     *              {
     *                "Key":"ReceiverPartyPublicName",
     *                "Value":"254708374149 - John Doe"
     *                                                              },
     *              {
     *                "Key":"TransactionCompletedDateTime",
     *                "Value":"21.08.2017 12:01:59"
     *              },
     *              {
     *                "Key":"B2CUtilityAccountAvailableFunds",
     *                "Value":98834.00
     *              },
     *              {
     *                "Key":"B2CWorkingAccountAvailableFunds",
     *                "Value":100000.00
     *              }
     *             ]
     *            },
     *            "ReferenceData":
     *            {
     *            "ReferenceItem":
     *             {
     *              "Key":"QueueTimeoutURL",
     *              "Value":"https:\/\/internalsandbox.safaricom.co.ke\/mpesa\/b2cresults\/v1\/submit"
     *             }
     *            }
     *          }
     *      }
     *
     *      OR
     *
     *      {
     *          "Result":
     *          {
     *              "ResultType":0,
     *              "ResultCode":>17,
     *              "ResultDesc":"System internal error.",
     *              "OriginatorConversationID":"16940-3815719-3",
     *              "ConversationID":"AG_20171228_00004fd3a482e7f73145",
     *              "TransactionID":"LLS81H3W6E",
     *              "ReferenceData":
     *              {
     *               "ReferenceItem":
     *               {
     *                "Key":"QueueTimeoutURL",
     *                "Value":"https:\/\/internalsandbox.safaricom.co.ke\/mpesa\/b2cresults\/v1\/submit"
     *               }
     *              }
     *          }
     *      }
     */
    public function b2cCallback(Request $request)
    {
        Log::debug("b2cCallback: " . $request->getContent());
        $body = null;
        try {
            $request = json_decode($request->getContent());
            $body = $request->Result;
        } catch (\Exception $e) {
            $body = null;
        }

        if (!$body) {
            Payments::returnJsonError(array(
                'ResultCode' => 1,
                'ResultDesc' => 'Some fields missing'
            ));
        }

        $result_code = $body->ResultCode;
        $result_desc = $body->ResultDesc;
        $original_conversation_id = $body->OriginatorConversationID;
        $conversation_id = $body->ConversationID;
        $transation_id = $body->TransactionID;
        $result_params = isset($body->ResultParameters) ? $body->ResultParameters : null;
        $failure_reason = null;
        $status = Disbursement::STATUS_SUCCESS;

        if ($result_code != '0') {
            $status = Disbursement::STATUS_FAILED;
            $failure_reason = $result_desc;
        }

        $amount = 0.0;
        $customer_phone = null;
        $customer_name = null;
        $payment_date = null;
        $utility_balance = null;
        $working_balance = null;
        $charges = null;
        if ($result_params && isset($result_params->ResultParameter) && count($result_params->ResultParameter) > 0) {
            for ($i = 0; $i < count($result_params->ResultParameter); $i++) {
                $item = $result_params->ResultParameter[$i];
                $name = isset($item->Key) ? $item->Key : '';
                $value = isset($item->Value) ? $item->Value : '';
                if ($name == 'TransactionAmount') {
                    $amount = floatval($value);
                } elseif ($name == 'ReceiverPartyPublicName') {
                    $name_phone_pair = explode("-", $value);
                    if (count($name_phone_pair) > 1) {
                        $customer_phone = trim($name_phone_pair[0]);
                        $customer_name = trim($name_phone_pair[1]);
                    } else {
                        $customer_phone = trim($value);
                    }
                } elseif ($name == 'TransactionCompletedDateTime') {
                    $payment_date = Payments::parseDateToUTC(str_replace(" ", "", $value), 'd.m.YH:i:s');
                } elseif ($name == 'B2CUtilityAccountAvailableFunds') {
                    $utility_balance = floatval($value);
                } elseif ($name == 'B2CWorkingAccountAvailableFunds') {
                    $working_balance = floatval($value);
                } elseif ($name == 'B2CChargesPaidAccountAvailableFunds') {
                    $charges = floatval($value);
                }
            }
        }

        $disbursement = DB::table("disbursements")->where('conversation_id', $conversation_id)->first();
        if (!$disbursement instanceof Disbursement) {
            $disbursement = Disbursement::findOrFail($disbursement->id);
        }

        if (!$disbursement) {
            $disbursement = DB::table("disbursements")
                ->where('recipient_phone', $customer_phone)
                ->where('amount', $amount)
                ->whereNull('callback_at')
                ->first();
            if (!$disbursement instanceof Disbursement) {
                $disbursement = Disbursement::findOrFail($disbursement->id);
            }
        }

        if (!$disbursement) {
            Payments::returnJsonError(array(
                'ResultCode' => 1,
                'ResultDesc' => "B2C request with conversation id $conversation_id or receiver phone number $customer_phone does not exist.",
            ));
        }

        if ($disbursement->callback_at) {
            Payments::returnJsonError(array(
                'ResultCode' => 1,
                'ResultDesc' => "Duplicate B2C callback with conversation id $conversation_id.",
            ));
        }

        $disbursement->status = $status;
        $disbursement->transaction_id = $transation_id;
        $disbursement->conversation_id = $conversation_id;
        $disbursement->originator_conversation_id = $original_conversation_id;

        if ($amount) {
            $disbursement->amount = $amount;
        } else {
            $amount = $disbursement->amount;
        }

        if ($customer_name) {
            $disbursement->receiver_name = $customer_name;
        }

        if ($charges) {
            $disbursement->charges = $charges;
        }

        if ($utility_balance) {
            $disbursement->utility_balance = $utility_balance;
        }

        if ($working_balance) {
            $disbursement->working_balance = $working_balance;
        }

        if ($payment_date) {
            $disbursement->transaction_completed_at = $payment_date;
        }

        if ($failure_reason) {
            $disbursement->failure_reason = $failure_reason;
        }

        $disbursement->callback_at = Carbon::Now();

        $disbursement->save();

        if ($status == Disbursement::STATUS_SUCCESS && $amount) {
            // Save a -ve account
            $account = new Account;
            $account->fill([
                'user_id' => $disbursement->user_id,
                'amount' => $amount * -1,
                'disbursement_id' => $disbursement->id,
                'type' => Account::TYPE_MPESA,
            ]);
            $account->save();
        }

        Payments::returnJsonError(array(
            'ResultCode' => 0,
            'ResultDesc' => 'ok',
        ));
    }


    
    public function formWhatsappNotification(Order $order)
    {
        $message = trans('notifications.merchant_order_created_notification.greeting', ['merchant' => $order->shop->name]) . ", \n";
        $message .= trans('notifications.merchant_order_created_notification.message', ['order' => $order->order_number]) . "\n\n";
        $message .= "Order URL " . url('admin.order.order.show', $order->id) . "\n\n";

        $message .= trans('messages.order_name') . "(s): \n";

        foreach ($order->inventories as $inventory) {
            $message .=  "\t\t" . $inventory->title . ': ' . $inventory->pivot->quantity . "\n";
        }


        $message .= trans('messages.shop_name') . ': ' . $order->shop->name . "\n";
        $message .= trans('messages.order_id') . ': ' . $order->order_number . "\n";
        $message .= trans('messages.quantity') . ': ' . $order->quantity . "\n";
        $message .= trans('messages.payment_method') . ': ' . $order->paymentMethod->name . "\n";
        $message .= trans('messages.order_status') . ': ' . $order->status->name . "\n";
        if ($order->carrier_id) {
            $message .= trans('messages.shipping_carrier') . ': ' . $order->carrier->name . "\n";
        }
        if ($order->tracking_id) {
            $tracking_url = getTrackingUrl($order->tracking_id, $order->carrier_id);
            $message .= '<a href="' . $tracking_url . '" target="_blank">' . trans('messages.tracking_id') . '</a>:' . $order->tracking_id . "\n";
        }
        $message .= trans('messages.shipping_address') . ': ' . $order->shipping_address . "\n\n";
        $message .= trans('messages.billing_address') . ': ' . $order->billing_address . "\n\n";


        $message .= trans('messages.thanks') . ",\n";
        $message .= get_platform_title();

        return $message;
    }
}
