<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


// Common
include 'Common.php';

// Front End routes
include 'Frontend.php';

// Backoffice routes
include 'Backoffice.php';

// Contact Us
Route::get('/contact_us', 'ContactUsController@index')->name('contact_us.index');
Route::post('/contact_us', 'ContactUsController@send')->name('contact_us');

// Webhooks
Route::post('webhook/stripe', 'WebhookController@handleStripeCallback'); 		// Stripe

// AJAX routes for get images
// Route::get('order/ajax/taxrate', 'OrderController@ajaxTaxRate')->name('ajax.taxrate');


//USSD
Route::post('/ussd/{key}', 'USSD\USSDController@index');



/**
 * 
 *
 * NEW DASHBOARD ROUTES STARTS HERE
 * 
 * 
 */


 /**
 * PRODUCTS ROUTES
 */

//  PRODUCT resource routes
Route::resource('products','Admin\ProductController');

// product delete
Route::delete('del/product/id/{id}/soft/{name}', 'Admin\ProductController@deleteProduct')->name('deleteproduct');

// edit product form
Route::get('/edit/product/attri','Admin\ProductController@edit')->name('edit-product-form');

// update product form
Route::post('/update/product/attri','Admin\ProductController@update')->name('product-update');



 /**
 * ROLE ROUTES
 */

// role delete
Route::delete('del/role/id/{id}/soft/{name}', 'Admin\RoleController@deleteRole')->name('deleterole');


Route::post('product/upload', 'Admin\ProductUploadController@NScreateProduct')->name('product.upload');

// create new role
Route::post('create/new/role', 'Admin\RoleController@createNewRole')->name('createnewrole');

// create new permission
Route::post('create/new/permission', 'Admin\RoleController@createNewPermission')->name('createnewpermission');

// view roles
Route::get('/roles', 'Admin\RoleController@showRoleswithPermissions')->name('roles');

// update users role
Route::post('/{id}/actors/{name}/change/role','Admin\RoleController@userroleupdater')->name('updateuserrole');

// edit role form
Route::get('/edit/role/attri/role','Admin\RoleController@edit')->name('edit-role-form');

// update role
Route::post('update/edited/role/{id}','Admin\RoleController@update')->name('update-role');



/**
 * BANNER ROUTES
 */

// create new banner
Route::post('create/new/banner', 'Admin\BannerController@store')->name('createnewbanner');

// edit role form
Route::get('/edit/banner/attri','Admin\BannerController@edit')->name('edit-banner-form');

// BANNER delete
Route::delete('del/banner/id/{id}/hard', 'Admin\BannerController@destroy')->name('delete-banner');

// update role
Route::post('update/edited/banner/{id}','Admin\BannerController@update')->name('update-banner');


/**
 * GROUP ROUTES
 */
// create new group
Route::post('store/new/group', 'Admin\CategoryGroupController@store')->name('createnewgroup');

/**
 * SUB-GROUP ROUTES
 */
Route::get('/general-sub-groupss/g{group}/', 'Admin\CategorySubGroupController@general_sub_group_products')->name('sub-group');
// create new subgroup
Route::post('store/new/subgroup', 'Admin\CategorySubGroupController@store')->name('createnewsubgroup');


/**
 * SLIDER ROUTES
 */
// create new slider
Route::post('store/new/slider', 'Admin\SliderController@store')->name('createnewslider');

// slider delete
Route::delete('del/slider/id/{id}/soft', 'Admin\SliderController@destroy')->name('delete-slider');



/**
 * FAQS ROUTES
 */

// create new faq
Route::post('store/new/faq', 'Admin\FaqController@store')->name('createnewfaq');

// create new faqtopic
Route::post('store/new/faq/topic', 'Admin\FaqTopicController@store')->name('createnewfaqtopic');

// edit faq-topic form
Route::get('/edit/faq-topic/attri','Admin\FaqTopicController@edit')->name('edit-faq-topic-form');

// edit faq form
Route::get('/edit/faq/attri','Admin\FaqController@edit')->name('edit-faq-form');


