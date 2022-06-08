# Nyayomat-Web_Production-Environment

**Project Overview**

Nyayomat ACP (Nyayomat Boost) is built alongside an e-commerce platform whereby merchants are connected to partners (Asset Providers) through the ACP. The platform acts as an intermediary between micro, small and medium-sized merchants and asset providers to facilitate asset/working capital financing between the counterparties.

The ACP contains users, product catalog, transactions, invoices and payments. The file directory is as follows: 

- Controllers

- Middleware

- Resources

- Routes

- ACP Functionalities

- Unit Test

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

#### **ACP Functionalities** 

We have three users in ACP nyayomat:

1. Super admin

2. Asset Provider

3. Merchant

Super admin has the following functionalities:

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

Superadmin administers the following actions: 

2.1	Suspend, Approve, Decline & Shortlist Asset Provider

Method: GET

URI: admin/update/assetprovider/status/{id}/{status}

Name: superadmin.update.assetprovider.status

Action: App\Http\Controllers\ACP\SuperAdmin\AssetProviderController@updateStatus

2.2	Add asset on behalf of Asset Provider (After adding Categories section 3 below)

Method: GET

URI: admin/asset/store

Name: superadmin.asset.store

Action: App\Http\Controllers\ACP\SuperAdmin\AssetController@store

3. Categories

Method: GET

URI: admin/categories

Name: superadmin.categories

Action: App\Http\Controllers\ACP\SuperAdmin\CategoryController@index

Asset categories have following actions

3.1 New Group

Method: POST

URI: admin/group/store

Name: superadmin.group.store

Action: App\Http\Controllers\ACP\SuperAdmin\CategoryController@storeGroup

3.2 Add SubGroup

Method: GET

URI: admin/subgroup/store

Name: superadmin.subgroup.store

Action: App\Http\Controllers\ACP\SuperAdmin\CategoryController@storeSubGroup

3.3 New Category 

Method: POST

URI: admin/categories/store

Name: superadmin.categories.store

Action: App\Http\Controllers\ACP\SuperAdmin\CategoryController@store

4. Assets

Method: GET

URI: admin/assets

Name: superadmin.assets

Action: App\Http\Controllers\ACP\SuperAdmin\AssetController@index

5. Product Catalog

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

10. Merchant Catalog - Browse

Method: GET

URI: merchant/catalog

Name: merchant.catalog

Action: App\Http\Controllers\ACP\Merchant\CatalogController@index

Merchant Catalog has the following actions:

10.1 Requested

Method: POST

URI: merchant/asset/request

Name: merchant.asset.request

Action: App\Http\Controllers\ACP\Merchant\CatalogController@store

10.2 Received

Method: GET

URI: merchant/catalog

Name: merchant.catalog

Action: App\Http\Controllers\ACP\Merchant\CatalogController@index

11. Merchant Invoices - Unpaid

Method: GET

URI: merchant/invoices

Name: merchant.invoices

Action: App\Http\Controllers\ACP\Merchant\InvoiceController@index

12. Merchant Invoices - Paid

Method: GET

URI: merchant/invoices

Name: merchant.invoices

Action: App\Http\Controllers\ACP\Merchant\InvoiceController@index

Asset provider has the following functionalities: 

13. Asset Provider Profile

Method: GET

URI: assetprovider/dashboard

Name: assetprovider.dashboard

Action: App\Http\Controllers\ACP\AssetProvider\DashboardController@index

14. Approve an asset

Method: GET

URI: assetprovider/productcatalog/update/status/{id}/{is_single}

Name: assetprovider.productcatalog.update.status

Action: App\Http\Controllers\ACP\AssetProvider\ProductCatalogController@updateStatus

15. Asset Provider Catalog - Confirmed

Method: GET

URI: assetprovider/productcatalog

Name: assetprovider.productcatalog

Action: App\Http\Controllers\ACP\AssetProvider\ProductCatalogController@index

Asset Provider Catalog have the following action

15.1 Delivered

Method: GET

URI: assetprovider/productcatalog

Name: assetprovider.productcatalog

Action: App\Http\Controllers\ACP\AssetProvider\ProductCatalogController@index


16. Asset Provider Transactions

Method: GET

URI: assetprovider/transactions

Name: assetprovider.transactions

Action: App\Http\Controllers\ACP\AssetProvider\TransactionController@index


#### **Unit Test** 

Pre-requisites:

To perform unit tests, 

Download ZIP the code repo - Nyayomat-Web_Production-Environment a

Install xampp on your pc with php 7.4 version.

If you have installed xampp on your pc, then go to your xampp/htdocs directory.

Under this directory you need to unzip the code file you had downloaded earlier. 

Create two db’s.

Import the db provided into your phpmyadmin on your localhost.


Once import is successfully done, go to your project directory and open .env file and change

DB_DATABASE= your_db_name

DB_USERNAME=

DB_PASSWORD= 

TESTING_DB_DATABASE=your_db_name

TESTING_DB_USERNAME=root

TESTING_DB_PASSWORD=

The default password is empty on localhost.


Proceed to cmd.

Go to project directory and thereafter;


Web Test Cases

To run all test at once:

Run the command below:

•	vendor/bin/phpunit

For individual tests, follow the instructions below:

The test folder has three sub-folders: 

1.SuperAdmin

2.Merchant

3.Asset Provider

SuperAdmin Tests:

Run below commands one by one:

•	vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/DashboardTest.php

•	vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/AssetProviderTest.php

•	vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/AssetsTest.php

•	vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/CategoryTest.php

•	vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/GroupTest.php

•	vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/InvoicesTest.php

•	vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/PaymentsTest.php

•	vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/PerformanceTest.php

•	vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/ProductCatalogTest.php

•	vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/SubGroupTest.php

Merchant Test:

Run below commands one by one:

•	vendor/bin/phpunit tests/Feature/ACP/Merchant/DashboardTest.php

•	vendor/bin/phpunit tests/Feature/ACP/Merchant/CatalogTest.php

•	vendor/bin/phpunit tests/Feature/ACP/Merchant/InvoiceTest.php

Asset Provider Test:

Run below commands one by one:

•	vendor/bin/phpunit tests/Feature/ACP/AssetProvider/DashboardTest.php

•	vendor/bin/phpunit tests/Feature/ACP/AssetProvider/ProductCatalogTest.php

•	vendor/bin/phpunit tests/Feature/ACP/AssetProvider/TransactionTest.php

Common Test:

•	vendor/bin/phpunit tests/Feature/ACP/Common/AssetTest.php







