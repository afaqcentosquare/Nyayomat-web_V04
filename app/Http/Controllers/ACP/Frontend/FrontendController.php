<?php

namespace App\Http\Controllers\ACP\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Shop;
use Illuminate\Support\Str;
use App\Models\AssetProvider;

class FrontendController extends Controller
{
    //

    public function index()
    {
        $title = "Home";
        return view('ecommerce_frontend.index' , compact('title'));
    }

    public function merchantLoginView()
    {
        return view('ecommerce_frontend.merchant.login');
    }

    public function merchantSignupView()
    {
        return view('ecommerce_frontend.merchant.signup');
        // return view('auth.register');
    }

    public function customerSigninView()
    {
        return view('ecommerce_frontend.customer.signin');
    }

    public function customerSignupView()
    {
        return view('ecommerce_frontend.customer.signup');
    }

    public function partnerSignupView()
    {
        return view('ecommerce_frontend.assetprovider.signup');
    }

    public function customerForgotPasswordView()
    {
        return view('ecommerce_frontend.customer.forgot_password');
    }

    public function merchantForgotPasswordView()
    {
        return view('ecommerce_frontend.merchant.forgot_password');
    }

    public function boostLandingPageView()
    {
        return view('ecommerce_frontend.assetprovider.boost');
    }

    public function ecommerceView()
    {
        return view('ecommerce_frontend.customer.index');
    }

    public function partnerWithUsView()
    {
        return view('ecommerce_frontend.assetprovider.partner_with_us');
    }

    public function partnerForgotPasswordView()
    {
        return view('ecommerce_frontend.assetprovider.forgot_password');
    }


    public function createTestMerchantUser()
    {
        
        // for ($i=1; $i < 300; $i++) { 
        //     $faker = \Faker\Factory::create();
        //     $email = $faker->email;
        //     $shop_name = $faker->name;
        //     $user = new User();
        //     $user->name = $faker->name;
        //     $user->role_id = 3;
        //     $user->email = $email;
        //     $user->password = bcrypt("123456");
        //     $user->city = 1;
        //     $user->region = 5;
        //     $user->mobile = $faker->numerify('##########');
        //     $user->active = 1;
        //     if($user->save()){
        //         $shop = new Shop();
        //         $shop->owner_id = $user->id;
        //         $shop->name = $shop_name;
        //         $shop->slug = Str::slug($shop_name, '-');
        //         $shop->email = $email;
        //         $shop->description = "Welcome";
        //         $shop->timezone_id = 35;
        //         $shop->current_billing_plan = "individual";
        //         $shop->active = 1;
        //         if($shop->save()){
        //             $user->shop_id = $shop->id;
        //             $user->save();
        //         }
        //     }
        // }

        // for ($i=1; $i <=20; $i++) { 
        //     $faker = \Faker\Factory::create();
        //     $email = $faker->email;
        //     $shop_name = $faker->name;
        //     $user = new AssetProvider();
        //     $user->applicant_name = $faker->name;
        //     $user->shop_name = $shop_name;
        //     $user->phone = $faker->numerify('##########');
        //     $user->email = $email;
        //     $user->password = bcrypt("123456");
        //     $user->county = "Nandi";
        //     $user->sub_county = "Commodi neque explic";
        //     $user->location = "Alias sapiente sed e";
        //     $user->operating_days = [
        //         "monday" => "on",
        //         "tuesday" => null,
        //         "wednesday" => null,
        //         "thursday" => null,
        //         "friday" => "on",
        //         "saturday" => null,
        //         "sunday" => "on"
        //     ];
        //     $status = "approved";
        //     $user->save();
        // }
        
        // return response()->json("successfully created");
    }
    
}
