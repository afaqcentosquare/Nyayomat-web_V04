<?php

namespace App\Http\Controllers\EcommerceFrontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Location;

class HomeController extends Controller
{

    public function ecommerceView()
    {
        $locations = Location::all();
        return view('ecommerce_frontend.customer.index')->with('locations', $locations);
    }

    public function commonHome()
    {
        return view('ecommerce_frontend.index');
    }
}
