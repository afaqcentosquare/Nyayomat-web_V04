<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {
    Route::post('cart', 'CartController@update')->name('api.cart.update');

    Route::get('sliders', 'HomeController@sliders');
    Route::post('v1/outbound', 'TestController@outbound');
    Route::post('v1/twil', 'TestController@inbound');
    Route::post('v1/status', 'TestController@status');
    Route::get('banners', 'HomeController@banners');
    Route::get('categories', 'CategoryController@index');
    Route::get('category-grps', 'CategoryController@categoryGroup');
    Route::get('category-subgrps', 'CategoryController@categorySubGroup');
    Route::get('countries', 'HomeController@countries');
    Route::get('states/{country}', 'HomeController@states');

    Route::get('page/{slug}', 'HomeController@page');
    Route::get('shop/{slug}', 'HomeController@shop');
    Route::get('packaging/{shop}', 'HomeController@packaging');
    Route::get('paymentOptions/{shop}', 'HomeController@paymentOptions');
    Route::get('offers/{slug}', 'HomeController@offers');
    Route::get('productsFromCategory/{slug}', 'HomeController@productsFromCategory');
    Route::get('searchableList/{country}', 'HomeController@searchableList');
    Route::get('listings/{list?}', 'ListingController@index');
    Route::get('listing/{slug}', 'ListingController@item');
    Route::get('search/{term}', 'ListingController@search');
    Route::get('shop/{slug}/listings', 'ListingController@shop');
    Route::get('category/{slug}', 'ListingController@category');
    Route::get('brand/{slug}', 'ListingController@brand');

    // CART
    Route::group(['middleware' => 'ajax'], function () {
        Route::post('addToCart/{slug}', 'CartController@addToCart');
        Route::post('cart/removeItem', 'CartController@remove');
    });

    // Route::group(['middleware' => 'auth:customer'], function(){
    Route::post('cart/{cart}/applyCoupon', 'CartController@validateCoupon');
    // Route::post('cart/{cart}/applyCoupon', 'CartController@validateCoupon')->middleware(['ajax']);
    // });

    Route::get('carts', 'CartController@index');
    Route::post('cart/{cart}/shipTo', 'CartController@shipTo');
    Route::post('cart/{cart}/checkout', 'CheckoutController@checkout');

    // Route::get('cart/{expressId?}', 'CartController@index')->name('cart.index');
    // Route::get('checkout/{slug}', 'CheckoutController@directCheckout');

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('details', 'AuthController@details');
    Route::get('categories', 'CategoryController@index');

    Route::get('locations', 'LocationController@index');
    Route::get('locationListing', 'LocationController@locationListing');

    Route::get('orders', 'OrderController@index');
    Route::get('merchants/{merchantId}/orders', 'OrderController@merchantOrders');
    // TODO - add inventory
    Route::get('merchants/{merchantId}/ordersSummary', 'OrderController@ordersSummary');
    Route::get('merchants/{merchantId}/{detailId}/orderCategoryDetail', 'OrderController@orderCategoryDetail');
    Route::get('merchants/{merchantId}/merchantSales', 'MerchantController@merchantSales');
    Route::post('merchants/signup', 'MerchantController@merchantSignup');
    Route::get('merchants/{merchantId}/balance', 'MerchantController@getAccountBalance');
    Route::post('merchants/withdraw', 'MerchantController@disburse');
    Route::post('orders/{merchantId}/createOrder', 'OrderController@checkoutAllOrders');
    Route::get('merchants/{merchantId}/inventory', 'ListingController@shopListing');
    Route::post('inventory/update', 'ListingController@updateInventory');
    Route::get('orders/{orderId}/details', 'OrderController@orderDetails');
    Route::post('logout', 'AuthController@logout');
    Route::post('logout', 'AuthController@logout');


    // Customer APIs
    Route::post('customer/signup', 'CustomerController@customerSignup');



    Route::post('payments/stk', 'PaymentsController@stkCallback');
    Route::post('payments/b2c', 'PaymentsController@b2cCallback');
});

