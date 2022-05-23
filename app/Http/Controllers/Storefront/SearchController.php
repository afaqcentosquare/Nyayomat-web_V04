<?php

namespace App\Http\Controllers\Storefront;

use App\Category;
use App\Location;
use App\Inventory;
use Carbon\Carbon;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// use Illuminate\Pagination\Paginator;

// use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @param Request $request
     */
    public function search(Request $request)
    {
        
        // $products = Inventory::search($term)->where('active', 1)->get();
        $selectedLocation = Location::where('id', (session('selected_country')))->first();
        
        // $category = $request->input('in');
        $term = $request->input('search');
        
        // $products = Inventory::search($term)->where('active', 1)->get();
        $inventories = Inventory::where('description', 'like', '%' . $term . '%')
            ->orWhere('meta_description', 'like', '%' . $term . '%')
            ->orWhere('title', 'like', '%' . $term . '%')
            ->orWhereHas('shop', function ($shop) use ($term) {
                return $shop->where('name', 'like', '%' . $term . '%');
            })
            ->whereHas('product', function ($product) use ($selectedLocation) {
                $product->whereHas('locations', function ($location) use ($selectedLocation) {
                    return $location->where('id', $selectedLocation->id);
                });
            })
            ->where('active', 1)
            ->get();

        // echo "<pre>"; print_r($products); echo "</pre>"; exit();
        $inventories->load(['shop:id,current_billing_plan,active']);
        // Keep results only from active shops
        $inventories = $inventories->filter(function ($inventor) use ($selectedLocation) {
            return (
                $inventor->shop->current_billing_plan !== null)
                && ($inventor->shop->active == 1
                && in_array($selectedLocation->id, $inventor->product->locations->pluck('id')->toArray())
            );
        });
        // dd($inventories->first()->product->locations, $inventories->first()->locations);
        // if ($category != 'all_categories') {
        //     $category = Category::where('slug', $category)->active()->firstOrFail();
        //     $listings = $category->listings()->available()->get();
        //     $products = $products->intersect($listings);
        // }

        $inventories = $inventories->where('stock_quantity', '>', 0)->where('available_from', '<=', Carbon::now());
        // Attributes for filters
        $brands = ListHelper::get_unique_brand_names_from_linstings($inventories);
        $priceRange = ListHelper::get_price_ranges_from_linstings($inventories);

        if ($request->has('free_shipping')) {
            $inventories = $inventories->where('free_shipping', 1);
        }
        if ($request->has('new_arrivals')) {
            $inventories = $inventories->where('created_at', '>', Carbon::now()->subDays(config('system.filter.new_arrival', 7)));
        }
        if ($request->has('has_offers')) {
            $inventories = $inventories->where('offer_price', '>', 0)
            ->where('offer_start', '<', Carbon::now())
            ->where('offer_end', '>', Carbon::now());
        }

        if ($request->has('sort_by')) {
            switch ($request->get('sort_by')) {
                case 'newest':
                    $inventories = $inventories->sortByDesc('created_at');
                    break;

                case 'oldest':
                    $inventories = $inventories->sortBy('created_at');
                    break;

                case 'price_acs':
                    $inventories = $inventories->sortBy('sale_price');
                    break;

                case 'price_desc':
                    $inventories = $inventories->sortByDesc('sale_price');
                    break;

                case 'best_match':
                default:
                    break;
            }
        }

        if ($request->has('condition')) {
            $inventories = $inventories->whereIn('condition', array_keys($request->input('condition')));
        }

        if ($request->has('price')) {
            $price = explode('-', $request->input('price'));
            $inventories = $inventories->where('sale_price', '>=', $price[0])->where('sale_price', '<=', $price[1]);
        }

        if ($request->has('brand')) {
            $inventories = $inventories->whereIn('brand', array_keys($request->input('brand')));
        }

        $inventories = $inventories->paginate(config('system.view_listing_per_page', 16));

        $inventories->load(['product' => function ($q) {
            $q->select('id')->with('categories:id,name,slug');
        }, 'feedbacks:rating,feedbackable_id,feedbackable_type', 'images:path,imageable_id,imageable_type']);

        $categories = $inventories->pluck('product.categories')->flatten()->unique('id');
       //return view('search_results', compact('inventories', 'categories', 'brands', 'priceRange'));
       return view('ecommerce_frontend.category_products', compact('inventories','categories', 'brands', 'priceRange'));
    }
}
