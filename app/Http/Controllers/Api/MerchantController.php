<?php

namespace App\Http\Controllers\Api;

use Log;
use App\Helpers\Payments;
use App\Helpers\Messaging;
use App\Http\Controllers\Controller;
use App\User;
use App\Events\Shop\ShopCreated;
use App\Events\User\UserCreated;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\Merchant\MerchantRepository;
use App\Jobs\CreateShopForMerchant;
use App\Http\Requests\Validations\CreateMerchantRequest;

class MerchantController extends Controller


{

    private $merchant;
    private $model_name;

    public function __construct(MerchantRepository $merchant)
    {
        parent::__construct();

        $this->model_name = trans('app.model.merchant');

        $this->merchant = $merchant;
    }
    public static function getAccountBalance($user_id)
    {
        $cash =  Payments::getAccountBalance($user_id, 2);
        $mpesa =  Payments::getAccountBalance($user_id, 1);
        return response()->json(['cash' => $cash, 'mpesa' => $mpesa], 200);
    }
    public static function disburse(Request $request)
    {
        $user_id = $request->user_id;
        $amount = $request->amount;
        $merchant = User::where('id', $user_id)->first();
        if (isset($merchant)) {
            $mobile_number = $merchant->mobile;
            if (isset($mobile_number)) {
                // Check if the merchant has enough balance to even withdraw
                $mpesaBalance =  Payments::getAccountBalance($user_id, 1);
                if ($amount <= $mpesaBalance) {
                    $status =  Payments::disburse($user_id, $mobile_number, $amount);
                    if ($status == 1) {
                        return response()->json(['status' => 'Pending', 'msg' => 'The service request accepted successfully.'], 200);
                    } else {
                        return response()->json(['status' => 'Failed', 'msg' => 'The service request could not be processed.'], 500);
                    }
                } else {
                    return response()->json(['status' => 'Error', 'msg' => 'Withdrawal amount is more than the account balance.'], 500);
                }
            } else {
                return response()->json(['status' => 'Error', 'msg' => 'Missing merchant mobile number.'], 404);
            }
        } else {
            return response()->json(['status' => 'Error', 'msg' => 'Could not process the disbursement request for specified merchant.'], 404);
        }
    }


    /**
     * Fetch merchant daily sales.
     *
     * @return \Illuminate\Http\Response
     */

    public function merchantSales(Request $request, $merchantId)
    {
        $from = $request->query('from');
        $to = $request->query('to');
        // return response()->json(['from' => $from, 'to' => $to], 200);
        if($from && $to){
            $fromDate = Carbon::createFromTimestamp($from);
            $toDate = Carbon::createFromTimestamp($to);
            $search_cash =  DB::table('accounts')->whereBetween('created_at', [$fromDate, $toDate])->whereNotNull('order_id')->whereIn('type', [2,4])->where('user_id', $merchantId)->sum('amount');
            $search_credit =  DB::table('accounts')->whereBetween('created_at', [$fromDate, $toDate])->whereNotNull('order_id')->where('type', 3)->where('user_id', $merchantId)->sum('amount');
            $search_account = DB::table('accounts')->whereBetween('created_at', [$fromDate, $toDate])->whereNotNull('order_id')->where('type', 1)->where('user_id', $merchantId)->sum('amount');

            return response()->json([
                'search' => ['fromDate' => $fromDate,'todate' => $toDate ,'cash' => $search_cash, 'account' => $search_account, 'credit' => $search_credit],
            ], 
                200);
        }

        $today_cash =  DB::table('accounts')->whereDate('created_at', Carbon::today())->whereNotNull('order_id')->whereIn('type', [2,4])->where('user_id', $merchantId)->sum('amount');
        $today_credit =  DB::table('accounts')->whereDate('created_at', Carbon::today())->whereNotNull('order_id')->where('type', 3)->where('user_id', $merchantId)->sum('amount');
        $today_account = DB::table('accounts')->whereDate('created_at', Carbon::today())->whereNotNull('order_id')->where('type', 1)->where('user_id', $merchantId)->sum('amount');
        
        $total_cash = DB::table('accounts')->whereNotNull('order_id')->whereIn('type', [2,4])->where('user_id', $merchantId)->sum('amount');
        $total_credit = DB::table('accounts')->whereNotNull('order_id')->where('type', 3)->where('user_id', $merchantId)->sum('amount');
        $total_account = DB::table('accounts')->whereNotNull('order_id')->where('type', 1)->where('user_id', $merchantId)->sum('amount');


        return response()->json([
            'today' => ['cash' => $today_cash, 'account' => $today_account, 'credit' => $today_credit], 
            'total' => ['cash' => $total_cash, 'account' => $total_account, 'credit' => $total_credit]
        ], 
            200);
    }

    public function merchantSignup(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); echo "</pre>"; exit();
        // Start transaction!
        DB::beginTransaction();

        try {
            $merchant = $this->merchant->store($request);
            // Dispatching Shop create job
            CreateShopForMerchant::dispatch($merchant, $request->all());
        } catch (\Exception $e) {
            // rollback the transaction and log the error
            DB::rollback();
            Log::error('Vendor Creation Failed: ' . $e->getMessage());

            // add your error messages:
            $error = new \Illuminate\Support\MessageBag();
            $error->add('error', $e);

            return response()->json(['status' => 'Error', 'msg' => 'Error while creating merchant', 'err' => 'Vendor Creation Failed: ' . $e->getMessage()], 404);
        }

        // Everything is fine. Now commit the transaction
        DB::commit();

        // Trigger user created event
        event(new UserCreated($merchant, $request->get('name'), $request->get('password')));

        // Trigger shop created event
        event(new ShopCreated($merchant->owns));

        // send message to Nyayomat
        $message = "A new merchant [$request->name] has signed up. Reach out to him via $request->mobile";
        Messaging::sendMessage(env('BUSINESS_NUMBER'), $message);

        return response()->json(['status' => 'success', 'msg' => trans('messages.created', ['model' => $this->model_name])], 200);
    }
}
