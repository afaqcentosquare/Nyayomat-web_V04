<?php

namespace App\Http\Controllers\Admin;

use DB;
use DateTime;
use App\Order;
use App\Product;
use App\Inventory;
use App\Category;
use App\Customer;
use App\Manufacturer;
use App\PaymentMethod;
use App\OrderStatus;
use App\Shop;
use App\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Requests\Validations\ExportCategoryRequest;
use App\Http\Requests\Validations\OrderUploadRequest;
use App\Http\Requests\Validations\ProductImportRequest;

class OrderUploadController extends Controller
{

	private $failed_list = [];

	/**
	 * Show upload form
	 *
     * @return \Illuminate\Http\Response
	 */
	public function showForm()
	{
        return view('admin.order._upload_form');
	}

	/**
	 * Upload the csv file and generate the review table
	 *
	 * @param  OrderUploadRequest $request
     * @return \Illuminate\Http\Response
	 */

/*
	 	public function upload(OrderUploadRequest $request)
	 	{
	 		$path = $request->file('orders')->getRealPath();
	 		$data = array_map('str_getcsv', file($path));
	 		$rows = array_slice($data, 2);

	 		return view('admin.order.upload_review', compact('rows'));
	 	}
*/

	 /**
 	 * Import the csv file and generate the review table
 	 *
 	 * @param  OrderUploadRequest $request
      * @return \Illuminate\Http\Response
 	 */

	public function upload(OrderUploadRequest $request)
	{
		//dd($request->all());
		$path = $request->file('orders')->getRealPath();
		$data = array_map('str_getcsv', file($path));
		$rows = array_slice($data, 2);

		$failed_rows = [];
		foreach ($rows as $row ) {

			// Process fields to be saved in database
			// Save order if product name and quantity is in csv

			if (($row[1] !=NULL || $row[1] !='') && ($row[2] !=NULL || $row[2] !='')) {

				//get shop_id from session
				$shop_id = auth()->user()->shop_id;
				//generate order_number
				$order_number = get_formated_order_number($shop_id);

				// process product details
				$raw_product_name = $row[1];
				$product = Product::where('name', 'LIKE', "%{$raw_product_name}%")->first();
				$inventory = Inventory::where('product_id', $product->id)->where('shop_id', $shop_id)->first(); // check shop's inventory
				// print_r ($inventory)
				if ($inventory !=NULL) {

					//deduct stock quantity
					if ($inventory->stock_quantity < $row[2]) {
						$new_stock_quantity = 0;

					} else {
						$new_stock_quantity = $inventory->stock_quantity - $row[2];

					}
				}else {
					// add new inventory, default stock quantity = 0
					$inventory = new Inventory;
					$inventory->shop_id = $shop_id;
					$inventory->title = $product->name;
					$inventory->product_id = $product->id;
					$inventory->user_id = auth()->user()->id;
					$inventory->sale_price = $row[3];
					$inventory->slug = $product->slug;

					$inventory->save();
					$new_stock_quantity = $inventory->stock_quantity;
				}

				//process amount
				$amount = $row[2] * $inventory->sale_price;

				// process customer details
				if ($row[7] !=NULL || $row[7] !='') {

					// check is customer exists.
					$customer_mobile = $row[7];
					// $customer_mobile = '0'.$customer_mobile;
					$customer = Customer::where('mobile', $customer_mobile)->first();

					if ($customer) {
						$customer_id = $customer->id;

					}else {
						//create new customer
						$customer = new Customer;
						$customer->name = $row[6]; 
						$customer->mobile = $row[7];
						$customer->save();
						$customer_id = $customer->id;
					}
				}else {
					$customer_id = NULL;
				}

				//payment status and method
				$raw_payment_method = $row[8];
				$payment_method = PaymentMethod::where('name', 'LIKE', "%{$raw_payment_method}%")->first();
                
                if ($payment_method->id == 8) {
						$payment_type = Account::TYPE_WALKIN;
				}elseif ($payment_method->id == 9) {
						$payment_type = Account::TYPE_CREDIT;
				}
				
				//confirm order
				$raw_confirm_status = $row[9];
				$order_status = OrderStatus::where('name', 'LIKE', "%{$raw_confirm_status}%")->first();

				//Save the order
	        $order = new Order;
					$order->order_number = $order_number;
					$order->shop_id = $shop_id;
					$order->customer_id = $customer_id;
					$order->quantity = $row[2];
					$order->total = $amount;
					$order->grand_total = $amount;
					//$order->payment_status = $;
					$order->order_status_id = $order_status->id;
					$order->payment_method_id = $payment_method->id;
					$order->transaction_date = $row[5];
					$order->save();

					//save order items
					$order_items = [];
          $order_items[] = [
              'order_id'          => $order->id,
              'inventory_id'      => $inventory->id,
              'item_description'  => $inventory->title,
              'quantity'          => $row[2],
              'unit_price'        => $inventory->sale_price,
          ];
	        \DB::table('order_items')->insert($order_items);

					//update stock_quantity

					$update_inventory = Inventory::find($inventory->id);

					$update_inventory->stock_quantity = $new_stock_quantity;

					$update_inventory->save();
					
					//update shop amount
					$shop = DB::table("shops")->where('id', $order->shop_id)->first();
					if (!$shop instanceof Shop) {
							$shop = Shop::findOrFail($shop->id);
					}
					
					if ($shop) {
					        //process created_at date to be used in getting summaries on accounts
							$tdate = $order->transaction_date;
							$dtime = DateTime::createFromFormat("d/m/Y", $tdate);
							$newdate = $dtime->format('Y-m-d H:i:s');
							

							// Save a +ve account
							$account = new Account;
							$account->fill([
									'user_id' => $shop->owner_id,
									'amount' => $order->grand_total,
									'order_id' => $order->id,
									'type' => $payment_type,
									'transaction_date' => $order->transaction_date,
									'created_at' => $newdate,
							]);
							$account->save();
					}
					

					$added_orders =[];
					array_push($added_orders, $order);

				}else {
					// add to failed list
					array_push($failed_rows, $row);
				}

			}
		// return $added_orders;
				return redirect()->route('admin.order.order.index');
	}

