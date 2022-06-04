# Nyayomat-web_V04

**Project Overview**

Nyayomat ACP (Nyayomat Boost) is built alongside the e-commerce platform whereby merchants are connected to partners (Asset Providers) through the ACP. 

The ACP contains users, product catalog, transactions, invoices and payments. The file directory is as follows: 

├── Controllers

├── Middleware

├── resources

├── routes

#### **Controllers**

Contains the ACP Merchant API, ACP Dashboard & Ecommerce related files.

1.0	App

1.0.1 Http

1.0.1.1 Controllers

- ACP

- Admin

- Ecommerce Frontend

- Storefront

#### **Middleware**

Contains the ACP Merchant API, ACP Dashboard & Ecommerce related files.

2.0	App

2.0.1	Http

2.0.1.1	Middleware

#### **Resources** 

Contains the ACP Merchant API, ACP Dashboard & Ecommerce related files.

3.0	Resources

3.0.1	views

3.0.1.1	acp

3.0.1.1	address

3.0.1.2	admin

3.0.1.3	auth

3.0.1.4	contract

3.0.1.5	ecommerce_frontend

3.0.1.6	email

3.0.1.7	errors

3.0.1.8	layouts

3.0.1.9	pages

3.0.1.10	plugins

#### **Routes** 

Contains the ACP Merchant API, ACP Dashboard & Ecommerce related changed files.

4.0	routes

4.0.1	admin

4.0.2	common

4.0.3	storefront

ACP nyayomat explanation:
We have three users in ACP nyayomat:
1. Super admin
2. Asset Provider
3. Merchant

Super admin have functionalities
1. Dashboard

Method: GET
URI: admin/welcome
Name: superadmin.dashboard
Action: App\Http\Controllers\ACP\SuperAdmin\DashboardController@index

2. Asset Provider

Method: GET
URI: admin/assetprovider
Name: superadmin.assetprovider
Action: App\Http\Controllers\ACP\SuperAdmin\AssetProviderController@index

Asset provider have following actions

1- Add asset

Method: GET
URI: admin/asset/store
Name: superadmin.asset.store
Action: App\Http\Controllers\ACP\SuperAdmin\AssetController@store

2- Suspend, Approve & Shortlist

Method: GET
URI: admin/update/assetprovider/status/{id}/{status}
Name: superadmin.update.assetprovider.status
Action: App\Http\Controllers\ACP\SuperAdmin\AssetProviderController@updateStatus

3. Categories

Method: GET
URI: admin/categories
Name: superadmin.categories
Action: App\Http\Controllers\ACP\SuperAdmin\CategoryController@index

Asset categories have following actions

1. New Group

Method: POST
URI: admin/group/store
Name: superadmin.group.store
Action: App\Http\Controllers\ACP\SuperAdmin\CategoryController@storeGroup

1. Add SubGroup

Method: GET
URI: admin/subgroup/store
Name: superadmin.subgroup.store
Action: App\Http\Controllers\ACP\SuperAdmin\CategoryController@storeSubGroup

4. Assets

Method: GET
URI: admin/assets
Name: superadmin.assets
Action: App\Http\Controllers\ACP\SuperAdmin\AssetController@index

5. Product Catelog

Method: GET
URI: admin/productcatalog
Name: superadmin.productcatalog
Action: App\Http\Controllers\ACP\SuperAdmin\ProductCatalogController@index

6. Payments

Method: GET
URI: admin/payments
Name: superadmin.payments
Action: App\Http\Controllers\ACP\SuperAdmin\PaymentController@index

7. Invoices

Method: GET
URI: admin/invoices
Name: superadmin.invoices
Action: App\Http\Controllers\ACP\SuperAdmin\InvoiceController@index

8. Performance

Method: GET
URI: admin/performance
Name: superadmin.performance
Action: App\Http\Controllers\ACP\SuperAdmin\PerformanceController@index

9. Merchant Profile

Method: GET
URI: merchant/dashboard
Name: merchant.dashboard
Action: App\Http\Controllers\ACP\Merchant\DashboardController@index

10. Merchant Catelog

Method: GET
URI: merchant/catalog
Name: merchant.catalog
Action: App\Http\Controllers\ACP\Merchant\CatalogController@index

Merchant Catelog have a following action

1- Request

Method: POST
URI: merchant/asset/request
Name: merchant.asset.request
Action: App\Http\Controllers\ACP\Merchant\CatalogController@store

11. Merchant Invoices

Method: GET
URI: merchant/invoices
Name: merchant.invoices
Action: App\Http\Controllers\ACP\Merchant\InvoiceController@index

