// update faq-topic
Route::post('update/edited/faq-topic/{id}','Admin\FaqTopicController@update')->name('update-faq-topic');

// update faq
Route::post('update/edited/faq/{id}','Admin\FaqController@update')->name('update-faq');


// delete faq-topic
Route::delete('del/faq-topic/id/{id}/hard', 'Admin\FaqTopicController@destroy')->name('delete-faq-topic');

// delete faq
Route::delete('del/faq/id/{id}/hard', 'Admin\FaqController@destroy')->name('delete-faq');

Route::get('/faqs/export', function () {
    return view('pages.backend.admin.faqsexport');
})->name('exportfaqspage');







/**
 * ANNOUNCEMENTS ROUTES
 */

// create new announcement
Route::post('store/new/annoncement', 'Admin\AnnouncementController@store')->name('createnewannouncement');


/**
 * USER ROUTES
 */

// suspend user
Route::get('suspend/user/{id}', 'Admin\UserController@suspend_user')->name('suspend-user');



 /**
 * PAGE ROUTES
 */

// page delete
Route::delete('del/page/id/{id}/soft', 'Admin\PageController@trash')->name('delete-page');

// edit product form
Route::get('/edit/product/attri','Admin\ProductController@edit')->name('edit-product-form');

// update product form
Route::post('/update/product/attri','Admin\ProductController@update')->name('product-update');




// DUMMY ROUTES
Route::get('landing/', function () {
    return view('welcome');
})->name('landing');

Route::get('/faqs', function () {
    return view('pages.backend.admin.faqs');
})->name('faqs');

Route::get('/acp-faqs', function () {
    return view('pages.backend.admin.acp-faqs');
})->name('acp-faqs');

Route::get('/payment-manager', function () {
    return view('pages.backend.admin.payment-manager');
})->name('payment-manager');

Route::get('/acp-merchants', function () {
    return view('pages.backend.admin.acp-merchants');
})->name('acp-merchants');

Route::get('/acp-providers', function () {
    return view('pages.backend.admin.acp-providers');
})->name('acp-providers');

Route::get('/ecommerce-dashboard', 'Admin\DashboardController@showDashboard')->name('ecommerce-dashboard')->middleware('auth');

Route::get('/aom', function () {
    return view('pages.backend.admin.aom');
})->name('aom');

Route::get('/acp-dashboard', function () {
    return view('pages.backend.admin.acp-dashboard');
})->name('acp-dashboard');

Route::get('/sales', function () {
    return view('pages.backend.admin.sales');
})->name('sales');

Route::get('all/groups', 'Admin\CategoryGroupController@index')->name('group');

Route::get('get-subgroups', 'Admin\CategoryGroupController@getSubGroups');
Route::get('get-category-by-subgroups', 'Admin\CategoryGroupController@getCategoriesBySubGroups');

Route::get('/acp-group', function () {
    return view('pages.backend.admin.acp-group');
})->name('acp-group');


Route::get('/acp-sub-group', function () {
    return view('pages.backend.admin.acp-sub-group');
})->name('acp-sub-group');


Route::get('/specific/product/{productname}',  'Admin\ProductController@getspecificProduct')->name('specific-product');

Route::get('/acp-specific-product', function () {
    return view('pages.backend.admin.acp-specific-product');
})->name('acp-specific-product');


Route::get('/category/{category}', 'Admin\CategoryController@geCategoryProducts')->name('category');

Route::get('/category-products/{category}', 'Admin\CategoryController@onlyCategoryProducts')->name('category-products');


Route::get('/acp-category', function () {
    return view('pages.backend.admin.acp-category');
})->name('acp-category');

Route::get('/inventory', function () {
    return view('pages.backend.admin.inventory');
})->name('inventory');

Route::get('/supplier', function () {
    return view('pages.backend.admin.inventory');
})->name('supplier');

Route::get('/customers', function () {
    return view('pages.backend.admin.customers');
})->name('customers');


