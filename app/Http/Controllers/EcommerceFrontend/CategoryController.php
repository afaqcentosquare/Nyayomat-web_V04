<?php

namespace App\Http\Controllers\EcommerceFrontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Helpers\ListHelper;

class CategoryController extends Controller
{

    public function categories($location = null)
    {
        session(['selected_country' => $location]);
        if ($location != null) {
            $cat = ListHelper::location_categories($location);
            $catr = [];
            foreach ($cat as $c) {
                $catr[] = [$c->id];
            }
            $categories = Category::whereIn('id', $catr)->get();
        }
        else {
            $categories = Category::all();
        }
        return view('ecommerce_frontend.categories')->with('categories', $categories);
    }
}
