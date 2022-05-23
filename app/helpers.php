<?php

use App\Announcement;
use App\Category;
use App\CategorySubGroup;
use App\CategoryGroup;
use App\User;
use App\Order;
use App\Slider;
use App\Faq;
use App\FaqTopic;
use App\Inventory;
use App\Location;
use App\BannerGroup;
use App\Product;
use App\Region;
use App\Customer;
use App\Page;
use App\Banner;
use App\Permission;
use App\Module;
use App\Shop;
use App\EmailTemplate;
use App\Role;
use Illuminate\Support\Facades\DB;
use OpenCloud\Autoscale\Resource\Group;
use Illuminate\Support\Facades\Auth;

if (!function_exists('reportException')) {
    function reportException(Exception $exception)
    {
        app(Illuminate\Contracts\Debug\ExceptionHandler::class)->report($exception);
    }
}

// users registered per month -- array returned
function active_users()
{
    $year = 2019;

    $users_registered_per_month = DB::table('users')
    ->whereYear('created_at', '=', $year )
     ->select(DB::raw('count(id) as total'), DB::raw('MONTH(created_at) as month'))
     ->groupBy('month')
     ->get();

     $per_month_count = [0,0,0,0,0,0,0,0,0,0,0,0];

    foreach($users_registered_per_month as $key)
    {
        $per_month_count[$key->month-1] = $key->total; //now fill month with  total value of users
    }

    return $per_month_count;
}


// sales values per month -- array returned
function sales_values()
{

    $year = 2019;
    $sales_values_per_month = DB::table('orders')
    ->whereYear('created_at', '=', $year )
     ->select(DB::raw('sum(total) as total'), DB::raw('MONTH(created_at) as month'))
     ->groupBy('month')
     ->get();

     $per_month_sum = [0,0,0,0,0,0,0,0,0,0,0,0];

    foreach($sales_values_per_month as $key)
    {
        $per_month_sum[$key->month-1] = floor($key->total);
    }

    return $per_month_sum;
}

// inventory
function getInventory()
{   
    return Inventory::all();
}

// get transactions
function transactions()
{   
    return Order::where('shop_id',Auth::user()->merchantId())->get();
}


// stock for merchant
function stocklist()
{   
  return Inventory::where('shop_id', Auth::user()->merchantId())->get();
}

// stock for merchant
function productlist()
{   
  return Product::where('shop_id', Auth::user()->merchantId())->get();
}