Route::get('/merchant-dashboard', function () {
    return view('pages.backend.merchant.dashboard');
})->name('merchant-dashboard');

// Route::get('/merchant-dashboard','Admin\UserController@system_actors')->name('merchant-dashboard');


Route::get('/merchant-notifications', function () {
    return view('pages.backend.merchant.notifications');
})->name('merchant-notifications');


Route::get('/merchant-disputes', function () {
    return view('pages.backend.merchant.disputes');
})->name('merchant-disputs');

Route::get('/merchant/merchant-products', function () {
    return view('pages.backend.merchant.products');
})->name('merchant-products');

Route::get('/merchant-stats', function () {
    return view('pages.backend.merchant.stats');
})->name('merchant-stats');

Route::get('/merchant-stock', function () {
    return view('pages.backend.merchant.stock');
})->name('merchant-stocks');

Route::get('/merchant-transactions', function () {
    return view('pages.backend.merchant.transactions');
})->name('merchant-transactions');

Route::get('/all/merchant-transactions', 'Admin\MerchantController@allmerchantTransaction')->name('all.merchant-transactions');


Route::get('/stockouts', 'Admin\StockOutController@index')->name('stockouts');

Route::get('/actors','Admin\UserController@system_actors')->name('actors');

Route::get('/appearance', function () {
    return view('pages.backend.admin.appearance');
})->name('appearance');


Route::get('/email', function () {
    return view('pages.backend.admin.email');
})->name('email');

Route::get('/subscriptions', function () {
    return view('pages.backend.admin.subscriptions');
})->name('subscriptions');

Route::get('/order-status', function () {
    return view('pages.backend.admin.order-status');
})->name('order-status');

Route::get('/banners', function () {
    return view('pages.backend.admin.banners');
})->name('banners');

Route::get('/sliders', function () {
    return view('pages.backend.admin.sliders');
})->name('sliders');

Route::get('/pages', function () {
    return view('pages.backend.admin.pages');
})->name('pages');

Route::get('/county', 'Admin\LocationController@showCounties')->name('county');
Route::post('/create/county', 'Admin\LocationController@createCounty')->name('create.county');
Route::get('/sub-county/{city?}', 'Admin\LocationController@showSubCounties')->name('sub-county');
Route::post('/create/subcounty', 'Admin\LocationController@createSubCounty')->name('create.subcounty');
Route::get('/locations/{region?}', 'Admin\LocationController@showLocations')->name('locations');
Route::post('/create/location', 'Admin\LocationController@createLocation')->name('create.location');
Route::get('/blog', function () {
    return view('pages.backend.admin.blog');
})->name('blog');

Route::get('/order-status', function () {
    return view('pages.backend.admin.order-status');
})->name('order-status');

Route::get('/settings', function () {
    return view('pages.backend.admin.settings');
})->name('settings');

Route::get('/announcements', function () {
    return view('pages.backend.admin.announcements');
})->name('announcements');

Route::get('/acp-announcements', function () {
    return view('pages.backend.admin.acp-announcements');
})->name('acp-announcements');


Route::get('/merchants', function () {
    return view('lists.merchants');
})->name('merchants');


Route::get('/dashboard-overview', function () {
    return view('pages.backend.dashboard');
})->name('merchant-overview');



Route::get('/notifications', function () {
    return view('pages.backend.notifications');
})->name('merchant-notifications');

// Route::get('/transactions', function () {
//     return view('pages.backend.transactions');
// })->name('merchant-transactions');

Route::get('/product', function () {
    return view('pages.backend.products');
})->name('merchant-product');



Route::get('/disputes', function () {
    return view('pages.backend.disputes');
})->name('disputes');



Route::get('/stats', function () {
    return view('pages.backend.stats');
})->name('merchant-stats');




Route::get('/aps', function () {
    return view('lists.asset-providers');
})->name('aps');


Route::get('/prods', function () {
    return view('lists.asset-providers');
})->name('prods');



Route::get('/get-listed', function () {
    return view('pages.perspectives.asset-provider.new');
})->name('list-ap');




