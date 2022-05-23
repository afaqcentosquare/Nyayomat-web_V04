<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Inventory;

class StockOutController extends Controller
{

    public function index()
    {
        $data = Inventory::select("users.name","inventories.shop_id")->join("users", "users.shop_id", "inventories.shop_id")->where("stock_quantity", "<=", 10 )->groupBy("inventories.shop_id")->selectRaw('count(*) as item_count')->paginate(10);
        
        $product_details = Inventory::where("stock_quantity", "<=", 10 )->get();
        
        return view('pages.backend.admin.stockouts')->with("data", $data)->with("product_details", $product_details);
    }
}
