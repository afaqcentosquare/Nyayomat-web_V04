<?php

namespace App\Http\Controllers\EcommerceFrontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CheckoutController extends Controller
{

    public function categories()
    {
        return view('ecommerce_frontend.checkout');
    }
}