/**
 * ACP Routes Start
 */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('/basic_email', 'ACP\Mail\MailController@basic_email');
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

/**
 * Frontend Routes Start
 */

Route::get('test_merchant_user' , 'ACP\Frontend\FrontendController@createTestMerchantUser');

Route::get('/' , 'EcommerceFrontend\HomeController@commonHome')->name('commonhome');
Route::get('boost/landing/page', 'ACP\Frontend\FrontendController@boostLandingPageView')->name('boost.landing.page');

// /*Merchant Routes */
Route::get('merchant/login' , 'ACP\Frontend\FrontendController@merchantLoginView')->name('merchant.login');
Route::get('merchant/signup' , 'ACP\Frontend\FrontendController@merchantSignupView')->name('merchant.signup');
Route::get('merchant/forgot-password' , 'ACP\Frontend\FrontendController@merchantForgotPasswordView')->name('merchant.forgot.password');

// /*Customer Routes */
// Route::get('ecommerce' , 'EcommerceFrontend\HomeController@ecommerceView')->name('ecommerce');
Route::get('customer/signin' , 'ACP\Frontend\FrontendController@customerSigninView')->name('customer.signin');
Route::get('customer/forgot-password', 'ACP\Frontend\FrontendController@customerForgotPasswordView')->name('customer.forgot.password');
Route::get('customer/signup', 'ACP\Frontend\FrontendController@customerSignupView')->name('customer.signup');

// /*Asset provider(partner) Routes*/
Route::get('partner/signup' , 'ACP\Frontend\FrontendController@partnerSignupView')->name('partner.signup');
Route::get('partner/with/us' , 'ACP\Frontend\FrontendController@partnerWithUsView')->name('partnerwithus');
Route::get('partner/forgot/password' , 'ACP\Frontend\FrontendController@partnerForgotPasswordView')->name('partner.forgot.password');

Route::get('privacy/policy', function () {
    return view('ecommerce_frontend.privacy_policy');
})->name('privacy.policy');

/*Ecommerce Routs starts */

Route::get('order-conformation', function () {
    return view('ecommerce_frontend.thanks');
})->name('thank-you');

Route::get('product-search', function () {
    return view('ecommerce_frontend.product_search');
})->name('product-search');

Route::get('checkout', 'EcommerceFrontend\CheckoutController@categories')->name('checkout');

Route::get('empty-cart', function () {
    return view('ecommerce_frontend.empty_cart');
})->name('empty-cart');

/*Ecommerce Routs ends */

/**
 * Frontend Routes Ends
 */


/**
 * Super Admin Routes
 */