	/**
	 * Perform import action
	 *
	 * @param  OrderUploadRequest $request
     * @return \Illuminate\Http\Response
	 */
	public function importcsv(OrderUploadRequest $request)
	{
		// Reset the Failed list
		$this->failed_list = [];
dd($request->all());
		foreach ($request->input('data') as $row) {
			$data = unserialize($row);

			// Ignore if the name field is not given
			if( ! $data['name'] || ! $data['categories'] ){
				$reason = $data['name'] ? trans('help.invalid_category') : trans('help.name_field_required');
				$this->pushIntoFailed($data, $reason);
				continue;
			}

			// If the slug is not given the make it
			if( ! $data['slug'] )
				$data['slug'] = str_slug($data['name'], '-');

			// Ignore if the slug is exist in the database
			$product = Product::select('slug')->where('slug', $data['slug'])->first();
			if( $product ){
				$this->pushIntoFailed($data, trans('help.slug_already_exist'));
				continue;
			}

			// Find categories and make the category_list. Ignore the row if category not found
			$data['category_list'] = Category::whereIn('slug', explode(',', $data['categories']))->pluck('id')->toArray();
			if( empty($data['category_list']) ){
				$this->pushIntoFailed($data, trans('help.invalid_category'));
				continue;
			}

			// Create the product and get it, If failed then insert into the ignored list
			if( ! $this->createProduct($data) ){
				$this->pushIntoFailed($data, trans('help.input_error'));
				continue;
			}
		}

        $request->session()->flash('success', trans('messages.imported', ['model' => trans('app.products')]));

        $failed_rows = $this->getFailedList();

		if(!empty($failed_rows))
	        return view('admin.product.import_failed', compact('failed_rows'));

        return redirect()->route('admin.catalog.product.index');
	}

	/**
	 * Create Product
	 *
	 * @param  array $product
	 * @return App\Product
	 */
	private function createProduct($data)
	{
		if($data['origin_country'])
			$origin_country = DB::table('countries')->select('id')->where('iso_3166_2', strtoupper($data['origin_country']))->first();

		if($data['manufacturer'])
			$manufacturer = Manufacturer::firstOrCreate(['name' => $data['manufacturer']]);

		// Create the product
		$product = Product::create([
						'name' => $data['name'],
						'slug' => $data['slug'],
						'model_number' => $data['model_number'],
						'description' => $data['description'],
						'gtin' => $data['gtin'],
						'gtin_type' => $data['gtin_type'],
						'mpn' => $data['mpn'],
						'brand' => $data['brand'],
						'origin_country' => isset($origin_country) ? $origin_country->id : Null,
						'manufacturer_id' => isset($manufacturer) ? $manufacturer->id : Null,
						'min_price' => ($data['minimum_price'] && $data['minimum_price'] > 0) ? $data['minimum_price'] : 0,
						'max_price' => ($data['maximum_price'] && $data['maximum_price'] > $data['minimum_price']) ? $data['maximum_price'] : Null,
						'model_number' => $data['model_number'],
						'requires_shipping' => strtoupper($data['requires_shipping']) == 'TRUE' ? 1 : 0,
						'active' => strtoupper($data['active']) == 'TRUE' ? 1 : 0,
					]);

		// Sync categories
		if($data['category_list'])
            $product->categories()->sync($data['category_list']);

		// Upload featured image
        if ($data['image_link'])
            $product->saveImageFromUrl($data['image_link'], true);

		// Sync tags
		if($data['tags'])
            $product->syncTags($product, explode(',', $data['tags']));

		return $product;
	}

	/**
	 * [downloadCategorySlugs]
	 *
	 * @param  Excel  $excel
	 */
	public function downloadCategorySlugs(ExportCategoryRequest $request)
	{
		$categories = Category::select('name','slug')->get();

		return (new FastExcel($categories))->download('categories.xlsx');
	}

	/**
	 * downloadTemplate
	 *
	 * @return response response
	 */
	public function downloadTemplate()
	{
		$pathToFile = public_path("csv_templates/products.csv");

		return response()->download($pathToFile);
	}


	/**
	 * [downloadFailedRows]
	 *
	 * @param  Excel  $excel
	 */
	public function downloadFailedRows(Request $request)
	{
		foreach ($request->input('data') as $row)
			$data[] = unserialize($row);

		return (new FastExcel(collect($data)))->download('failed_rows.xlsx');
	}

	/**
	 * Push New value Into Failed List
	 *
	 * @param  array  $data
	 * @param  str $reason
	 * @return void
	 */
	private function pushIntoFailed(array $data, $reason = Null)
	{
		$row = [
			'data' => $data,
			'reason' => $reason,
		];

		array_push($this->failed_list, $row);
	}

	/**
	 * Return the failed list
	 *
	 * @return array
	 */
	private function getFailedList()
	{
		return $this->failed_list;
	}
}
