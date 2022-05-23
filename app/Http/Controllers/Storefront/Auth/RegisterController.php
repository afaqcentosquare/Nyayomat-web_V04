<?php

namespace App\Http\Controllers\Storefront\Auth;

use App\Helpers\Messaging;
use Auth;
use App\City;
use App\Region;
use App\Location;
use App\Customer;
use Illuminate\Http\Request;
use App\Events\Customer\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\Auth\SendVerificationEmail as EmailVerificationNotification;
use AfricasTalking\SDK\AfricasTalking;
use DB;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/customer/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer')->except('verify');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('customer');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:6|confirmed',
            'agree' => 'required',
        ]);
    }
    public function getregion(Request $request){

        $ct = Region::where('city',$request->city)->get();


        foreach($ct as $c){

            echo $html = "<option value='".$c->id."'>".$c->name."</option>";

        }

        // return response($html, 200);

    }

    public function sendotp(Request $request){
        $data = $request->all();

        $mobile = $data['mobile'];

        $otp =  mt_rand(1000, 9999);

        DB::table('otp_list')->insert(array("otp"=>$otp,"mobile"=>$mobile));

        $resp = Messaging::sendMessage($mobile, 'Your OTP is :' .$otp);
        
        if($resp > 0){
            $result['status'] = 'success';
        
            return $result['status'];
        }
        
    }

    public function checkotp(Request $request){
        $data = $request->all();
        $otp = $data['otp'];

        $res = DB::table('otp_list')->where(array("otp"=>$otp))->first();

        if($res->id!=""){
            $result['status'] = 'success';
        
            return $result['status'];
        } else {
            $result['status'] = 'error';
        
            return $result['status'];
        }

        // print_r($res);
    }

    public function getlocation(Request $request){

        $ct = Location::where('region',$request->region)->get();


        foreach($ct as $c){

            echo $html = "<option value='".$c->id."'>".$c->name."</option>";

        }

        // return response($html, 200);

    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if(Auth::guard('web')->check())
            return redirect()->back()->with('error', trans('messages.loogedin_as_admin'));

        $this->validator($request->all())->validate();



        $customer = $this->create($request->all());

        event(new Registered($customer));

        $this->guard('customer')->login($customer);

        return $this->registered($request, $customer)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Customer
     */
    protected function create(array $data)
    {


        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'stripe_id' => $data['stripe_id'],
            'password' => bcrypt($data['password']),
            'verification_token' => str_random(40)
        ]);
    }

    /**
     * Verify the User the given token.
     *
     * @param  string|null  $token
     * @return \Illuminate\Http\Response
     */
    public function verify($token = null)
    {
        if(!$token){
            $customer = Auth::guard('customer')->user();

            $customer->verification_token = str_random(40);

            if($customer->save()){
                $customer->notify(new EmailVerificationNotification($customer));

                return redirect()->back()->with('success', trans('auth.verification_link_sent'));
            }

            return redirect()->back()->with('success', trans('auth.verification_link_sent'));
        }

        try{
            $customer = Customer::where('verification_token', $token)->firstOrFail();

            $customer->verification_token = Null;

            if($customer->save())
                return redirect()->route('account', 'dashboard')->with('success', trans('auth.verification_successful'));

        } catch(\Exception $e){
            return redirect()->route('account', 'dashboard')->with('error', trans('auth.verification_failed'));
        }
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $customer
     * @return mixed
     */
    protected function registered(Request $request, $customer)
    {
        return redirect()->route('account', 'dashboard');
    }
}