Route::prefix('admin')->group(function () {


    /**
     * Auth Routes
     */
    Route::get('/login', 'ACP\SuperAdmin\AuthController@loginView')->name("superadmin.login");
    Route::post('/checklogin', 'ACP\SuperAdmin\AuthController@checkLogin')->name("superadmin.checklogin");
    Route::get('/switchtoalternatvecreadit', 'ACP\SuperAdmin\AuthController@switchToAlternativeCredit')->name("superadmin.switchtoalternatvecreadit");
    
    /**
     * Admin Routes With Middleware
     */
    Route::group(['middleware' => 'acp.admin'], function () {
        
        /**
         * Dashboard Routes
         */
        Route::get('welcome', 'ACP\SuperAdmin\DashboardController@index')->name("superadmin.dashboard");
        

        /**
         * Asset Providers Routes
         */
        Route::get('assetprovider', 'ACP\SuperAdmin\AssetProviderController@index')->name("superadmin.assetprovider");
        Route::get('update/assetprovider/status/{id}/{status}', 'ACP\SuperAdmin\AssetProviderController@updateStatus')->name("superadmin.update.assetprovider.status");
        Route::get('get-subgroups', 'ACP\SuperAdmin\AssetProviderController@getSubGroups');
        Route::get('get-category-by-subgroups', 'ACP\SuperAdmin\AssetProviderController@getCategoriesBySubGroups');
        /**
         * Categories Routes
         */
        Route::get('categories', 'ACP\SuperAdmin\CategoryController@index')->name("superadmin.categories");
        Route::post('categories/store', 'ACP\SuperAdmin\CategoryController@store')->name("superadmin.categories.store");
        Route::get('categories/show/{id}/{type}', 'ACP\SuperAdmin\CategoryController@show')->name("superadmin.categories.show");
        Route::post('group/store', 'ACP\SuperAdmin\CategoryController@storeGroup')->name("superadmin.group.store");
        Route::get('subgroup/{id}', 'ACP\SuperAdmin\CategoryController@subGroupView')->name("superadmin.subgroup.view");
        Route::post('subgroup/store', 'ACP\SuperAdmin\CategoryController@storeSubGroup')->name("superadmin.subgroup.store");

        /**
         * Assets Routes
         */
        Route::get('assets', 'ACP\SuperAdmin\AssetController@index')->name("superadmin.assets");
        Route::post('asset/store', 'ACP\SuperAdmin\AssetController@store')->name("superadmin.asset.store");
        Route::post('asset/update/{id}', 'ACP\SuperAdmin\AssetController@update')->name("superadmin.asset.update");

        /**
         * Product Catalog Routes
         */
        Route::get('productcatalog', 'ACP\SuperAdmin\ProductCatalogController@index')->name("superadmin.productcatalog");

        /**
         * Payments Routes
         */
        Route::get('payments', 'ACP\SuperAdmin\PaymentController@index')->name("superadmin.payments");

        /**
         * Invoice Routes 
         */
        Route::get('invoices', 'ACP\SuperAdmin\InvoiceController@index')->name("superadmin.invoices");
        Route::get('pay/invoice/{id}', 'ACP\SuperAdmin\InvoiceController@payNow')->name("superadmin.pay.now");

        /**
         * Performance Routes
         */
        Route::get('performance', 'ACP\SuperAdmin\PerformanceController@index')->name("superadmin.performance");
        Route::get('redirect/merchant/{id}', 'ACP\SuperAdmin\RedirectController@redirectMerchant')->name("superadmin.redirect.merchant");
        Route::get('redirect/assetprovider/{id}', 'ACP\SuperAdmin\RedirectController@assetProviderRedirect')->name("superadmin.redirect.assetprovider");
        Route::get('defaulter/merchant/{id}', 'ACP\SuperAdmin\PerformanceController@defaulterMerchant')->name("superadmin.defaulter.merchant");
        /**
         * Location Routes
         */
        Route::get('locations', 'ACP\SuperAdmin\LocationController@index')->name("superadmin.locations");

        /**
         * Faqs Routes
         */
        Route::get('faqs', 'ACP\SuperAdmin\FaqsController@index')->name("superadmin.faqs");
        Route::post('faqs/store', 'ACP\SuperAdmin\FaqsController@store')->name("superadmin.faqs.store");
        Route::post('faqs/update/{id}', 'ACP\SuperAdmin\FaqsController@update')->name("superadmin.faqs.update");
        Route::post('faqs/topic/store', 'ACP\SuperAdmin\FaqsController@storeTopic')->name("superadmin.faqs.topic.store");
        Route::post('faqs/topic/update/{id}', 'ACP\SuperAdmin\FaqsController@updateTopic')->name("superadmin.faqs.topic.update");

        /**
         * Announcement Routes
         */
        Route::get('announcements', 'ACP\SuperAdmin\AnnouncementController@index')->name("superadmin.announcements");
        Route::post('announcement/store', 'ACP\SuperAdmin\AnnouncementController@store')->name("superadmin.announcement.store");

        /**
         * Logout Route
         */
        Route::get('/logout', 'ACP\SuperAdmin\AuthController@logout')->name("superadmin.logout");
    });
});



/**
 * Asset Provider Routes
*/

/**
 * Auth Routes
*/

