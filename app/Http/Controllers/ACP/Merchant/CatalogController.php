<?php

namespace App\Http\Controllers\ACP\Merchant;

use App\City;
use App\Http\Controllers\Controller;
use App\Location;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Asset;
use App\Models\AssetProvider;
use App\Models\MerchantAsset;
use App\Models\MerchantAssetOrder;
use Carbon\Carbon;
use App\Models\MerchantTransaction;
use App\Models\AssetProviderTransaction;
use App\Region;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Messaging;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = MerchantAsset::select("tbl_acp_merchant_assets.*","tbl_acp_asset_providers.shop_name")
                                ->join("tbl_acp_asset_providers", "tbl_acp_asset_providers.id", "tbl_acp_merchant_assets.asset_provider_id")
                                ->get();
        $asset_request = MerchantAssetOrder::select("tbl_acp_merchant_asset_order.*","tbl_acp_asset_providers.shop_name", "tbl_acp_assets.asset_name")
                                ->where("merchant_id", session("merchant_id"))
                                ->where("tbl_acp_merchant_asset_order.status", "pending")
                                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_asset_order.asset_id")
                                ->join("tbl_acp_asset_providers", "tbl_acp_asset_providers.id", "tbl_acp_merchant_asset_order.asset_provider_id")
                                ->get();  
        $asset_received = MerchantAssetOrder::select("tbl_acp_merchant_asset_order.*","tbl_acp_asset_providers.shop_name", "tbl_acp_assets.asset_name")
                                ->where("merchant_id", session("merchant_id"))
                                ->where("tbl_acp_merchant_asset_order.status", "delivered")
                                ->join("tbl_acp_assets", "tbl_acp_assets.id", "tbl_acp_merchant_asset_order.asset_id")
                                ->join("tbl_acp_asset_providers", "tbl_acp_asset_providers.id", "tbl_acp_merchant_asset_order.asset_provider_id")
                                ->get();  
                                
       // return response()->json($asset_request);
        return view('acp.merchant.catalog.index')
                ->with('assets', $assets)
                ->with('asset_request', $asset_request)
                ->with('asset_received', $asset_received);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $asset = MerchantAsset::select('tbl_acp_merchant_assets.*','tbl_acp_asset_providers.shop_name as asset_provider_shop_name',
            'tbl_acp_asset_providers.email as asset_provider_email','tbl_acp_asset_providers.phone as asset_provider_phone','tbl_acp_asset_providers.location as asset_provider_location'
             ,'tbl_acp_asset_providers.sub_county as asset_provider_sub_county','tbl_acp_asset_providers.county as asset_provider_county')->where("tbl_acp_merchant_assets.id", $request->asset_id)
            ->join('tbl_acp_asset_providers', 'tbl_acp_asset_providers.id','tbl_acp_merchant_assets.asset_provider_id')
            ->first();
            $merchant = User::select('users.*', 'shops.name as shop_name')->where("users.id",session("merchant_id"))->join('shops', 'shops.owner_id', 'users.id')->first();
           
          
            if($asset){
                if($merchant){

                    if($merchant->account_balance >= ($request->units * $asset->deposit_amount)){
                        $order_request = new MerchantAssetOrder();
                        $order_request->merchant_id = session("merchant_id");
                        $order_request->asset_id = $request->asset_id;
                        $order_request->asset_provider_id = $asset->asset_provider_id;
                        $order_request->units = $request->units;
                        $order_request->unit_cost = $asset->unit_cost;
                        $order_request->holiday_provision = $asset->holiday_provision;
                        $order_request->deposit_amount  = $asset->deposit_amount;
                        $order_request->installment  = $asset->installment;
                        $order_request->payment_frequency  = $asset->payment_frequency;
                        $order_request->payment_method = $asset->payment_method;
                        $order_request->total_out_standing_amount = $request->units * $asset->unit_cost;
                        if($order_request->save()){
                            $merchant->account_balance = $merchant->account_balance - ($request->units * $asset->deposit_amount);
                            if($merchant->save()){

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

                                 // Asset Provder SMS
                                Messaging::sendMessage($asset->asset_provider_phone, 
                                "New Order Request!\nDear ".$asset->asset_provider_shop_name.",Kindly check your email for Order ID: ".$order_request->id." details.\nNyayomat: With you, Every step");

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
                                

                                return redirect()->route('merchant.catalog')->withSuccess("Asset request successfully submitted")->withInput();
                            }else{
                                return redirect()->route('merchant.catalog')->withError("Something went wrong")->withInput();
                            }
                            
                        }else{
                            return redirect()->route('merchant.catalog')->withError("Something went wrong")->withInput();
                        }
                    }else{
                        return redirect()->route('merchant.catalog')->withError("Insufficient funds to request this asset")->withInput();
                    }
                    
                }else{
                    return redirect()->route('merchant.catalog')->withError("Something went wrong")->withInput();
                }
            }else{
                return redirect()->route('merchant.catalog')->withError("Asset not available :(")->withInput();
            }
        }catch(Exception $ex){
            return redirect()->route('merchant.catalog')->withError($ex->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateMerchantOrderAssetStatus($id, $status)
    {
        try{
            
            
            $is_exist = MerchantAssetOrder::where("id", $id)->first();
            $start_date = Carbon::now("Africa/Nairobi")->addDays($is_exist->holiday_provision);
            if($is_exist){
                $merchant_asset = MerchantAsset::where("id", $is_exist->asset_id)->first();
                $asset = Asset::where("id", $is_exist->asset_id)->first();
                if($status == "delivered"){
                    if(($merchant_asset->units - $is_exist->units) >=0 && ($asset->units - $is_exist->units) >=0){
                        
                    $installment_dates = array();
                    if($is_exist->payment_frequency == "Daily"){
                        $installment_date = $start_date;
                        for ($i=1; $i<=($is_exist->installment); $i++) {
                            $installment_dates[] = $installment_date->toDateString();
                            $installment_date = $installment_date->addDays(1);
                        } 
                    }else if($is_exist->payment_frequency == "Weekly"){
                        $installment_date = $start_date;
                        for ($i=1; $i<=($is_exist->installment); $i++) { 
                            $installment_dates[] = $installment_date->toDateString();
                            $installment_date = $installment_date->addDays(7);
                        }                
                    }else if($is_exist->payment_frequency == "Monthly"){
                        $installment_date = $start_date;
                        for ($i=1; $i<=($is_exist->installment); $i++) { 
                            $installment_dates[] = $installment_date->toDateString();
                            $installment_date = $installment_date->addDays(30);
                        } 
                    }
                    
                    $start_date_asset_provider = Carbon::now("Africa/Nairobi")->addDays($asset->holiday_provision);
                    $asset_provider_installment_dates = array();
                    if($asset->payment_frequency == "Daily"){
                        $asset_provider_installment_date = $start_date_asset_provider;
                        for ($i=1; $i<=($asset->installment); $i++) {
                            $asset_provider_installment_dates[] = $asset_provider_installment_date->toDateString();
                            $asset_provider_installment_date = $asset_provider_installment_date->addDays(1);
                        }
                        
                    }else if($asset->payment_frequency == "Weekly"){
                        $asset_provider_installment_date = $start_date_asset_provider;
                        for ($i=1; $i<=($asset->installment); $i++) { 
                            $asset_provider_installment_dates[] = $asset_provider_installment_date->toDateString();
                            $asset_provider_installment_date = $asset_provider_installment_date->addDays(7);
                        }                
                    }else if($asset->payment_frequency == "Monthly"){
                        $asset_provider_installment_date = $start_date_asset_provider;
                        for ($i=1; $i<=($asset->installment); $i++) { 
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
                    if($asset_provider_transaction->save()){
                        $asset->total_out_standing_amount = $asset->total_out_standing_amount + ($is_exist->units * $asset->unit_cost);
                        
                        foreach($asset_provider_installment_dates as $single_date){ 
                            $asset_provider_transaction = new AssetProviderTransaction();
                            $asset_provider_transaction->asset_provider_id = $asset->asset_provider_id;
                            $asset_provider_transaction->asset_id = $asset->id;
                            $asset_provider_transaction->due_date = $single_date;
                            $asset_provider_transaction->type = "installment";
                            $asset_provider_transaction->amount = ((($is_exist->units) * ($asset->unit_cost - $asset->deposit_amount))/ ($asset->installment));
                            $asset_provider_transaction->save();
                        }
                    }else{
                        return redirect()->route('merchant.catalog')->withError("something went wrong :(")->withInput();
                    }
                  
                    $transaction = new MerchantTransaction();
                    $transaction->order_id = $is_exist->id;
                    $transaction->asset_id = $is_exist->asset_id;
                    $transaction->merchant_id = session("merchant_id");
                    $transaction->due_date = Carbon::now("Africa/Nairobi")->toDateString();
                    $transaction->paid_on = Carbon::now("Africa/Nairobi")->toDateString();
                    $transaction->type = "deposit";
                    $transaction->amount = ($is_exist->units * $is_exist->deposit_amount);
                    if($transaction->save()){
                        $is_exist->total_out_standing_amount = $is_exist->units * ($is_exist->unit_cost - $is_exist->deposit_amount);
                        
                        foreach($installment_dates as $single_date){ 
                            $transaction = new MerchantTransaction();
                            $transaction->order_id = $is_exist->id;
                            $transaction->asset_id = $is_exist->asset_id;
                            $transaction->merchant_id = session("merchant_id");
                            $transaction->due_date = $single_date;
                            $transaction->type = "installment";
                            $transaction->amount = ((($is_exist->units) * ($is_exist->unit_cost - $is_exist->deposit_amount))/ ($is_exist->installment));
                            $transaction->save();
                        }
                    }else{
                        return redirect()->route('merchant.catalog')->withError("something went wrong :(")->withInput();
                    }
                        
                        $merchant_asset->units = $merchant_asset->units - $is_exist->units;
                        $merchant_asset->save();
                        $asset->units = $asset->units - $is_exist->units;
                        $asset->save();

                        $merchant = User::select('users.*', 'shops.name as shop_name')->where("users.id",session("merchant_id"))->join('shops', 'shops.owner_id', 'users.id')->first();
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
                    }


                }else{


                    $user = User::where("id", session("merchant_id"))->first();
                    $user->account_balance = $user->account_balance + ($is_exist->units * $is_exist->deposit_amount);
                    $user->save();

                        $merchant_asset->units = $merchant_asset->units - $is_exist->units;
                        $merchant_asset->save();
                        $asset->units = $asset->units - $is_exist->units;
                        $asset->save();

                        $merchant = User::select('users.*', 'shops.name as shop_name')->where("users.id",session("merchant_id"))->join('shops', 'shops.owner_id', 'users.id')->first();
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

                        Messaging::sendMessage($asset_provider_data->phone, 
                        "Order Cancellation!!\nDear ".$asset_provider_data->shop_name.", Kindly check your email for Order ID: ".$is_exist->id." cancellation.\nNyayomat: With you, Every step");

                    
                }
            }
            $is_exist->status = $status;
            if($is_exist->save()){
                return redirect()->route('merchant.catalog')->withSuccess("Asset status updated successfully")->withInput();
            }else{
                return redirect()->route('merchant.catalog')->withError("something went wrong :(")->withInput();
            }
        }catch(Exception $ex){
            return redirect()->route('merchant.catalog')->withError($ex->getMessage())->withInput();
        }
    }
}