// Route::group(['middleware' => 'auth:api'], function() {
//     Route::get('articles', 'ArticleController@index');
//     Route::get('articles/{article}', 'ArticleController@show');
//     Route::post('articles', 'ArticleController@store');
//     Route::put('articles/{article}', 'ArticleController@update');
//     Route::delete('articles/{article}', 'ArticleController@delete');
// });

// Merchant ACP App Start
// B2C

Route::post("/mpesa/payment/request", [
    "as" => "mpesa.paymentRequest",
    "uses" => "\App\Http\Controllers\ACP\MPESA\MpesaController@paymentRequest"
]);

Route::post("/b2c/result/{asset_provider_id}", [
    "as" => "b2c.result",
    "uses" => "\App\Http\Controllers\ACP\MPESA\MpesaController@B2CResultResponse"
]);

Route::post("/b2c/timeout", [
    "as" => "b2c.timeout",
    "uses" => "\App\Http\Controllers\ACP\MPESA\MpesaController@B2CTimeoutResponse"
]);

//Mpesa
Route::post("mpesa/deposit", [
    "as" => "mpesa.lipanampesa",
    "uses" => "\App\Http\Controllers\ACP\MPESA\DepositController@lipaNaMpesa"
]);

Route::post("mpesaipn/{merchant_id}", [
    "as" => "mpesa.payment",
    "uses" => "\App\Http\Controllers\ACP\MPESA\DepositController@mpesaIPN"
]);

/*
|--------------------------------------------------------------------------
| Merchant API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('merchant')->group(function () {
    Route::post('login', 'ACP\API\MerchantController@login');
    Route::post('register/request', 'Api\MerchantController@merchantSignup');
    Route::get('locationListing', 'Api\LocationController@locationListing');
    Route::get('city', 'ACP\API\MerchantController@getCountries');
    Route::get('region/{id}', 'ACP\API\MerchantController@getRegions');
    Route::get('location/{id}', 'ACP\API\MerchantController@getLocations');
    Route::get('pay/all/{id}/{type}', 'ACP\API\MerchantController@payAll');

    //auth routes
    Route::get('accountbalance/{id}', 'ACP\API\MerchantController@accountBalance');
    Route::get('catalog/{id}', 'ACP\API\MerchantController@catalog');
    Route::get('browse/{id}', 'ACP\API\MerchantController@browse');
    Route::get('requested/{id}', 'ACP\API\MerchantController@requested');
    Route::get('received/{id}', 'ACP\API\MerchantController@received');
    Route::post('assetrequest',  'ACP\API\MerchantController@assetRequest');
    Route::get('orderassetstatus/{id}/{user_id}/{status}',  'ACP\API\MerchantController@orderAssetStatus');
    Route::get('myassets/{id}',  'ACP\API\MerchantController@myAssets');
    Route::get('ongoingassetstats/{id}',  'ACP\API\MerchantController@ongoingAssetStats');
    Route::get('defaultedassetstats/{id}',  'ACP\API\MerchantController@defaultedAssetStats');
    Route::get('completedassetstats/{id}',  'ACP\API\MerchantController@completedAssetStats');
    Route::get('completedassetdetails/{order_id}',  'ACP\API\MerchantController@completedAssetDetails');
    Route::get('transactions/{user_id}',  'ACP\API\MerchantController@transactions');
    Route::get('transactiondetails/{order_id}',  'ACP\API\MerchantController@transactionDetails');
    Route::get('paymentstats/{id}', 'ACP\API\MerchantController@paymentStats');
    Route::get('paymentconfirmation/{id}/{type}', 'ACP\API\MerchantController@paymentConfirmation');
    Route::get('pay/now/{invoice_id}/{merchant_id}', 'ACP\API\MerchantController@payNow');
Route::middleware('auth:api')->group( function () {

    });
});
//Merchant ACP App End