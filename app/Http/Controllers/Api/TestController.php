<?php

namespace App\Http\Controllers\Api;

use App\Page;
use App\Shop;
use App\State;
use App\Banner;
use App\Slider;
use App\Country;
use App\Product;
use App\Category;
use App\Helpers\Twilio;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Http\Resources\ShopResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\BannerResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\PackagingResource;
use App\Http\Resources\PaymentMethodResource;
use App\Test;
use DB;
use Illuminate\Http\Request;
use App\Helpers;

class TestController extends Controller
{
    public function productsFromCategory($category)
    {
        return $category != 'all_categories'
            ? Category::where('slug', $category)->first()
            ->products()
            ->whereHas('inventories')
            ->where('origin_country', request()->input('selected_country'))
            ->pluck('name')
            ->toJson()
            : Product::where('origin_country', request()->input('selected_country'))
            ->whereHas('inventories')
            ->pluck('name')
            ->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sliders()
    {
        $sliders = Slider::whereHas('featuredImage')->get();

        return SliderResource::collection($sliders);
    }

    public function outbound(Request $request)
    {
        $clientNumber = $request->client;
        $message = "Hello Annkelys chicken parlour\nA new order [Order ID #141709] has been placed. Please check the order detail and fulfill the order asap.\nOrder item: Fanta Pineapple 2LT - AP\nShop name: Annkelys chicken parlour\nOrder ID: #141709\nQuantity: 1\nPayment method: MPESA\nPayment status: UNPAID\nOrder status: Confirmed\n\nShipping address: Samwel, Court 190/58, Nairobi, Embakasi, Nyayo Estate, Phone: 0722149301\n\nBilling address: Samwel, Court 190/58, Nairobi, Embakasi, Nyayo Estate, Phone: 0722149301\n\n\nThanks,\nAnnkelys chicken parlour, nyayomat";
        Twilio::sendClientMessage($clientNumber,$message);
    }
    public function inbound(Request $request)
    {
        // Save the message
        $testDetail = new Test;
        $testDetail->body = 'Incoming: ' . $request->getContent();
        $testDetail->save();
    }
    public function status(Request $request)
    {
        // Save the message
        $testDetail = new Test;
        $testDetail->body = 'Status: ' . $request->getContent();
        $testDetail->save();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banners()
    {
        $banners = Banner::all();

        return BannerResource::collection($banners);
    }

    /**
     * Open shop page.
     *
     * @param  slug  $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function offers($slug)
    {
        $product = Product::where('slug', $slug)->with([
            'inventories' => function ($q) {
                $q->available();
            }, 'inventories.attributeValues.attribute',
            'inventories.feedbacks',
        ])->firstOrFail();

        return new OfferResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function shop($slug)
    {
        $shop = Shop::where('slug', $slug)->active()
            ->with(['feedbacks' => function ($q) {
                $q->with('customer:id,nice_name,name')->latest()->take(10);
            }])
            ->withCount(['inventories' => function ($q) {
                $q->available();
            }])->firstOrFail();

        // Check shop maintenance_mode
        // if(getShopConfig($shop->id, 'maintenance_mode'))
        if ($shop->isDown()) {
            return response()->json(['message' => trans('app.marketplace_down')], 404);
        }

        return new ShopResource($shop);
    }

    /**
     * Return available packaging options for the specified shop.
     *
     * @param  string  $shop
     *
     * @return \Illuminate\Http\Response
     */
    public function packaging($shop)
    {
        $shop = Shop::where('slug', $shop)->active()->firstOrFail();
        $platformDefaultPackaging = new PackagingResource(getPlatformDefaultPackaging());
        $packagings = PackagingResource::collection($shop->activePackagings);

        return $packagings->prepend($platformDefaultPackaging);
        // return new PackagingResource($platformDefaultPackaging);
        // return PackagingResource::collection($shop->activePackagings);
    }

    /**
     * Return available payment options options for the specified shop.
     *
     * @param  string  $shop
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentOptions($shop)
    {
        $shop = Shop::where('slug', $shop)->active()->firstOrFail();

        $paymentMethods = $shop->paymentMethods;
        $activeManualPaymentMethods = $shop->manualPaymentMethods;
        foreach ($paymentMethods as $key => $payment_provider) {
            $has_config = false;
            switch ($payment_provider->code) {
                case 'stripe':
                    $has_config = $shop->stripe ? true : false;
                    // $info = trans('theme.notify.we_dont_save_card_info');
                    break;

                case 'instamojo':
                    $has_config = $shop->instamojo ? true : false;
                    // $info = trans('theme.notify.you_will_be_redirected_to_instamojo');
                    break;

                case 'authorize-net':
                    $has_config = $shop->authorizeNet ? true : false;
                    // $info = trans('theme.notify.we_dont_save_card_info');
                    break;

                case 'paypal-express':
                    $has_config = $shop->paypalExpress ? true : false;
                    // $info = trans('theme.notify.you_will_be_redirected_to_paypal');
                    break;

                case 'paystack':
                    $has_config = $shop->paystack ? true : false;
                    // $info = trans('theme.notify.you_will_be_redirected_to_paystack');
                    break;

                case 'wire':
                case 'cod':
                    $has_config = in_array($payment_provider->id, $activeManualPaymentMethods->pluck('id')->toArray()) ? true : false;
                    // $temp = $activeManualPaymentMethods->where('id', $payment_provider->id)->first();
                    // $info = $temp ? $temp->pivot->additional_details : '';
                    break;

                default:
                    $has_config = false;
                    break;
            }

            if (!$has_config) {
                $paymentMethods->forget($key);
            }
        }

        return PaymentMethodResource::collection($paymentMethods);
    }

    /**
     * Return available shipping options for the specified shop.
     *
     * @param  string  $shop
     *
     * @return \Illuminate\Http\Response
     */
    public function shipping($shop)
    {
        $shop = Shop::where('slug', $shop)->active()->firstOrFail();

        return PackagingResource::collection($shop->activePackagings);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function countries()
    {
        $countries = Country::select('id', 'name', 'iso_3166_2', 'iso_3166_3')->get();

        return CountryResource::collection($countries);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $country
     *
     * @return \Illuminate\Http\Response
     */
    public function states($country)
    {
        $states = State::select('id', 'name', 'iso_3166_2')->where('country_id', $country)->get();

        return StateResource::collection($states);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function page($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return new PageResource($page);
    }
}