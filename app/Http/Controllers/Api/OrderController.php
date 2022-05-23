<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Order;
use App\Account;
use App\Shop;
use App\Cart;
use App\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\PaymentMethod;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return OrderResource::collection($orders);
    }

    /**
     * Display a listing of the resources from a given merchant.
     *
     * @return \Illuminate\Http\Response
     */
    public function merchantOrders(Request $request, $merchantId)
    {
        $orders = Order::where('shop_id', $merchantId)->get();
        return OrderResource::collection($orders);
    }
    /**
     * Fetch order details.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderDetails(Request $request, $orderId)
    {
        $order = Order::where('id', $orderId)->first();
        $order->merchant_notified = true;
        $order->save();
        $order->load('inventories');
        return new OrderResource($order);
    }

    /**
     * Fetch merchant order summaries.
     *
     * @return \Illuminate\Http\Response
     */

    public function ordersSummary(Request $request, $merchantId)
    {

        $total_confirmed = Order::where('shop_id', $merchantId)->get()->count();
        $mpesa_paid = Order::where('shop_id', $merchantId)->where('payment_method_id', 1)->where('payment_status', 3)->get()->count();
        $cod = Order::where('shop_id', $merchantId)->where('payment_method_id', 6)->get()->count();
        $walk_in_cash = Order::where('shop_id', $merchantId)->where('payment_method_id', 8)->get()->count();
        $walk_in_credit = Order::where('shop_id', $merchantId)->where('payment_method_id', 9)->get()->count();

        return response()->json([
            ['id' => 'total_confirmed', 'name' => 'Total Confirmed', 'total' => $total_confirmed],
            ['id' => 'mpesa_paid', 'name' => 'M-Pesa Paid', 'total' => $mpesa_paid],
            ['id' => 'cod', 'name' => 'Cash On Delivery', 'total' => $cod],
            ['id' => 'walk_in_cash', 'name' => 'Customer Cash Walk-In', 'total' => $walk_in_cash],
            ['id' => 'walk_in_credit', 'name' => 'Customer Credit Walk-In', 'total' => $walk_in_credit]
        ], 200);
    }

    public function orderCategoryDetail(Request $request, $merchantId, $detailId)
    {
        // Order number; Mobile Number; Amount; Order type (cash, credit, account); Order date.

        switch ($detailId) {
            case 'total_confirmed': {
                    $orders = Order::with('customer:id,stripe_id,name,email')->with('paymentMethod:id,name')->select('order_number', 'customer_id', 'total', 'payment_method_id', 'created_at')->where('shop_id', $merchantId)->orderBy('created_at', 'desc')->get();
                    break;
                }

            case 'mpesa_paid': {
                    $orders = Order::with('customer:id,stripe_id,name,email')->with('paymentMethod:id,name')->select('order_number', 'customer_id', 'total', 'payment_method_id', 'created_at')->where('shop_id', $merchantId)->where('payment_method_id', 1)->where('payment_status', 3)->orderBy('created_at', 'desc')->get();
                    break;
                }

            case 'cod': {
                    $orders = Order::with('customer:id,stripe_id,name,email')->with('paymentMethod:id,name')->select('order_number', 'customer_id', 'total', 'payment_method_id', 'created_at')->where('shop_id', $merchantId)->where('payment_method_id', 6)->orderBy('created_at', 'desc')->get();
                    break;
                }

            case 'walk_in_cash': {
                    $_orders = Order::with('customer:id,stripe_id,name,email')->with('paymentMethod:id,name')->select('order_number', 'customer_id', 'total', 'payment_method_id', 'transaction_date' )->where('shop_id', $merchantId)->where('payment_method_id', 8)->orderBy('transaction_date', 'desc')->get()->toArray();
                    $orders = [];
                    
                    foreach ($_orders as $order){
                       $order['created_at']= $order['transaction_date'];
                       $orders[]= $order;
                    }
                    break;
                }

            case 'walk_in_credit': {
                    $_orders = Order::with('customer:id,stripe_id,name,email')->with('paymentMethod:id,name')->select('order_number', 'customer_id', 'total', 'payment_method_id', 'transaction_date', 'created_at')->where('shop_id', $merchantId)->where('payment_method_id', 9)->orderBy('transaction_date', 'desc')->get()->toArray();
                    $orders = [];
                    foreach ($_orders as $order){
                       $order['created_at']= $order['transaction_date'];
                       $orders[]= $order;
                    }
                    break;
                }
            default: {
                }
        }
        
        return response()->json(['id' => $detailId, 'orders' => $orders], 200);
    }


    public function checkoutAllOrders(Request $request, $merchantId)
    {
        // $this->afterCheckout($orders, $total_order_amount, $mobile_number, $customer_id, $paymentMethod);



        $mobile_number = $request->phone;
        $customer = Customer::where('stripe_id', $mobile_number)->first();
        $shopId = Shop::where('id', $merchantId)->first();
        $cartItems = $request->cart;
        $total_order_amount = $request->total_order_amount;;
        $paymentMethodId = PaymentMethod::where('id', 8)->first();
        $type = $request->type;


        // Instantiate new cart if old cart not found for the shop and customer
        if (isset($shopId)) {
            $cart = new Cart();
            $cart->shop_id = $shopId->id;
            $cart->payment_method_id = $paymentMethodId->id;
            if (isset($customer)) {
                $cart->customer_id = $customer->id;
            } else {
                // Create a new customer
                $customer = new Customer();
                // Set a dummy email account to be updated by the customer
                $customer->email = $mobile_number . "@gmail.com";
                $customer->stripe_id = $mobile_number;
                $customer->save();
                $cart->customer_id = $customer->id;
            }

            $cart->item_count = $request->item_count;
            $cart->quantity = $request->total_quantity;

            //Reset if the old cart exist, bcoz shipping rate will change after adding new item

            $cart->total = $total_order_amount;
            $cart->grand_total = $total_order_amount;

            $cart->save();
            $cart_item_pivot_data = [];

            foreach ($cartItems as $ci) {
                // Prepare pivot data
                $cart_item_pivot_data[$ci['inventory_id']] = [
                    'inventory_id' => $ci['inventory_id'],
                    'quantity' => $ci['quantity'],
                    'unit_price' => $ci['sale_price'],
                ];
            }

            // Save cart items into pivot
            if (!empty($cart_item_pivot_data)) {
                $cart->inventories()->syncWithoutDetaching($cart_item_pivot_data);
            }

            // Start transaction!
            DB::beginTransaction();
            try {
                // Create the order from the cart
                $order = $this->createOrder($cart, $type);
            } catch (\Exception $e) {
                \Log::error($e);        // Log the error

                // rollback the transaction and log the error
                DB::rollback();

                return response()->json($e, 500);
            }

            // Everything is fine. Now commit the transaction
            DB::commit();

            $cart->forceDelete();   // Delete the cart
            // event(new OrderCreated($order));   // Trigger the Event

            if ($shopId) {
                // Save a +ve account
                $account = new Account;
                if(isset($type)){
                    $walkInType = ($type == 'cash') ? Account::TYPE_CASH : Account::TYPE_CREDIT;
                }else{
                    // Default to cash
                    $walkInType =Account::TYPE_CASH;
                }
                $account->fill([
                    'user_id' => $shopId->owner_id,
                    'amount' => $order->grand_total,
                    'order_id' => $order->id,
                    'type' => $walkInType,
                ]);
                $account->save();
            }


            // return new OrderResource($order);
            return response()->json(['success' => "Order [$order->order_number] processed successfully"], 200);
        } else {
            return response()->json(['Error' => "This merchant has no active shop"], 404);
        }
    }

    public function createOrder(Cart $cart, $type)
    {
        // Save the order
        $order = new Order();

        $order->fill(
            array_merge($cart->toArray(), [
                'grand_total' => $cart->grand_total(),
                'order_number' => get_formated_order_number($cart->shop_id),
                'carrier_id' => $cart->carrier() ? $cart->carrier->id : null,
                'transaction_date' => Carbon::now(),
                'shop_id' => $cart->shop_id
            ])

        );
        if (!$order instanceof Order) {
            $order = Order::find($order);
        }

        $order->payment_status = ($type == 'cash') ? Order::PAYMENT_STATUS_PAID : Order::PAYMENT_STATUS_PENDING;
        

        $order->payment_method_id = ($type == 'cash') ? 8 : 9;
            // Default to cash
        $order->customer_id = $cart->customer_id;
        $order->save();

        // Add order item into pivot table
        $cart_items = $cart->inventories->pluck('pivot');
        $order_items = [];
        foreach ($cart_items as $item) {
            $order_items[] = [
                'order_id' => $order->id,
                'inventory_id' => $item->inventory_id,
                'item_description' => $item->item_description,
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        }
        \DB::table('order_items')->insert($order_items);

        // Sync up the inventory. Decrease the stock of the order items from the listing
        foreach ($order->inventories as $item) {
            $item->decrement('stock_quantity', $item->pivot->quantity);
        }

        // Reduce the coupon in use
        if ($order->coupon_id) {
            Coupon::find($order->coupon_id)->decrement('quantity');
        }
        // \DB::table('coupons')->where('id', $order->coupon_id)->decrement('quantity');

        return $order;
    }
}
