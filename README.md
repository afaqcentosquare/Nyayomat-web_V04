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



We create Unit Testing to Test whole ACP site:
All test we can find under root directory then go to test folder below I explain how you run test cases one by onw or all at once through command.

First you need to go to server.
![Screenshot (27)](https://user-images.githubusercontent.com/95353455/172368978-152bf2ae-ac65-4c36-9d69-d77f4599c330.png)
Then you need to type:
cd public_html and press enter

![Screenshot (28)](https://user-images.githubusercontent.com/95353455/172369320-59c10f00-b5bd-48a8-a1e0-81e55d6ffd79.png)
AFter run the command your screen look like below image:

![Screenshot (29)](https://user-images.githubusercontent.com/95353455/172369466-f4e9b192-4a09-4f3f-b721-561d4f3bbe26.png)

If you want to run all test at once:
Run below command:

vendor/bin/phpunit

If you want to run test one by one follow below instructions:

Test Have three Folders:

1.SuperAdmin
2.Merchant
3.Asset Provider

SuperAdmin Tests:
run below commands one by one

vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/DashboardTest.php
vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/AnnouncementTest.php
vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/AssetProviderTest.php
vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/AssetsTest.php
vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/CategoryTest.php
vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/FaqTest.php
vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/GroupTest.php
vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/InvoicesTest.php
vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/PaymentsTest.php
vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/PerformanceTest.php
vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/ProductCatalogTest.php
vendor/bin/phpunit tests/Feature/ACP/SuperAdmin/SubGroupTest.php

Merchant Test:
run below commands one by one

vendor/bin/phpunit tests/Feature/ACP/Merchant/DashboardTest.php
vendor/bin/phpunit tests/Feature/ACP/Merchant/CatalogTest.php
vendor/bin/phpunit tests/Feature/ACP/Merchant/InvoiceTest.php


Asset Provider Test:
run below commands one by one:

vendor/bin/phpunit tests/Feature/ACP/AssetProvider/DashboardTest.php
vendor/bin/phpunit tests/Feature/ACP/AssetProvider/ProductCatalogTest.php
vendor/bin/phpunit tests/Feature/ACP/AssetProvider/TransactionTest.php










