<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Helpers\ListHelper;
use App\State;
use App\Helpers\Payments;
use App\Helpers\Messaging;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\Customer\CustomerRepository;


class CustomerController extends Controller {

    private $customer;
    private $model_name;

    public function __construct(CustomerRepository $customer)
    {
        parent::__construct();

        $this->model_name = trans('app.model.customer');

        $this->customer = $customer;
    }
    public static function getAccountBalance($user_id)
    {
        $cash =  Payments::getAccountBalance($user_id, 2);
        $mpesa =  Payments::getAccountBalance($user_id, 1);
        return response()->json(['cash' => $cash, 'mpesa' => $mpesa], 200);
    }



    public function customerSignup(Request $request)
    {

    // Ignore if the email exists in the database
        $customer = Customer::select('email')->where('email', $request->email)->first();
        if( $customer ){
            return response()->json(['status' => 'Error', 'msg' => 'Customer with the same email address already exists', 'err' => 'Customer Creation Failed: ' . ' E-mail already exists'], 404);
        }else{

        }
        
        try{
        // Create the customer
                $customer = Customer::create([
                    'name' => $request->full_name,
                    'nice_name' => $request->nice_name,
                    'stripe_id' => $request->mobile,
                    'email' => $request->email,
                    'password' => $request->temporary_password,
                    'description' => $request->description,
                    'sex' => strtolower($request->sex),
                    'dob' => date('Y-m-d', strtotime($request->dob)),
                    'accepts_marketing' => strtoupper($request->accepts_marketing) == 'TRUE' ? 1 : 0,
                    'active' => strtoupper($request->active) == 'TRUE' ? 1 : 0,
                ]);

                // Create addresses
                if($request->primary_address_line_1)
                $customer->primaryAddress()->create($this->makeAddress($request, 'primary'));
                if($request->billing_address_line_1)
                $customer->billingAddress()->create($this->makeAddress($request, 'billing'));
                if($request->shipping_address_line_1)
                $customer->shippingAddress()->create($this->makeAddress($request, 'shipping'));

                // Upload featured image
                if ($request->avatar_link)
                $customer->saveImageFromUrl($request->avatar_link);
                return response()->json(['status' => 'success', 'msg' => trans('messages.created', ['model' => $this->model_name])], 201);

        } catch (\Exception $e) {
            $error = new \Illuminate\Support\MessageBag();
            $error->add('error', $e);
            return response()->json(['status' => 'Error', 'msg' => 'Error while creating customer', 'err' => 'Customer Creation Failed: ' . $e->getMessage()], 404);
        

            
        }
        return $customer;
    
    }


    private function makeAddress($data, $type = 'primary')
	{
		$type = strtolower($type);

		$address = [
			'address_title' => ucfirst($type) . ' Address',
			'address_line_1' => $data[$type.'_address_line_1'],
			'address_line_2' => $data[$type.'_address_line_2'],
			'city' => $data[$type.'_address_city'],
			'zip_code' => $data[$type.'_address_zip_code'],
			'phone' => $data[$type.'_address_phone'],
			'latitude' => Null,
			'longitude' => Null,
		];

		// Get the country id
		if($data[$type.'_address_country_code']){
			$country = DB::table('countries')->select(['id','name'])->where('iso_3166_2', strtoupper($data[$type.'_address_country_code']))->first();
		}
		$address['country_id'] = isset($country) && ! empty($country) ? $country->id : config('system_settings.address_default_country');

		// Get the state id
		if($data[$type.'_address_state_name']){
			$states = ListHelper::states($address['country_id']);
			$state_id = array_search(strtolower($data[$type.'_address_state_name']), array_map('strtolower',$states->toArray()));

			if( ! $state_id )
	            $state_id = State::create(['name' => $data[$type.'_address_state_name'], 'country_name' => $country->name, 'country_id' => $country->id])->id;
		}
		$address['state_id'] = isset($state_id) ? $state_id : config('system_settings.address_default_state');

		return $address;
	}
}