function getsMPs()
{
 
            
        //  return  $users = User::Where('role_id','=',1)->get();
        $products = Product::where('shop_id', Auth::user()->merchantId())->get();

 
        //   $categories = Category::with('products')->get();

          foreach ( $products as $product ) {
              
              foreach ($product->categories as $category) {

                $categories = $product->categories;

                    foreach ($categories as $category) {

                       $subgroups = $category->subGroup;

                       $groups = $subgroups->group;
                        
                            $product->push($groups);
                       
                    }

              }
          }    

 return $products;
  
}

    // actors to the system
    function systemActorsSuper_Admin()
    {

        //$users = User::whereHas("roles", function($q){ $q->where("name", "Super Admin"); })->get();
        // $roles = Role::all();
        // $users = User::with('roles')->get();
        // $users = $users->reject(function ($user, $key) {
        //     return $user->hasRole('Super Admin');
        // });
        // return view('admin.report_roles', ['roles'=>$roles, 'nonmembers' => $nonmembers]);
    }


    // users
    function users()
    {

        $users = User::with('locations')->get();

        return $users;
    }

      // merchant users with spatie
      function merchants_users()
      {
  
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'Merchants');
    })->get();

    
          return $users;
      }

      // return users permissions
      function user_permissions()
      {
  
        $user = Auth::user();
        $permissions = $user->permissions;
    

          return $permissions;
      }

      // Merchant users manual
     function merchant_Users()
     {
        return  $users = User::Where('role_id','=',3)->get();
     } 

  
    // gets all custommers
    function customers()
    {
      $customers = DB::table('users')->get()->join('customers')
      ->get();

      // Customer::orderBy('id','asc')->get();

     return $customers;
    }

      // gets all locations
      function locations()
      {   
       return  Location::orderBy('id','asc')->get();
      }


 
     

     // Merchant users
     function super_Admin_Users()
     {
        return  $users = User::Where('role_id','=',1)->get();
     } 


     // Get Groups
     function groups()
     {
        return  CategoryGroup::get();
     } 

      // Get Groups
      function subgroups()
      {
        
         return 

         CategorySubGroup::with(['categories' => function($query){

          $query->withCount('products');
       
       }])->get();

      //    return Event::with(['city.companies.persons' => function ($query) {
      //     $query->select('id', '...');
      // }])->get();
      } 

      // Get products its categories + group + subgroup inventory.php
      function getProducts()
      {
            //  return  $users = User::Where('role_id','=',1)->get();
                $products = Product::orderBy('id','desc')->take(20)->get();

            //   $categories = Category::with('products')->get();

              foreach ( $products as $product ) {
                  
                  foreach ($product->categories as $category) {

                    $categories = $product->categories;

                        foreach ($categories as $category) {

                           $subgroups = $category->subGroup;

                           $groups = $subgroups->group;
                            
                                $product->push($groups);
                           
                        }

                  }
              }

        return   $products;
      } 


      function getProductsByPaginate()
      {
            //  return  $users = User::Where('role_id','=',1)->get();
                $products = Product::orderBy('id','desc')->paginate(10);

            //   $categories = Category::with('products')->get();

              foreach ( $products as $product ) {
                  
                  foreach ($product->categories as $category) {

                    $categories = $product->categories;

                        foreach ($categories as $category) {

                           $subgroups = $category->subGroup;

                           $groups = $subgroups->group;
                            
                                $product->push($groups);
                           
                        }

                  }
              }

        return   $products;
      } 


      function specific_product_page()
      {
          return Product::with('image')->orderBy('id', 'desc')->get();
      }         
      

       // supply categories to views
       function getAllCategories()
       {
        return  Category::Where('deleted_at','=', Null )->orderBy('id','desc')->get();
       }
       
        // supply subgroups to views
        function getAllSubGroups()
        {
            return  CategorySubGroup::Where('deleted_at','=', Null )->orderBy('id','desc')->get();
        }

         // supply groups to views
       function getAllGroups()
       {
        return  CategoryGroup::Where('deleted_at','=', Null )->orderBy('id','desc')->get();
       }

        // supply pages
        function pages()
        {
            
         return  Page::Where('deleted_at','=', Null )->orderBy('id','desc')->get();
        }

        // supply banners
        function banners()
        {   
         return  Banner::orderBy('id','desc')->get();
        }

        // supply banners
        function sliders()
        {   
          return  Slider::orderBy('id','desc')->get();
        }

        // supply banner groups
        function bannergroups()
        {   
         return  BannerGroup::orderBy('id','desc')->get();
        }

         // supply FAQS
         function faqs()
         {   
          return  Faq::orderBy('id','desc')->get();
         }
          // supply FAQTopic
        function faqtopics()
        {   
         return  FaqTopic::orderBy('id','desc')->get();
        }

        // supply Anouncements
        function announcements()
        {   
          return  Announcement::orderBy('id','desc')->get();
        }

        // gets all roles
      function roles()
      {
        $roles = Role::orderBy('id','desc')->get();
        
        // foreach( $roles as $role )
        // {
        //     $users = User::whereHas(
        //         'roles', function($q) use ($role) {
        //             $q->where('name', $role->name);
        //         }
        //     )->get();

        //     $users_count = count($users);

        // $role->push($users_count);
        // }

       
        //$role_permissions = Role::with('permissions')->orderBy('id','desc')->get();


        return   $roles;
      } 

   

   // Get Permissions with related modules
   function getModules()
   {

    $modules = Module::orderBy('id','desc')->get();

           foreach ( $modules as $module ) {
                        $permissions = $module->permissions; 
                        $module->push($permissions);
                    }

     return   $modules;
   } 

     // Get Permissions with related modules
     function modules()
     {
  
      $modules = Module::orderBy('id','desc')->get();
  
       return   $modules;
     } 

       // 
       function webPages()
       {
    
        $pages = Page::with('author')->orderBy('id','asc')->get();
    
         return $pages;
       } 

      //  count sub-group categories
       function countCategoriesinSubgroup()
       {
          $subgroups = CategorySubGroup::Where('deleted_at','=', Null )->orderBy('id','desc')->get();

          foreach( $subgroups as $subgroup )
          {
            $getsubgroupincategories = Category::where('category_subgroup_id',$subgroup->id)->get();

            $getsubgroupincategories = count($getsubgroupincategories);

          }

       }


      //  Group, subgroup,category Breadcrums functions

      //  1. 
      
     
       //  get all shops to blade views
       function getShops()
       {
          return Shop::get();

       }

       function productsinCategoryCounter($categoryname)
       {
         $category = Category::where('name',$categoryname)->first();
         $products = $category->products()->count();
          return  $products ;
       }

       function getregionfromid($id)
       {
         $region = Region::find($id)->first();
  
          return  $region->name ;
       }

       function getEmailTemplates()
       {
        
          return  EmailTemplate::with('author')->orderBy('id','asc')->get();
       }




      

       
        


