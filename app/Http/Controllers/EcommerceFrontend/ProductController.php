<?php

namespace App\Http\Controllers\EcommerceFrontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class ProductController extends Controller
{

    public function products($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $products = $category->listings()
        ->whereHas('product')->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'images:path,imageable_id,imageable_type'])->paginate(15);
    //   return response()->json($products);

        //return response()->json($products);
        return view('ecommerce_frontend.category_products')
        ->with('category', $category)
        ->with('products', $products);
    }
}