Route::get('partner/login', 'ACP\AssetProvider\AuthController@loginView')->name("assetprovider.loginview");
// Route::get('partner/register', [AssetProviderAuthController::class, 'registerRequestView'])->name("assetprovider.registerview");
Route::get('/set-password/{id}', 'ACP\AssetProvider\AuthController@setPasswordView')->name("assetprovider.set.passwordview");
Route::post('/set-password/{id}', 'ACP\AssetProvider\AuthController@setPassword')->name("assetprovider.set.password");
Route::post('/register/request', 'ACP\AssetProvider\AuthController@registerRequest')->name("assetprovider.register.request");
Route::post('/assetprovider/checklogin', 'ACP\AssetProvider\AuthController@checkLogin')->name("assetprovider.checklogin");

/**
 * Asset Provider Middleware
*/
Route::group(['middleware' => 'acp.asset.provider'], function () {
    /**
     * Asset Provider Group
    */
    Route::prefix('assetprovider')->group(function () {
        /**
         * Dashboard Routes 
         */
        Route::get('dashboard', 'ACP\AssetProvider\DashboardController@index')->name("assetprovider.dashboard");

        /**
         * Product Catalog Routes
         */
        Route::get('productcatalog', 'ACP\AssetProvider\ProductCatalogController@index')->name("assetprovider.productcatalog");
        Route::get('productcatalog/update/status/{id}/{is_single}', 'ACP\AssetProvider\ProductCatalogController@updateStatus')->name("assetprovider.productcatalog.update.status");
        Route::post('productcatalog/update/stock/{id}', 'ACP\AssetProvider\ProductCatalogController@updateStock')->name("assetprovider.productcatalog.update.stock");
        /**
         * Transaction Routes
         */
        Route::get('transactions', 'ACP\AssetProvider\TransactionController@index')->name("assetprovider.transactions");
        Route::post('withdraw/amount', 'ACP\AssetProvider\TransactionController@withDrawCash')->name("assetprovider.withdraw.amount");
        Route::post('b2c/result', 'ACP\MPESA\MpesaController@B2CResultResponse')->name("assetprovider.mpesa.result");
        Route::post('b2c/timeout', 'ACP\MPESA\MpesaController@B2CTimeoutResponse')->name("assetprovider.mpesa.timeout");
         /**
         * Logout Route
         */
        Route::get('logout', 'ACP\AssetProvider\AuthController@logout')->name("assetprovider.logout");
    });
});

/**
 * Merchant Routes
*/
    /**
     * Merchant Group
    */
    Route::prefix('merchant')->group(function () {
        /**
         * Dashboard Routes 
         */
        Route::get('dashboard', 'ACP\Merchant\DashboardController@index')->name("merchant.dashboard");
        Route::get('/switchtoalternatvecreadit', 'ACP\Merchant\DashboardController@switchToAlternativeCredit')->name("merchant.switchtoalternatvecreadit");
        Route::get('logout', 'ACP\Merchant\DashboardController@logout')->name("merchant.logout");

        /**
         * Catalog Routes 
         */
        Route::get('catalog', 'ACP\Merchant\CatalogController@index')->name("merchant.catalog");
        Route::post('asset/request', 'ACP\Merchant\CatalogController@store')->name("merchant.asset.request");
        Route::get('update/order/status/{id}/{status}', 'ACP\Merchant\CatalogController@updateMerchantOrderAssetStatus')->name("merchant.update.order.status");
        

        /**
         * Invoice Routes 
         */
        Route::get('invoices', 'ACP\Merchant\InvoiceController@index')->name("merchant.invoices");
        Route::get('pay/invoice/{id}', 'ACP\Merchant\InvoiceController@payNow')->name("merchant.pay.now");
        /**
         * Transaction Routes 
         */
        Route::get('transactions', 'ACP\Merchant\TransactionController@index')->name("merchant.transactions");
        Route::post('deposit/amount', 'ACP\Merchant\TransactionController@depositAmount')->name("merchant.deposit.amount");

        /**
         * USSD Routes
         */
        Route::post('ussdrequest', 'ACP\USSD\ACPUSSDController@store');
    });


/**
 * ACP Routes End
 */
