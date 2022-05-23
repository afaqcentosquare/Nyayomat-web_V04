<?php

namespace App\Http\Controllers\Storefront;

use DB;
use Session;
use App\Page;
use App\Shop;
use App\Banner;
use App\Slider;
use App\Country;
use App\Product;
use App\Category;
use App\Location;
use App\Inventory;
use Carbon\Carbon;
use App\Manufacturer;
use App\CategoryGroup;
use App\CategoryProduct;
use App\CategorySubGroup;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $sliders = Slider::with('featuredImage:path,imageable_id,imageable_type')->orderBy('order', 'asc')->get()->toArray();
        $banner = Banner::with('featuredImage:path,imageable_id,imageable_type', 'images:path,imageable_id,imageable_type')
            ->orderBy('order', 'asc')->get()->groupBy('group_id')->toArray();

        $trending = ListHelper::popular_items(config('system.popular.period.trending', 2), config('system.popular.take.trending', 15));
        $weekly_popular = ListHelper::popular_items(config('system.popular.period.weekly', 7), config('system.popular.take.weekly', 5));

        $recent = ListHelper::latest_available_items(10);
        $additional_items = ListHelper::random_items(10);

        $countries = Location::where('deleted_at', null)->get();

        return view('ecommerce_frontend.customer.index', compact('banner', 'sliders', 'trending', 'weekly_popular', 'recent', 'additional_items', 'countries'));
        //return view('index', compact('banner', 'sliders', 'trending', 'weekly_popular', 'recent', 'additional_items', 'countries'));
    }

    public function country(Request $request)
    {
        $data = $request->all();
        $country = $data['country'] ?? session('selected_country');
        session(['selected_country' => $country]);
        $cat = ListHelper::location_categories($country);
        $catr = [];
        foreach ($cat as $c) {
            $catr[] = [$c->id];
        }
        $categories = Category::whereIn('id', $catr)->get();
        $sliders = Slider::with('featuredImage:path,imageable_id,imageable_type')->orderBy('order', 'asc')->get()->toArray();
        $banners = Banner::with('featuredImage:path,imageable_id,imageable_type', 'images:path,imageable_id,imageable_type')
            ->where('location', $country)->orderBy('order', 'asc')->get()->groupBy('group_id')->toArray();

        $trending = ListHelper::popular_items(config('system.popular.period.trending', 2), config('system.popular.take.trending', 15));
        $weekly_popular = ListHelper::popular_items(config('system.popular.period.weekly', 7), config('system.popular.take.weekly', 5));

        $recent = ListHelper::latest_available_items(10);
        $additional_items = ListHelper::random_items(10);

        $countries = Country::get();

        return view('ecommerce_frontend.categories', compact('banners', 'sliders', 'trending', 'weekly_popular', 'recent', 'additional_items', 'countries', 'categories'));
        //return view('country_category', compact('banners', 'sliders', 'trending', 'weekly_popular', 'recent', 'additional_items', 'countries', 'categories'));
    }

    /**
     * Browse category based products.
     *
     * @param  slug  $slug
     * @param Request $request
     * @param mixed|null $sortby
     *
     * @return \Illuminate\Http\Response
     */
    public function browseCategory(Request $request, $slug, $sortby = null)
    {
        // echo "<pre>"; print_r($request->all()); exit;
        $location = session('selected_country');
        $category = Category::where('slug', $slug)->with(['subGroup' => function ($q) {
            $q->select(['id', 'slug', 'name', 'category_group_id'])->active();
        }, 'subGroup.group' => function ($q) {
            $q->select(['id', 'slug', 'name'])->active();
        }])->active()->firstOrFail();

        // Take only available items
        $all_products = $category->listings()
        ->whereHas('product',function($query) use($location){
            $query->whereHas('locations', function($query) use($location){
                $query->where('id',$location);
            });
        });

        // Parameter for filter options
        $brands = ListHelper::get_unique_brand_names_from_linstings($all_products);
        $priceRange = ListHelper::get_price_ranges_from_linstings($all_products);
        // echo "<pre>"; print_r($priceRange); exit;
        // Filter results
        $inventories = $all_products->filter($request->all())
            ->withCount(['feedbacks', 'orders' => function ($query) {
                $query->where('order_items.created_at', '>=', Carbon::now()->subHours(config('system.popular.hot_item.period', 24)));
            }])
            ->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'images:path,imageable_id,imageable_type'])
            ->paginate(config('system.view_listing_per_page', 16))->appends($request->except('page'));
            // ->paginate(config('system.view_listing_per_page', 16))->appends($request->except('page'));
        $categories = Category::get();

        return view('ecommerce_frontend.category_products', compact('category', 'inventories', 'brands', 'priceRange', 'categories'));

        // return view('category', compact('category', 'inventories', 'brands', 'priceRange', 'categories'));
    }

    /**
     * Browse listings by category sub group.
     *
     * @param  slug  $slug
     * @param Request $request
     * @param mixed|null $sortby
     *
     * @return \Illuminate\Http\Response
     */
    public function browseCategorySubGrp(Request $request, $slug, $sortby = null)
    {
        $categorySubGroup = CategorySubGroup::where('slug', $slug)->with(['categories' => function ($q) {
            $q->select(['id', 'slug', 'category_sub_group_id', 'name'])->whereHas('listings')->active();
        }])->active()->firstOrFail();

        $categories = $categorySubGroup->categories;

        $all_products = prepareFilteredListings($request, $categorySubGroup);

        // Get brands ans price ranges
        $brands = ListHelper::get_unique_brand_names_from_linstings($all_products);
        $priceRange = ListHelper::get_price_ranges_from_linstings($all_products);

        // Paginate the results
        $products = $all_products->paginate(config('system.view_listing_per_page', 16))->appends($request->except('page'));

        return view('category_sub_group', compact('categorySubGroup', 'categories', 'products', 'brands', 'priceRange'));
    }

    /**
     * Browse listings by category group.
     *
     * @param  slug  $slug
     * @param Request $request
     * @param mixed|null $sortby
     *
     * @return \Illuminate\Http\Response
     */
    public function browseCategoryGroup(Request $request, $slug, $sortby = null)
    {
        $categoryGroup = CategoryGroup::where('slug', $slug)->with(['categories' => function ($q) {
            $q->select(['categories.id', 'categories.slug', 'categories.category_sub_group_id', 'categories.name'])
                ->where('categories.active', 1)->whereHas('listings')->withCount('listings');
        }])->active()->firstOrFail();

        $categories = $categoryGroup->categories;

        $all_products = prepareFilteredListings($request, $categoryGroup);

        // Get brands ans price ranges
        $brands = ListHelper::get_unique_brand_names_from_linstings($all_products);
        $priceRange = ListHelper::get_price_ranges_from_linstings($all_products);

        // Paginate the results
        $products = $all_products->paginate(config('system.view_listing_per_page', 16))->appends($request->except('page'));

        return view('category_group', compact('categoryGroup', 'categories', 'products', 'brands', 'priceRange'));
    }

    /**
     * Open product page.
     *
     * @param  slug  $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function product($slug)
    {
        $item = Inventory::where('slug', $slug)->withCount('feedbacks')->firstOrFail();
        $final_products = [];
        $item->load([
            'product' => function ($q) {
                $q->select('id', 'slug', 'description', 'manufacturer_id')
                    ->withCount(['inventories' => function ($query) {
                        $query->available();
                    }]);
            }, 'attributeValues' => function ($q) {
                $q->select('id', 'attribute_values.attribute_id', 'value', 'color', 'order')->with('attribute:id,name,attribute_type_id,order');
            },
            'feedbacks.customer:id,nice_name,name',
            'images:path,imageable_id,imageable_type',
        ]);

        $this->update_recently_viewed_items($item); //update_recently_viewed_items

        $variants = ListHelper::variants_of_product($item, $item->shop_id);

        $attr_pivots = \DB::table('attribute_inventory')->select('attribute_id', 'inventory_id', 'attribute_value_id')
            ->whereIn('inventory_id', $variants->pluck('id'))->get();

        $item_attrs = $attr_pivots->where('inventory_id', $item->id)->pluck('attribute_value_id')->toArray();

        $attributes = \App\Attribute::select('id', 'name', 'attribute_type_id', 'order')
            ->whereIn('id', $attr_pivots->pluck('attribute_id'))
            ->with(['attributeValues' => function ($query) use ($attr_pivots) {
                $query->whereIn('id', $attr_pivots->pluck('attribute_value_id'))->orderBy('order');
            }])->orderBy('order')->get();

        $variants = $variants->toJson(JSON_HEX_QUOT);

        // TEST
        $related = ListHelper::related_products($item);
        $linked_items = ListHelper::linked_items($item);

        if (!$linked_items->count()) {
            $linked_items = $related->random($related->count() >= 3 ? 3 : $related->count());
        }

        $geoip = geoip(request()->ip()); // Set the location of the user
        $countries = ListHelper::countries(); // Country list for shop_to dropdown

        $new_products = Inventory::where('slug', $slug)->get();

        if (count($new_products) > 0) {
            $product_id = $new_products[0]->product_id;

            // Get product linked to the selected inventory item
            $linkedProduct = DB::table('products')->where('id', $product_id)->first();

            $prod = DB::table('products')->where('name', 'like', '%' . $linkedProduct->name . '%')->get();

            foreach ($prod as $fpd) {
                $inv = DB::table('inventories')->where('product_id', $fpd->id)->orderBy('sale_price')->get();
                if (count($inv) > 0) {
                    //TODO - loop over all the inventories and add

                    foreach ($inv as $finv) {
                        // Get the shop
                        $shop = DB::table('shops')->where('id', $finv->shop_id)->first();
                        $rating_total = '0';
                        $total_rating = '0';
                        $order = DB::table('orders')->where('shop_id', $fpd->shop_id)->get();
                        foreach ($order as $ord) {
                            if ($ord->feedback_id != '') {
                                $total_rating += '1';

                                $feedback = DB::table('feedbacks')->where('id', $ord->feedback_id)->get();

                                $rating_total += $feedback[0]->rating;
                            }
                        }
                        if ($rating_total == '0') {
                            $f_rating = '0';
                        } else {
                            $s_rating = round($rating_total / $total_rating);

                            if ($s_rating >= 5) {
                                $f_rating = '5';
                            } else {
                                $f_rating = $s_rating;
                            }
                        }
                        if ($slug == $finv->slug) {
                            array_unshift($final_products, [
                                'name' => $finv->title,
                                'price' => round($finv->sale_price, 2),
                                'shop' => $shop->name,
                                'rating' => $f_rating,
                                'slug' => $finv->slug,
                                'id' => $finv->id,
                            ]);
                        } else {
                            $final_products[] = [
                                'name' => $finv->title,
                                'price' => round($finv->sale_price, 2),
                                'shop' => $shop->name,
                                'rating' => $f_rating,
                                'slug' => $finv->slug,
                                'id' => $finv->id,
                            ];
                        }
                    }
                }
            }
        }
        // return response()->json($final_products);
        return view('ecommerce_frontend.single_product' , compact('item', 'variants', 'attributes', 'item_attrs', 'related', 'linked_items', 'geoip', 'countries', 'final_products'));

        // exit();
        // return view('product', compact('item', 'variants', 'attributes', 'item_attrs', 'related', 'linked_items', 'geoip', 'countries', 'final_products'));
        // return view('product');
    }

    // public function product($slug)
    // {
    //     $item = Inventory::where('slug', $slug)->available()->withCount('feedbacks')->firstOrFail();

    //     $item->load(['product' => function($q){
    //             $q->select('id', 'slug', 'description', 'manufacturer_id')
    //             ->withCount(['inventories' => function($query){
    //                 $query->available();
    //             }]);
    //         }, 'attributeValues' => function($q){
    //             $q->select('id', 'attribute_values.attribute_id', 'value', 'color', 'order')->with('attribute:id,name,attribute_type_id,order');
    //         },
    //         'feedbacks.customer:id,nice_name,name',
    //         'images:path,imageable_id,imageable_type',
    //     ]);

    //     $this->update_recently_viewed_items($item); //update_recently_viewed_items

    //     $variants = ListHelper::variants_of_product($item, $item->shop_id);

    //     $attr_pivots = \DB::table('attribute_inventory')->select('attribute_id','inventory_id','attribute_value_id')
    //     ->whereIn('inventory_id', $variants->pluck('id'))->get();

    //     $item_attrs = $attr_pivots->where('inventory_id', $item->id)->pluck('attribute_value_id')->toArray();

    //     $attributes = \App\Attribute::select('id','name','attribute_type_id','order')
    //     ->whereIn('id', $attr_pivots->pluck('attribute_id'))
    //     ->with(['attributeValues' => function($query) use ($attr_pivots) {
    //         $query->whereIn('id', $attr_pivots->pluck('attribute_value_id'))->orderBy('order');
    //     }])->orderBy('order')->get();

    //     $variants = $variants->toJson(JSON_HEX_QUOT);

    //     // TEST
    //     $related = ListHelper::related_products($item);
    //     $linked_items = ListHelper::linked_items($item);

    //     if( ! $linked_items->count() )
    //         $linked_items = $related->random($related->count() >= 3 ? 3 : $related->count());

    //     $geoip = geoip(request()->ip()); // Set the location of the user
    //     $countries = ListHelper::countries(); // Country list for shop_to dropdown

    //     // echo "<pre>"; print_r($attributes->toArray()); echo "</pre>"; exit();
    //     return view('product', compact('item', 'variants', 'attributes', 'item_attrs', 'related', 'linked_items', 'geoip', 'countries'));
    // }

    /**
     * Open product quick review modal.
     *
     * @param  slug  $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function quickViewItem($slug)
    {
        $item = Inventory::where('slug', $slug)->available()
            ->with([
                'images:path,imageable_id,imageable_type',
                'product' => function ($q) {
                    $q->select('id', 'slug')
                        ->withCount(['inventories' => function ($query) {
                            $query->available();
                        }]);
                },
                'attributeValues' => function ($q) {
                    $q->select('id', 'attribute_values.attribute_id', 'value', 'color', 'order')->with('attribute:id,name,attribute_type_id');
                },
            ])
            ->withCount('feedbacks')->firstOrFail();

        $this->update_recently_viewed_items($item); //update_recently_viewed_items

        return view('modals.quickview', compact('item'))->render();
    }

    /**
     * Open shop page.
     *
     * @param  slug  $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function offers($slug)
    {
        $product = Product::where('slug', $slug)->with([
            'inventories' => function ($q) {
                $q->available();
            }, 'inventories.attributeValues.attribute',
            'inventories.feedbacks:rating,feedbackable_id,feedbackable_type',
            'inventories.shop.feedbacks:rating,feedbackable_id,feedbackable_type',
            'inventories.shop.image:path,imageable_id,imageable_type',
        ])->firstOrFail();

        return view('offers', compact('product'));
    }

    /**
     * Open shop page.
     *
     * @param  slug  $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function shop($slug)
    {
        $shop = Shop::where('slug', $slug)
            ->with(['feedbacks' => function ($q) {
                $q->with('customer:id,nice_name,name')->latest()->take(10);
            }])
            ->withCount(['inventories' => function ($q) {
                $q->available();
            }])->firstOrFail();

        // Check shop maintenance_mode
        // if(getShopConfig($shop->id, 'maintenance_mode'))
        //     return response()->view('errors.503', [], 503);

        $inventories = Inventory::where('shop_id', $shop->id)->filter(request()->all())
            ->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'images:path,imageable_id,imageable_type'])
            ->withCount(['orders' => function ($q) {
                $q->where('order_items.created_at', '>=', Carbon::now()->subHours(config('system.popular.hot_item.period', 24)));
            }])
            ->paginate(20);

            return view('ecommerce_frontend.shop');
        // return view('shop', compact('shop', 'inventories'));
    }

    /**
     * Open brand page.
     *
     * @param  slug  $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function brand($slug)
    {
        $brand = Manufacturer::where('slug', $slug)->firstOrFail();

        $ids = Product::where('manufacturer_id', $brand->id)->pluck('id');

        $products = Inventory::whereIn('product_id', $ids)->filter(request()->all())
            ->whereHas('shop', function ($q) {
                $q->select(['id', 'current_billing_plan', 'active'])->active();
            })
            ->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'images:path,imageable_id,imageable_type'])
            ->withCount(['orders' => function ($q) {
                $q->where('order_items.created_at', '>=', Carbon::now()->subHours(config('system.popular.hot_item.period', 24)));
            }])
            ->active()->paginate(20);

        return view('brand', compact('brand', 'products'));
    }

    
    //   Display the category list page.
    //  @return \Illuminate\Http\Response
     
    // public function categories()
    // {
    //     $availableProducts = [];
    //     return view('categories', compact('availableProducts'));
    // }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function openPage($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('page', compact('page'));
    }

    /**
     * Change Language.
     *
     * @param  string $locale
     *
     * @return \Illuminate\Http\Response
     */
    public function changeLanguage($locale = 'en')
    {
        Session::put('locale', $locale);

        return redirect()->back();
    }

    /**
     * Push product ID to session for the recently viewed items section.
     *
     * @param  [type] $item [description]
     */
    private function update_recently_viewed_items($item)
    {
        $items = Session::get('products.recently_viewed_items', []);

        if (!in_array($item->getKey(), $items)) {
            Session::push('products.recently_viewed_items', $item->getKey());
        }

        return;
    }
}
