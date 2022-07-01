<?php

namespace App\Http\Controllers\ACP\API;

use App\Events\Shop\ShopCreated;
use App\Events\User\UserCreated;
use App\Helpers\Messaging;
use App\Http\Controllers\Controller;
use App\Jobs\CreateShopForMerchant;
use App\Models\Asset;
use App\Models\AssetProviderTransaction;
use App\Models\MerchantAsset;
use App\Models\MerchantAssetOrder;
use App\Models\MerchantTransaction;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Merchant;
use App\City;
use App\Region;
use App\Location;
use App\Models\AssetProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MerchantController extends Controller
{


    public function registerRequest(Request $request)
    {

        // echo "<pre>"; print_r($request->all()); echo "</pre>"; exit();
        // Start transaction!
        DB::beginTransaction();

        try {
            $merchant = Merchant::store($request);
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

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors(),
            ], 204);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                return response()->json([
                    "status" => true,
                    "token" => $user->createToken('Acp Merchant App')->accessToken,
                    "user" => $user,
                ], 200);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "email or password is incorrect",
                ], 204);
            }
        } else {
            return response()->json([
                "status" => false,
                "message" => "email or password is incorrect",
            ], 204);
        }
    }

    public function accountBalance($id)
    {
        try {
            $user = User::where('id', $id)->first();
            return response()->json([
                "status" => true,
                "user" => $user
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
            ], 204);
        }
    }

    public function catalog($id)
    {
        try {
            $browse = MerchantAsset::select("tbl_acp_merchant_assets.*", "tbl_acp_assets.image")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_assets.id")
                ->get();

            $requested = MerchantAssetOrder::select("tbl_acp_merchant_asset_order.*", "tbl_acp_asset_providers.shop_name", "tbl_acp_assets.asset_name", "tbl_acp_assets.image")
                ->where("merchant_id", $id)
                ->where("tbl_acp_merchant_asset_order.status", "pending")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_asset_order.asset_id")
                ->join("tbl_acp_asset_providers", "tbl_acp_asset_providers.id", "tbl_acp_merchant_asset_order.asset_provider_id")
                ->orderby("tbl_acp_merchant_asset_order.updated_at", 'DESC')
                ->get();

            $received = MerchantAssetOrder::select("tbl_acp_merchant_asset_order.*", "tbl_acp_asset_providers.shop_name", "tbl_acp_assets.asset_name", "tbl_acp_assets.image")
                ->where("merchant_id", $id)
                ->where("tbl_acp_merchant_asset_order.status", "delivered")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_asset_order.asset_id")
                ->join("tbl_acp_asset_providers", "tbl_acp_asset_providers.id", "tbl_acp_merchant_asset_order.asset_provider_id")
                ->orderby("tbl_acp_merchant_asset_order.updated_at", 'DESC')
                ->get();

            return response()->json([
                "status" => true,
                "browse" => $browse,
                "requested" => $requested,
                "received" => $received,
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
            ], 204);
        }
    }

    public function browse($id)
    {
        try {
            $browse = MerchantAsset::select("tbl_acp_merchant_assets.*", "tbl_acp_assets.image")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_assets.id")
                ->get();
            if (count($browse) > 0) {
                return response()->json([
                    "status" => true,
                    "browse" => $browse
                ], 200);
            } else {
                return response()->json([
                    "status" => true,
                    "browse" => $browse
                ], 204);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
            ], 204);
        }
    }


    public function requested($id)
    {
        try {
            $requested = MerchantAssetOrder::select("tbl_acp_merchant_asset_order.*", "tbl_acp_asset_providers.shop_name", "tbl_acp_assets.asset_name", "tbl_acp_assets.image")
                ->where("merchant_id", $id)
                ->where("tbl_acp_merchant_asset_order.status", "pending")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_asset_order.asset_id")
                ->join("tbl_acp_asset_providers", "tbl_acp_asset_providers.id", "tbl_acp_merchant_asset_order.asset_provider_id")
                ->get();

            if (count($requested) > 0) {
                return response()->json([
                    "status" => true,
                    "requested" => $requested
                ], 200);
            } else {
                return response()->json([
                    "status" => true,
                    "requested" => $requested
                ], 204);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
            ], 204);
        }
    }


    public function received($id)
    {
        try {
            $received = MerchantAssetOrder::select("tbl_acp_merchant_asset_order.*", "tbl_acp_asset_providers.shop_name", "tbl_acp_assets.asset_name", "tbl_acp_assets.image")
                ->where("merchant_id", $id)
                ->where("tbl_acp_merchant_asset_order.status", "delivered")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_asset_order.asset_id")
                ->join("tbl_acp_asset_providers", "tbl_acp_asset_providers.id", "tbl_acp_merchant_asset_order.asset_provider_id")
                ->get();
            if (count($received) > 0) {
                return response()->json([
                    "status" => true,
                    "received" => $received
                ], 200);
            } else {
                return response()->json([
                    "status" => true,
                    "received" => $received
                ], 204);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
            ], 204);
        }
    }

    public function assetRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "user_id" => "required",
            "asset_id" => "required",
            "units" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors(),
            ], 204);
        }
        try {
            $asset = MerchantAsset::select('tbl_acp_merchant_assets.*','tbl_acp_asset_providers.shop_name as asset_provider_shop_name',
            'tbl_acp_asset_providers.email as asset_provider_email','tbl_acp_asset_providers.phone as asset_provider_phone','tbl_acp_asset_providers.location as asset_provider_location'
             ,'tbl_acp_asset_providers.sub_county as asset_provider_sub_county','tbl_acp_asset_providers.county as asset_provider_county')->where("tbl_acp_merchant_assets.id", $request->asset_id)
            ->join('tbl_acp_asset_providers', 'tbl_acp_asset_providers.id','tbl_acp_merchant_assets.asset_provider_id')
            ->first();
            $merchant = User::select('users.*', 'shops.name as shop_name')->where("users.id",$request->user_id)->join('shops', 'shops.owner_id', 'users.id')->first();
            if ($asset) {
                if ($asset->units >= $request->units) {
                    if ($merchant) {
                        if ($merchant->account_balance >= ($request->units * $asset->deposit_amount)) {
                            $order_request = new MerchantAssetOrder();
                            $order_request->merchant_id = $request->user_id;
                            $order_request->asset_id = $request->asset_id;
                            $order_request->asset_provider_id = $asset->asset_provider_id;
                            $order_request->units = $request->units;
                            $order_request->unit_cost = $asset->unit_cost;
                            $order_request->holiday_provision = $asset->holiday_provision;
                            $order_request->deposit_amount = $asset->deposit_amount;
                            $order_request->installment = $asset->installment;
                            $order_request->payment_frequency = $asset->payment_frequency;
                            $order_request->payment_method = $asset->payment_method;
                            $order_request->total_out_standing_amount = $request->units * $asset->unit_cost;
                            if ($order_request->save()) {
                                $merchant->account_balance = $merchant->account_balance - ($request->units * $asset->deposit_amount);
                                if ($merchant->save()) {


                                $city = City::where('id', $merchant->city)->first();
                                $region = Region::where('id', $merchant->region)->first();
                                $location = Location::where('id',$merchant->location)->first();

                                $subject = "Nyayomat Order # ".$order_request->id. " Confirmation" ;
                                $asset_provider_email = $asset->asset_provider_email;

                                $asset_provider_asset = Asset::where("id", $request->asset_id)->first();

                                $asset_provider_mail_data = array(

                                   "order_id" => $order_request->id,
                                    "subject" => "Nyayomat Order # ".$order_request->id,
                                    "asset_provider_shop_name" => $asset->asset_provider_shop_name,
                                    "merchant_shop_name" => $merchant->shop_name,
                                    "merchant_contact" => $merchant->mobile,
                                    "asset_name" => $asset->asset_name,
                                    "units" => $request->units,
                                    "unit_price" => $asset_provider_asset->unit_cost,
                                    "total_cost" => $request->units * $asset_provider_asset->unit_cost,
                                    "location" => $location ? $location->name : '',
                                    "region" => $region ?  $region->name : '', 
                                    "city" => $city ? $city->name : '',
                                );

                                $merchant_mail_data = array(
                                    "order_id" => $order_request->id,
                                    "asset_provider_shop_name" => $asset->asset_provider_shop_name,
                                    "merchant_shop_name" => $merchant->shop_name,
                                    "asset_provider_contact" => $asset->asset_provider_phone,
                                    "asset_name" => $asset->asset_name,
                                    "units" => $request->units,
                                    "unit_price" => $asset->unit_cost,
                                    "total_cost" => $request->units * $asset->unit_cost,
                                    "location" => $asset->asset_provider_location ? $asset->asset_provider_location : '',
                                    "sub_county" => $asset->asset_provider_sub_county ?  $asset->asset_provider_sub_county : '', 
                                    "county" => $asset->asset_provider_county ? $asset->asset_provider_county : '',

                                );

                                //Asset Provider Mails
                            
                                Mail::send('acp.mail.asset_provider_new_order', $asset_provider_mail_data, function($message) use ($subject , $asset_provider_email) {
                                $message->to($asset_provider_email)->subject
                                    ($subject);
                                $message->from('no-reply@nyayomat.com','Nyayomat');
                                });

                                Mail::send('acp.mail.asset_provider_new_order', $asset_provider_mail_data, function($message) use ($subject) {
                                $message->to('no-reply@nyayomat.com')->subject
                                    ($subject);
                                $message->from('no-reply@nyayomat.com','Nyayomat');
                                });

                                //Merchant Mails

                                $merchant_email = $merchant->email;

                                Mail::send('acp.mail.merchant_new_order', $merchant_mail_data, function($message) use ($subject , $merchant_email) {
                                $message->to($merchant_email)->subject
                                    ($subject);
                                $message->from('no-reply@nyayomat.com','Nyayomat');
                                });

                                Mail::send('acp.mail.merchant_new_order', $merchant_mail_data, function($message) use ($subject) {
                                $message->to('no-reply@nyayomat.com')->subject
                                    ($subject);
                                $message->from('no-reply@nyayomat.com','Nyayomat');
                                });


                                    return response()->json([
                                        "status" => true,
                                        "message" => "Asset request successfully submitted",
                                    ], 200);
                                } else {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "Something went wrong",
                                    ], 200);
                                }
                            } else {
                                return response()->json([
                                    "status" => true,
                                    "message" => "Something went wrong",
                                ], 200);
                            }
                        } else {
                            return response()->json([
                                "status" => true,
                                "message" => "Insufficient funds to request this asset",
                            ], 200);
                        }
                    } else {
                        return response()->json([
                            "status" => true,
                            "message" => "Something went wrong",
                        ], 200);
                    }
                } else {
                    return response()->json([
                        "status" => true,
                        "message" => "Assets not available in stock of your requested units :(",
                    ], 200);
                }
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "Asset not available :(",
                ], 200);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => true,
                "message" => "Something went wrong",
            ], 204);
        }
    }

    public function orderAssetStatus($id, $user_id, $status)
    {
        try {
            $is_exist = MerchantAssetOrder::where("id", $id)->first();
            $start_date = Carbon::now("Africa/Nairobi")->addDays($is_exist->holiday_provision);
            if ($is_exist) {
                $merchant_asset = MerchantAsset::where("id", $is_exist->asset_id)->first();
                $asset = Asset::where("id", $is_exist->asset_id)->first();
                if ($status == "delivered") {
                    if (($merchant_asset->units - $is_exist->units) >= 0 && ($asset->units - $is_exist->units) >= 0) {

                        $installment_dates = array();
                        if ($is_exist->payment_frequency == "Daily") {
                            $installment_date = $start_date;
                            for ($i = 1; $i <= ($is_exist->installment); $i++) {
                                $installment_dates[] = $installment_date->toDateString();
                                $installment_date = $installment_date->addDays(1);
                            }
                        } else if ($is_exist->payment_frequency == "Weekly") {
                            $installment_date = $start_date;
                            for ($i = 1; $i <= ($is_exist->installment); $i++) {
                                $installment_dates[] = $installment_date->toDateString();
                                $installment_date = $installment_date->addDays(7);
                            }
                        } else if ($is_exist->payment_frequency == "Monthly") {
                            $installment_date = $start_date;
                            for ($i = 1; $i <= ($is_exist->installment); $i++) {
                                $installment_dates[] = $installment_date->toDateString();
                                $installment_date = $installment_date->addDays(30);
                            }
                        }

                        $asset_provider_installment_dates = array();
                        if ($asset->payment_frequency == "Daily") {
                            $asset_provider_installment_date = $start_date;
                            for ($i = 1; $i <= ($asset->installment); $i++) {
                                $asset_provider_installment_dates[] = $asset_provider_installment_date->toDateString();
                                $asset_provider_installment_date = $asset_provider_installment_date->addDays(1);
                            }
                        } else if ($asset->payment_frequency == "Weekly") {
                            $asset_provider_installment_date = $start_date;
                            for ($i = 1; $i <= ($asset->installment); $i++) {
                                $asset_provider_installment_dates[] = $asset_provider_installment_date->toDateString();
                                $asset_provider_installment_date = $asset_provider_installment_date->addDays(7);
                            }
                        } else if ($asset->payment_frequency == "Monthly") {
                            $asset_provider_installment_date = $start_date;
                            for ($i = 1; $i <= ($asset->installment); $i++) {
                                $asset_provider_installment_dates[] = $asset_provider_installment_date->toDateString();
                                $asset_provider_installment_date = $asset_provider_installment_date->addDays(30);
                            }
                        }

                        $asset_provider_transaction = new AssetProviderTransaction();
                        $asset_provider_transaction->asset_provider_id = $asset->asset_provider_id;
                        $asset_provider_transaction->asset_id = $asset->id;
                        $asset_provider_transaction->due_date = Carbon::now("Africa/Nairobi")->toDateString();
                        $asset_provider_transaction->type = "deposit";
                        $asset_provider_transaction->amount = ($is_exist->units * $asset->deposit_amount);
                        if ($asset_provider_transaction->save()) {
                            $asset->total_out_standing_amount = $asset->total_out_standing_amount + ($is_exist->units * $asset->unit_cost);

                            foreach ($asset_provider_installment_dates as $single_date) {
                                $asset_provider_transaction = new AssetProviderTransaction();
                                $asset_provider_transaction->asset_provider_id = $asset->asset_provider_id;
                                $asset_provider_transaction->asset_id = $asset->id;
                                $asset_provider_transaction->due_date = $single_date;
                                $asset_provider_transaction->type = "installment";
                                $asset_provider_transaction->amount = ((($is_exist->units) * ($asset->unit_cost - $asset->deposit_amount)) / ($asset->installment));
                                $asset_provider_transaction->save();
                            }
                        } else {
                            return response()->json([
                                "status" => true,
                                "message" => "Something went wrong",
                            ], 204);
                        }

                        $transaction = new MerchantTransaction();
                        $transaction->order_id = $is_exist->id;
                        $transaction->asset_id = $is_exist->asset_id;
                        $transaction->merchant_id = $user_id;
                        $transaction->due_date = Carbon::now("Africa/Nairobi")->toDateString();
                        $transaction->paid_on = Carbon::now("Africa/Nairobi")->toDateString();
                        $transaction->type = "deposit";
                        $transaction->amount = ($is_exist->units * $is_exist->deposit_amount);
                        if ($transaction->save()) {
                            $is_exist->total_out_standing_amount = $is_exist->units * ($is_exist->unit_cost - $is_exist->deposit_amount);

                            foreach ($installment_dates as $single_date) {
                                $transaction = new MerchantTransaction();
                                $transaction->order_id = $is_exist->id;
                                $transaction->asset_id = $is_exist->asset_id;
                                $transaction->merchant_id = $user_id;
                                $transaction->due_date = $single_date;
                                $transaction->type = "installment";
                                $transaction->amount = ((($is_exist->units) * ($is_exist->unit_cost - $is_exist->deposit_amount)) / ($is_exist->installment));
                                $transaction->save();
                            }
                        } else {
                            return response()->json([
                                "status" => true,
                                "message" => "Something went wrong",
                            ], 204);
                        }

                        $merchant_asset->units = $merchant_asset->units - $is_exist->units;
                        $merchant_asset->save();
                        $asset->units = $asset->units - $is_exist->units;
                        $asset->save();

                    }
                    $merchant = User::select('users.*', 'shops.name as shop_name')->where("users.id",$user_id)->join('shops', 'shops.owner_id', 'users.id')->first();
                        $asset_provider_data = AssetProvider::where('id',$is_exist->asset_provider_id)->first();

                        $subject = "Nyayomat Order # ".$is_exist->id . " Receipt";
                        $merchant_email = $merchant->email;

                        $merchant_mail_data = array(
                            "order_id" => $is_exist->id,
                            "asset_provider_shop_name" => $asset_provider_data->shop_name,
                            "merchant_shop_name" => $merchant->shop_name,
                            "asset_provider_contact" => $asset_provider_data->phone,
                            "asset_name" => $merchant_asset->asset_name,
                            "units" => $is_exist->units,
                            "unit_price" => $is_exist->unit_cost,
                            "total_cost" => $is_exist->units * $is_exist->unit_cost,
                            "location" => $asset_provider_data->location ? $asset_provider_data->location : '',
                            "sub_county" => $asset_provider_data->sub_county ?  $asset_provider_data->sub_county : '', 
                            "county" => $asset_provider_data->county ? $asset_provider_data->county : '',
                        );

                        // Merchant Mails 
                            
                        Mail::send('acp.mail.merchant_confirmed_order', $merchant_mail_data, function($message) use ($subject , $merchant_email) {
                        $message->to($merchant_email)->subject
                            ($subject);
                            $message->from('no-reply@nyayomat.com','Nyayomat');
                        });

                        Mail::send('acp.mail.merchant_confirmed_order', $merchant_mail_data, function($message) use ($subject) {
                            $message->to('no-reply@nyayomat.com')->subject
                            ($subject);
                            $message->from('no-reply@nyayomat.com','Nyayomat');
                        });

                        $city = City::where('id', $merchant->city)->first();
                        $region = Region::where('id', $merchant->region)->first();
                        $location = Location::where('id',$merchant->location)->first();

                        $asset_provider_mail_data = array(
                            "order_id" => $is_exist->id,
                            "asset_provider_shop_name" => $asset_provider_data->shop_name,
                            "merchant_shop_name" => $merchant->shop_name,
                            "merchant_contact" => $merchant->mobile,
                            "asset_name" =>  $merchant_asset->asset_name,
                            "units" => $is_exist->units,
                            "unit_price" => $is_exist->unit_cost,
                            "total_cost" => $is_exist->units * $is_exist->unit_cost,
                            "location" => $location ? $location->name : '',
                            "region" => $region ?  $region->name : '', 
                            "city" => $city ? $city->name : '',
                        );

                        $asset_provider_email = $asset_provider_data->email;
                        // Asset Provider Mails
                        Mail::send('acp.mail.asset_provider_confirmed_order', $asset_provider_mail_data, function($message) use ($subject , $asset_provider_email) {
                        $message->to($asset_provider_email)->subject
                            ($subject);
                            $message->from('no-reply@nyayomat.com','Nyayomat');
                        });

                        Mail::send('acp.mail.asset_provider_confirmed_order', $asset_provider_mail_data, function($message) use ($subject) {
                            $message->to('no-reply@nyayomat.com')->subject
                            ($subject);
                            $message->from('no-reply@nyayomat.com','Nyayomat');
                        });
                } else {
                    $user = User::where("id", $user_id)->first();
                    $user->account_balance = $user->account_balance + ($is_exist->units * $is_exist->deposit_amount);
                    $user->save();

                    $merchant = User::select('users.*', 'shops.name as shop_name')->where("users.id",$user_id)->join('shops', 'shops.owner_id', 'users.id')->first();
                        $asset_provider_data = AssetProvider::where('id',$is_exist->asset_provider_id)->first();

                        $subject = "Nyayomat Order # ".$is_exist->id . " Cancellation";
                        $merchant_email = $merchant->email;

                        $merchant_mail_data = array(
                            "order_id" => $is_exist->id,
                            "asset_provider_shop_name" => $asset_provider_data->shop_name,
                            "merchant_shop_name" => $merchant->shop_name,
                            "asset_provider_contact" => $asset_provider_data->phone,
                            "asset_name" => $merchant_asset->asset_name,
                            "units" => $is_exist->units,
                            "unit_price" => $is_exist->unit_cost,
                            "total_cost" => $is_exist->units * $is_exist->unit_cost,
                            "location" => $asset_provider_data->location ? $asset_provider_data->location : '',
                            "sub_county" => $asset_provider_data->sub_county ?  $asset_provider_data->sub_county : '', 
                            "county" => $asset_provider_data->county ? $asset_provider_data->county : '',
                        );
                            
                        Mail::send('acp.mail.merchant_cancelled_order', $merchant_mail_data, function($message) use ($subject , $merchant_email) {
                            $message->to($merchant_email)->subject
                                ($subject);
                            $message->from('no-reply@nyayomat.com','Nyayomat');
                        });

                        Mail::send('acp.mail.merchant_cancelled_order', $merchant_mail_data, function($message) use ($subject) {
                            $message->to('no-reply@nyayomat.com')->subject
                                ($subject);
                            $message->from('no-reply@nyayomat.com','Nyayomat');
                        });

                        $city = City::where('id', $merchant->city)->first();
                        $region = Region::where('id', $merchant->region)->first();
                        $location = Location::where('id',$merchant->location)->first();

                        $asset_provider_mail = array(
                            "order_id" => $is_exist->id,
                            "asset_provider_shop_name" => $asset_provider_data->shop_name,
                            "merchant_shop_name" => $merchant->shop_name,
                            "merchant_contact" => $merchant->mobile,
                            "asset_name" =>  $merchant_asset->asset_name,
                            "units" => $is_exist->units,
                            "unit_price" => $is_exist->unit_cost,
                            "total_cost" => $is_exist->units * $is_exist->unit_cost,
                            "location" => $location ? $location->name : '',
                            "region" => $region ?  $region->name : '', 
                            "city" => $city ? $city->name : '',
                        );
                        $asset_provider_email = $asset_provider_data->email;
                        Mail::send('acp.mail.asset_provider_cancelled_order', $asset_provider_mail, function($message) use ($subject , $asset_provider_email) {
                            $message->to($asset_provider_email)->subject
                                ($subject);
                            $message->from('no-reply@nyayomat.com','Nyayomat');
                        });

                        Mail::send('acp.mail.asset_provider_cancelled_order', $asset_provider_mail, function($message) use ($subject) {
                            $message->to('no-reply@nyayomat.com')->subject
                                ($subject);
                            $message->from('no-reply@nyayomat.com','Nyayomat');
                        });
                }
            }
            $is_exist->status = $status;
            if ($is_exist->save()) {
                return response()->json([
                    "status" => true,
                    "message" => "Asset status updated successfully",
                ], 200);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "Something went wrong",
                ], 204);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
            ], 204);
        }
    }

    public function paymentStats($id)
    {
        try {
            $today_date = Carbon::now("Africa/Nairobi")->toDateString();

            $total_due_amount = MerchantTransaction::where("merchant_id", $id)
                ->whereDate('due_date', $today_date)
                ->wherenull("paid_on")
                ->sum("amount");

            $total_pending_amount = MerchantTransaction::where("merchant_id", $id)
                ->whereDate('due_date', now("Africa/Nairobi")->subDays(1))
                ->wherenull("paid_on")
                ->sum("amount");


            $total_over_due_amount = MerchantTransaction::where("merchant_id", $id)
                ->whereDate('due_date', now("Africa/Nairobi")->subDays(2))
                ->wherenull("paid_on")
                ->sum("amount");

            $total_past_over_due_amount = MerchantTransaction::where("merchant_id", $id)
                ->whereDate('due_date', now("Africa/Nairobi")->subDays(3))
                ->wherenull("paid_on")
                ->sum("amount");

            $total_defaulted_amount = MerchantTransaction::where("merchant_id", $id)
                ->whereDate('due_date', '<=', now("Africa/Nairobi")->subDays(4))
                ->wherenull("paid_on")
                ->sum("amount");

            return response()->json([
                "status" => true,
                "due_today" => $total_due_amount,
                "pending" => $total_pending_amount,
                "over_due" => $total_over_due_amount,
                "past_over_due" => $total_past_over_due_amount,
                "defaulted" => $total_defaulted_amount,
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
            ], 204);
        }
    }

    public function payAll($id, $type)
    {
        try {
            $today_date = Carbon::now("Africa/Nairobi")->toDateString();

            if ($type == "today") {

                $total_due_amount = MerchantTransaction::where("merchant_id", $id)
                    ->whereDate('due_date', $today_date)
                    ->wherenull("paid_on")
                    ->sum("amount");

                $get_balance = User::select("account_balance")->where("id", $id)->first();


                if ($get_balance->account_balance >= $total_due_amount) {
                    $total_due_invoice = MerchantTransaction::where("merchant_id", $id)
                        ->where("due_date", "=", $today_date)
                        ->wherenull("paid_on")
                        ->pluck("id");

                    MerchantTransaction::whereIn("id", $total_due_invoice)
                        ->update([
                            "paid_on" => $today_date
                        ]);
                    User::where('id', $id)->update([
                        'account_balance' => $get_balance->account_balance - $total_due_amount
                    ]);

                    foreach ($total_due_invoice as $invoice_id) {
                        $specific_invoice = MerchantTransaction::where("merchant_id", $id)
                            ->where('id', $invoice_id)
                            ->first();


                        $order = MerchantAssetOrder::where("id", $specific_invoice->order_id)->first();
                        $order->total_out_standing_amount = $order->total_out_standing_amount - $specific_invoice->amount;
                        $order->save();
                    }




                    return response()->json([
                        "status" => true,
                        "message" => "Successfully Paid :)",
                    ], 200);
                } else {
                    return response()->json([
                        "status" => true,
                        "message" => "You have insufficient funds to pay.",
                    ], 200);
                }
            } else if ($type == "pending") {

                $total_pending_amount = MerchantTransaction::where("merchant_id", $id)
                    ->whereDate('due_date', now("Africa/Nairobi")->subDays(1))
                    ->wherenull("paid_on")
                    ->sum("amount");

                $get_balance = User::select("account_balance")->where("id", $id)->first();


                if ($get_balance->account_balance >= $total_pending_amount) {
                    $total_pending_invoice = MerchantTransaction::where("merchant_id", $id)
                        ->whereDate('due_date', now("Africa/Nairobi")->subDays(1))
                        ->wherenull("paid_on")
                        ->pluck("id");

                    MerchantTransaction::whereIn("id", $total_pending_invoice)
                        ->update([
                            "paid_on" => $today_date
                        ]);

                    User::where('id', $id)->update([
                        'account_balance' => $get_balance->account_balance - $total_pending_amount
                    ]);

                    foreach ($total_pending_invoice as $invoice_id) {
                        $specific_invoice = MerchantTransaction::where("merchant_id", $id)
                            ->where('id', $invoice_id)
                            ->first();


                        $order = MerchantAssetOrder::where("id", $specific_invoice->order_id)->first();
                        $order->total_out_standing_amount = $order->total_out_standing_amount - $specific_invoice->amount;
                        $order->save();
                    }
                    return response()->json([
                        "status" => true,
                        "message" => "Successfully Paid :)",
                    ], 200);
                } else {
                    return response()->json([
                        "status" => true,
                        "message" => "You have insufficient funds to pay.",
                    ], 200);
                }
            } else if ($type == "over_due") {

                $total_over_due_amount = MerchantTransaction::where("merchant_id", $id)
                    ->whereDate('due_date', now("Africa/Nairobi")->subDays(2))
                    ->wherenull("paid_on")
                    ->sum("amount");

                $get_balance = User::select("account_balance")->where("id", $id)->first();


                if ($get_balance->account_balance >= $total_over_due_amount) {
                    $total_over_due_invoice = MerchantTransaction::where("merchant_id", $id)
                        ->whereDate('due_date', now("Africa/Nairobi")->subDays(2))
                        ->wherenull("paid_on")
                        ->pluck("id");

                    MerchantTransaction::whereIn("id", $total_over_due_invoice)
                        ->update([
                            "paid_on" => $today_date
                        ]);

                    User::where('id', $id)->update([
                        'account_balance' => $get_balance->account_balance - $total_over_due_amount
                    ]);

                    foreach ($total_over_due_invoice as $invoice_id) {
                        $specific_invoice = MerchantTransaction::where("merchant_id", $id)
                            ->where('id', $invoice_id)
                            ->first();


                        $order = MerchantAssetOrder::where("id", $specific_invoice->order_id)->first();
                        $order->total_out_standing_amount = $order->total_out_standing_amount - $specific_invoice->amount;
                        $order->save();
                    }
                    return response()->json([
                        "status" => true,
                        "message" => "Successfully Paid :)",
                    ], 200);
                } else {
                    return response()->json([
                        "status" => true,
                        "message" => "You have insufficient funds to pay.",
                    ], 200);
                }
            } else if ($type == "past_over_due") {

                $total_past_over_due_amount = MerchantTransaction::where("merchant_id", $id)
                    ->whereDate('due_date', now("Africa/Nairobi")->subDays(3))
                    ->wherenull("paid_on")
                    ->sum("amount");
                
                $get_balance = User::select("account_balance")->where("id", $id)->first();


                if ($get_balance->account_balance >= $total_past_over_due_amount) {
                    $total_past_over_due_invoice = MerchantTransaction::where("merchant_id", $id)
                        ->whereDate('due_date', now("Africa/Nairobi")->subDays(3))
                        ->wherenull("paid_on")
                        ->pluck("id");

                    MerchantTransaction::whereIn("id", $total_past_over_due_invoice)
                        ->update([
                            "paid_on" => $today_date
                        ]);
                    User::where('id', $id)->update([
                        'account_balance' => $get_balance->account_balance - $total_past_over_due_amount
                    ]);

                    foreach ($total_past_over_due_invoice as $invoice_id) {
                        $specific_invoice = MerchantTransaction::where("merchant_id", $id)
                            ->where('id', $invoice_id)
                            ->first();


                        $order = MerchantAssetOrder::where("id", $specific_invoice->order_id)->first();
                        $order->total_out_standing_amount = $order->total_out_standing_amount - $specific_invoice->amount;
                        $order->save();
                    }
                    return response()->json([
                        "status" => true,
                        "message" => "Successfully Paid :)",
                    ], 200);
                } else {
                    return response()->json([
                        "status" => true,
                        "message" => "You have insufficient funds to pay.",
                    ], 200);
                }
            } else if ($type == "defaulted") {

                $total_defaulted_amount = MerchantTransaction::where("merchant_id", $id)
                    ->whereDate('due_date', '<=', now("Africa/Nairobi")->subDays(4))
                    ->wherenull("paid_on")
                    ->sum("amount");

                $get_balance = User::where("id", $id)->first();


                if ($get_balance->account_balance >= $total_defaulted_amount) {
                    $total_defaulted_invoice = MerchantTransaction::where("merchant_id", $id)
                        ->whereDate('due_date', '<=', now("Africa/Nairobi")->subDays(4))
                        ->wherenull("paid_on")
                        ->pluck("id");

                    MerchantTransaction::whereIn("id", $total_defaulted_invoice)
                        ->update([
                            "paid_on" => $today_date
                        ]);
                    User::where('id', $id)->update([
                        'account_balance' => $get_balance->account_balance - $total_defaulted_amount
                    ]);
                    foreach ($total_defaulted_invoice as $invoice_id) {
                        $specific_invoice = MerchantTransaction::where("merchant_id", $id)
                            ->where('id', $invoice_id)
                            ->first();


                        $order = MerchantAssetOrder::where("id", $specific_invoice->order_id)->first();
                        $order->total_out_standing_amount = $order->total_out_standing_amount - $specific_invoice->amount;
                        $order->save();
                    }
                    return response()->json([
                        "status" => true,
                        "message" => "Successfully Paid :)",
                    ], 200);
                } else {
                    return response()->json([
                        "status" => true,
                        "message" => "You have insufficient funds to pay.",
                    ], 200);
                }
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Something went wrong",
                ], 200);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
            ], 200);
        }
    }

    public function paymentConfirmation($id, $type)
    {
        $today_date = Carbon::now("Africa/Nairobi")->toDateString();
        $transactions = MerchantTransaction::where("merchant_id", $id)
            ->wherenull("paid_on")
            ->groupBy("order_id")
            ->selectRaw("order_id, count(*) as total_due_count")
            ->where("due_date", "<", $today_date)
            ->get();

        if ($type == "today") {

            $total_due_id =  MerchantTransaction::where("merchant_id", $id)
                ->whereDate('due_date', $today_date)
                ->wherenull("paid_on")
                ->pluck("order_id");

            $total_due_amount = MerchantTransaction::where("merchant_id", $id)
                ->whereDate('due_date', $today_date)
                ->wherenull("paid_on")
                ->sum("amount");

            $data = MerchantTransaction::where("tbl_acp_merchant_transaction.merchant_id", $id)
                ->join("tbl_acp_merchant_asset_order", "tbl_acp_merchant_asset_order.asset_id", "tbl_acp_merchant_transaction.asset_id")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->whereIn('tbl_acp_merchant_transaction.order_id', $total_due_id)
                ->whereDate('due_date', $today_date)
                ->wherenull("paid_on")
                ->groupBy("tbl_acp_merchant_transaction.order_id")
                ->select("tbl_acp_merchant_transaction.id", "tbl_acp_assets.asset_name as asset_name", "tbl_acp_assets.image as image", "tbl_acp_merchant_transaction.amount", "tbl_acp_merchant_asset_order.units", "tbl_acp_merchant_asset_order.unit_cost")
                ->get();

            if (count($data) > 0) {
                return response()->json([
                    "status" => true,
                    "data" => $data,
                    "total" => $total_due_amount,
                ], 200);
            } else {
                return response()->json([
                    "status" => false,
                    "data" => $data,
                    "total" => $total_due_amount,
                ], 204);
            }
        } else if ($type == "pending") {

            $total_pending_id = MerchantTransaction::where("merchant_id", $id)
                ->whereDate('due_date', now("Africa/Nairobi")->subDays(1))
                ->wherenull("paid_on")
                ->pluck("order_id");

            $total_pending_amount = MerchantTransaction::where("merchant_id", $id)
                ->whereIn("order_id", $total_pending_id)
                ->where("due_date", "<", $today_date)
                ->wherenull("paid_on")
                ->sum("amount");

            $data = MerchantTransaction::where("tbl_acp_merchant_transaction.merchant_id", $id)
                ->join("tbl_acp_merchant_asset_order", "tbl_acp_merchant_asset_order.asset_id", "tbl_acp_merchant_transaction.asset_id")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->whereIn("tbl_acp_merchant_transaction.order_id", $total_pending_id)
                ->whereDate('due_date', now("Africa/Nairobi")->subDays(1))
                ->wherenull("paid_on")
                ->groupBy("tbl_acp_merchant_transaction.order_id")
                ->select("tbl_acp_merchant_transaction.id", "tbl_acp_assets.asset_name as asset_name", "tbl_acp_assets.image as image", "tbl_acp_merchant_transaction.amount", "tbl_acp_merchant_asset_order.units", "tbl_acp_merchant_asset_order.unit_cost")
                ->get();

            if (count($data) > 0) {
                return response()->json([
                    "status" => true,
                    "data" => $data,
                    "total" => $total_pending_amount,
                ], 200);
            } else {
                return response()->json([
                    "status" => false,
                    "data" => $data,
                    "total" => $total_pending_amount,
                ], 204);
            }
        } else if ($type == "over_due") {

            $total_over_due_id = MerchantTransaction::where("merchant_id", $id)
                ->whereDate('due_date', now("Africa/Nairobi")->subDays(2))
                ->wherenull("paid_on")
                ->pluck("order_id");

            $total_over_due_amount = MerchantTransaction::where("merchant_id", $id)
                ->whereIn("order_id", $total_over_due_id)
                ->whereDate('due_date', now("Africa/Nairobi")->subDays(2))
                ->wherenull("paid_on")
                ->sum("amount");

            $data = MerchantTransaction::where("tbl_acp_merchant_transaction.merchant_id", $id)
                ->join("tbl_acp_merchant_asset_order", "tbl_acp_merchant_asset_order.asset_id", "tbl_acp_merchant_transaction.asset_id")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->whereIn("tbl_acp_merchant_transaction.order_id", $total_over_due_id)
                ->whereDate('due_date', now("Africa/Nairobi")->subDays(2))
                ->wherenull("paid_on")
                ->groupBy("tbl_acp_merchant_transaction.order_id")
                ->select("tbl_acp_merchant_transaction.id", "tbl_acp_assets.asset_name as asset_name", "tbl_acp_assets.image as image", "tbl_acp_merchant_transaction.amount", "tbl_acp_merchant_asset_order.units", "tbl_acp_merchant_asset_order.unit_cost")
                ->get();

            if (count($data) > 0) {
                return response()->json([
                    "status" => true,
                    "data" => $data,
                    "total" => $total_over_due_amount,
                ], 200);
            } else {
                return response()->json([
                    "status" => false,
                    "data" => $data,
                    "total" => $total_over_due_amount,
                ], 204);
            }
        } else if ($type == "past_over_due") {
            $total_past_over_due_id = MerchantTransaction::where("merchant_id", $id)
                ->whereDate('due_date', now("Africa/Nairobi")->subDays(3))
                ->wherenull("paid_on")
                ->pluck("order_id");

            $total_past_over_due_amount = MerchantTransaction::where("merchant_id", $id)
                ->whereIn("order_id", $total_past_over_due_id)
                ->whereDate('due_date', now("Africa/Nairobi")->subDays(3))
                ->wherenull("paid_on")
                ->sum("amount");

            $data = MerchantTransaction::where("tbl_acp_merchant_transaction.merchant_id", $id)
                ->join("tbl_acp_merchant_asset_order", "tbl_acp_merchant_asset_order.asset_id", "tbl_acp_merchant_transaction.asset_id")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->whereIn("tbl_acp_merchant_transaction.order_id", $total_past_over_due_id)
                ->whereDate('due_date', now("Africa/Nairobi")->subDays(3))
                ->wherenull("paid_on")
                ->groupBy("tbl_acp_merchant_transaction.order_id")
                ->select("tbl_acp_merchant_transaction.id", "tbl_acp_assets.asset_name as asset_name", "tbl_acp_assets.image as image", "tbl_acp_merchant_transaction.amount", "tbl_acp_merchant_asset_order.units", "tbl_acp_merchant_asset_order.unit_cost")
                ->get();

            if (count($data) > 0) {
                return response()->json([
                    "status" => true,
                    "data" => $data,
                    "total" => $total_past_over_due_amount,
                ], 200);
            } else {
                return response()->json([
                    "status" => false,
                    "data" => $data,
                    "total" => $total_past_over_due_amount,
                ], 204);
            }
        } else if ($type == "defaulted") {

            $total_defaulted_id = MerchantTransaction::where("merchant_id", $id)
                ->whereDate('due_date', '<=', now("Africa/Nairobi")->subDays(4))
                ->wherenull("paid_on")
                ->pluck("order_id");

            $total_defaulted_amount = MerchantTransaction::where("merchant_id", $id)
                ->whereIn("order_id", $total_defaulted_id)
                ->whereDate('due_date', '<=', now("Africa/Nairobi")->subDays(4))
                ->wherenull("paid_on")
                ->sum("amount");
            $data = MerchantTransaction::where("tbl_acp_merchant_transaction.merchant_id", $id)
                ->join("tbl_acp_merchant_asset_order", "tbl_acp_merchant_asset_order.asset_id", "tbl_acp_merchant_transaction.asset_id")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->whereIn("tbl_acp_merchant_transaction.order_id", $total_defaulted_id)
                ->whereDate('due_date', '<=', now("Africa/Nairobi")->subDays(4))
                ->wherenull("paid_on")
                ->groupBy("tbl_acp_merchant_transaction.order_id")
                ->select("tbl_acp_merchant_transaction.id", "tbl_acp_assets.asset_name as asset_name", "tbl_acp_assets.image as image", "tbl_acp_merchant_transaction.amount", "tbl_acp_merchant_asset_order.units", "tbl_acp_merchant_asset_order.unit_cost")
                ->get();

            if (count($data) > 0) {
                return response()->json([
                    "status" => true,
                    "data" => $data,
                    "total" => $total_defaulted_amount,
                ], 200);
            } else {
                return response()->json([
                    "status" => false,
                    "data" => $data,
                    "total" => $total_defaulted_amount,
                ], 204);
            }
        }
    }

    public function payNow($invoice_id, $merchant_id)
    {
        try {
            $transaction = MerchantTransaction::where("id", $invoice_id)->first();

            $merchant = User::where('id', $merchant_id)->first();
            if ($merchant) {
                if ($merchant->account_balance >= $transaction->amount) {
                    $order = MerchantAssetOrder::where("id", $transaction->order_id)->first();
                    $transaction->paid_on = Carbon::now("Africa/Nairobi")->toDateString();
                    if ($transaction->save()) {
                        $merchant->account_balance = $merchant->account_balance - $transaction->amount;
                        $merchant->save();
                        $order->total_out_standing_amount = $order->total_out_standing_amount - $transaction->amount;
                        if ($order->save()) {
                            return response()->json([
                                "status" => true,
                                "message" => "Successfully Paid :)",
                            ], 200);
                        } else {
                            return response()->json([
                                "status" => true,
                                "message" => "Something went wrong :(",
                            ], 200);
                        }
                    } else {
                        return response()->json([
                            "status" => true,
                            "message" => "Something went wrong :(",
                        ], 200);
                    }
                } else {
                    return response()->json([
                        "status" => true,
                        "message" => "You have insufficient funds to pay this invoice.",
                    ], 200);
                }
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "Something went wrong :(",
                ], 200);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => true,
                "message" => "Something went wrong :(",
            ], 204);
        }
    }

    public function myAssets($id)
    {
        try {

            $ongoing_info = MerchantTransaction::where("merchant_id", $id)
                ->wherenull("paid_on")
                ->selectRaw("sum(amount) as amount, count(*) as payments_left, due_date as next_payment")
                ->first();


            $defaulted_info = MerchantTransaction::where("merchant_id", $id)
                ->whereDate('due_date', '<=', now("Africa/Nairobi")->subDays(4))
                ->wherenull("paid_on")
                ->selectRaw("sum(amount) as amount, count(*) as missed_payments, due_date as next_payment")
                ->first();

            $is_completed = MerchantAssetOrder::where("merchant_id", $id)
                ->where("status", "delivered")
                ->where("total_out_standing_amount", 0)
                ->pluck("id");

            $completed_info = MerchantTransaction::where("merchant_id", $id)
                ->whereIn("order_id", $is_completed)
                ->selectRaw("sum(amount) as amount, count(*) as total_payments, due_date as next_payment")
                ->first();
            return response()->json([
                "status" => true,
                "ongoing_info" => $ongoing_info,
                "defaulted_info" => $defaulted_info,
                "completed_info" => $completed_info,
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
            ], 204);
        }
    }

    public function ongoingAssetStats($id)
    {
        try {

            $data = MerchantTransaction::where("tbl_acp_merchant_transaction.merchant_id", $id)
                ->wherenull("paid_on")
                ->join("tbl_acp_merchant_assets", "tbl_acp_merchant_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->join("tbl_acp_merchant_asset_order", "tbl_acp_merchant_asset_order.id", "tbl_acp_merchant_transaction.order_id")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->groupBy('tbl_acp_merchant_transaction.order_id')
                ->selectRaw("tbl_acp_merchant_transaction.asset_id,tbl_acp_merchant_assets.asset_name, tbl_acp_assets.image,tbl_acp_merchant_asset_order.total_out_standing_amount as total_out_standing_amount,tbl_acp_merchant_asset_order.deposit_amount as deposit_amount,tbl_acp_merchant_asset_order.units as units,tbl_acp_merchant_asset_order.unit_cost as unit_cost,tbl_acp_merchant_asset_order.installment as installment,tbl_acp_merchant_asset_order.payment_frequency as payment_frequency, sum(tbl_acp_merchant_transaction.amount) as amount, count(*) as payments_left")
                ->get();

            if (count($data) > 0) {
                return response()->json([
                    "status" => true,
                    "data" => $data,
                ], 200);
            } else {
                return response()->json([
                    "status" => true,
                    "data" => $data,
                ], 204);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => $ex->getMessage(),
            ], 204);
        }
    }

    public function defaultedAssetStats($id)
    {
        try {
            $defaulted_info = MerchantTransaction::where("merchant_id", $id)
                ->whereDate('due_date', '<=', now("Africa/Nairobi")->subDays(4))
                ->wherenull("paid_on")
                ->pluck("order_id");

            $data = MerchantTransaction::where("tbl_acp_merchant_transaction.merchant_id", $id)
                ->whereIn("tbl_acp_merchant_transaction.order_id", $defaulted_info)
                ->wherenull("paid_on")
                ->join("tbl_acp_merchant_assets", "tbl_acp_merchant_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->join("tbl_acp_merchant_asset_order", "tbl_acp_merchant_asset_order.id", "tbl_acp_merchant_transaction.order_id")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->groupBy('tbl_acp_merchant_transaction.order_id')
                ->selectRaw("tbl_acp_merchant_transaction.asset_id,tbl_acp_merchant_assets.asset_name, tbl_acp_assets.image,tbl_acp_merchant_asset_order.total_out_standing_amount as total_out_standing_amount,tbl_acp_merchant_asset_order.deposit_amount as deposit_amount,tbl_acp_merchant_asset_order.units as units,tbl_acp_merchant_asset_order.unit_cost as unit_cost,tbl_acp_merchant_asset_order.installment as installment,tbl_acp_merchant_asset_order.payment_frequency as payment_frequency, sum(tbl_acp_merchant_transaction.amount) as amount, count(*) as payments_left")
                ->get();
            if (count($data) > 0) {
                return response()->json([
                    "status" => true,
                    "data" => $data,
                ], 200);
            } else {
                return response()->json([
                    "status" => true,
                    "data" => $data,
                ], 204);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
            ], 204);
        }
    }

    public function completedAssetStats($id)
    {
        try {

            $is_completed = MerchantAssetOrder::where("merchant_id", $id)
                ->where("status", "delivered")
                ->where("total_out_standing_amount", 0)
                ->pluck("id");
            $data = MerchantTransaction::where("tbl_acp_merchant_transaction.merchant_id", $id)
                ->whereIn("tbl_acp_merchant_transaction.order_id", $is_completed)
                ->groupBy("tbl_acp_merchant_transaction.order_id")
                ->join("tbl_acp_merchant_assets", "tbl_acp_merchant_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->join("tbl_acp_merchant_asset_order", "tbl_acp_merchant_asset_order.id", "tbl_acp_merchant_transaction.order_id")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->selectRaw("tbl_acp_merchant_transaction.asset_id,tbl_acp_merchant_transaction.order_id,tbl_acp_merchant_assets.asset_name, tbl_acp_assets.image,tbl_acp_merchant_asset_order.total_out_standing_amount as total_out_standing_amount,tbl_acp_merchant_asset_order.deposit_amount as deposit_amount,tbl_acp_merchant_asset_order.units as units,tbl_acp_merchant_asset_order.unit_cost as unit_cost,tbl_acp_merchant_asset_order.installment as installment,tbl_acp_merchant_asset_order.payment_frequency as payment_frequency, sum(tbl_acp_merchant_transaction.amount) as amount, count(*) as total_payments")
                ->get();
            if (count($data) > 0) {
                return response()->json([
                    "status" => true,
                    "data" => $data,
                ], 200);
            } else {
                return response()->json([
                    "status" => true,
                    "data" => $data,
                ], 204);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
            ], 204);
        }
    }

    public function completedAssetDetails($order_id)
    {
        try {
            $transactions = MerchantTransaction::where("tbl_acp_merchant_transaction.order_id", $order_id)
                ->get();
            $asset_info = MerchantTransaction::where("tbl_acp_merchant_transaction.order_id", $order_id)
                ->join("tbl_acp_merchant_assets", "tbl_acp_merchant_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->join("tbl_acp_merchant_asset_order", "tbl_acp_merchant_asset_order.id", "tbl_acp_merchant_transaction.order_id")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->selectRaw("tbl_acp_merchant_transaction.asset_id,tbl_acp_merchant_transaction.order_id,tbl_acp_merchant_assets.asset_name, tbl_acp_assets.image,tbl_acp_merchant_asset_order.total_out_standing_amount as total_out_standing_amount,tbl_acp_merchant_asset_order.deposit_amount as deposit_amount,tbl_acp_merchant_asset_order.units as units,tbl_acp_merchant_asset_order.unit_cost as unit_cost,tbl_acp_merchant_asset_order.installment as installment,tbl_acp_merchant_asset_order.payment_frequency as payment_frequency, sum(tbl_acp_merchant_transaction.amount) as amount, count(*) as total_payments")
                ->first();
            if (count($transactions) > 0) {
                return response()->json([
                    "status" => true,
                    "asset_info" => $asset_info,
                    "transactions" => $transactions,
                ], 200);
            } else {
                return response()->json([
                    "status" => true,
                    "asset_info" => $asset_info,
                    "transactions" => $transactions,
                ], 204);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
            ], 204);
        }
    }

    public function transactions($id)
    {
        try {

            $total_receipt = MerchantAssetOrder::where("merchant_id", $id)
                ->where("status", "delivered")
                ->selectRaw("sum(units * unit_cost) as total")
                ->first();

            $total_paid = MerchantTransaction::where("merchant_id", $id)
                ->wherenotnull("paid_on")
                ->sum("amount");

            $asset_id = MerchantAssetOrder::where("merchant_id", $id)
                ->where("status", "delivered")
                ->pluck("asset_id");
            $assets_info = MerchantTransaction::where("tbl_acp_merchant_transaction.merchant_id", $id)
                ->whereIn("tbl_acp_merchant_transaction.asset_id", $asset_id)
                ->wherenotnull("paid_on")
                ->groupBy("tbl_acp_merchant_transaction.order_id")
                ->join("tbl_acp_merchant_assets", "tbl_acp_merchant_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->join("tbl_acp_merchant_asset_order", "tbl_acp_merchant_asset_order.id", "tbl_acp_merchant_transaction.order_id")
                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_transaction.asset_id")
                ->selectRaw("tbl_acp_merchant_transaction.asset_id,tbl_acp_merchant_transaction.order_id as order_id,tbl_acp_merchant_assets.asset_name, tbl_acp_assets.image,sum(tbl_acp_merchant_transaction.amount) as amount")
                ->get();

            if (count($assets_info) > 0) {
                return response()->json([
                    "status" => true,
                    "total_receipt" => $total_receipt,
                    "total_paid" => $total_paid,
                    "assets_info" => $assets_info,
                ], 200);
            } else {
                return response()->json([
                    "status" => true,
                    "total_receipt" => $total_receipt,
                    "total_paid" => $total_paid,
                    "assets_info" => $assets_info,
                ], 204);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => $ex->getMessage(),
            ], 204);
        }
    }

    public function transactionDetails($order_id)
    {
        try {
            $total_paid = MerchantTransaction::where("order_id", $order_id)
                ->wherenotnull("paid_on")
                ->sum("amount");
            $transactions_info = MerchantTransaction::where("order_id", $order_id)
                ->wherenotnull("paid_on")
                ->get();
            if (count($transactions_info) > 0) {
                return response()->json([
                    "status" => true,
                    "total_paid" => $total_paid,
                    "transactions_info" => $transactions_info,
                ], 200);
            } else {
                return response()->json([
                    "status" => true,
                    "total_paid" => $total_paid,
                    "transactions_info" => $transactions_info,
                ], 204);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => $ex->getMessage(),
            ], 204);
        }
    }

    public function getCountries()
    {
        try {
            $cities = City::get();
            if (count($cities) > 0) {
                return response()->json([
                    "status" => true,
                    "cities" => $cities
                ], 200);
            } else {
                return response()->json([
                    "status" => true,
                    "cities" => $cities
                ], 204);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => $ex->getMessage(),
            ], 204);
        }
    }

    public function getRegions($id)
    {
        try {
            $regions = Region::where('city', $id)->get();
            if (count($regions) > 0) {
                return response()->json([
                    "status" => true,
                    "regions" => $regions
                ], 200);
            } else {
                return response()->json([
                    "status" => true,
                    "regions" => $regions
                ], 204);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => $ex->getMessage(),
            ], 204);
        }
    }

    public function getLocations($id)
    {
        try {
            $locations = Location::where('region', $id)->get();
            if (count($locations) > 0) {
                return response()->json([
                    "status" => true,
                    "locations" => $locations
                ], 200);
            } else {
                return response()->json([
                    "status" => true,
                    "locations" => $locations
                ], 204);
            }
        } catch (Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => $ex->getMessage(),
            ], 204);
        }
    }
}
