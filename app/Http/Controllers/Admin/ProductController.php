<?php

namespace App\Http\Controllers\Admin;

use App\Common\Authorizable;
use App\Product;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepository;
// use App\Http\Requests\Validations\CreateProductRequest;
// use App\Http\Requests\Validations\UpdateProductRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use Authorizable;
    use SoftDeletes;

    private $model;

    private $product;

    /**
     * construct.
     *
     * @param ProductRepository $product
     */
    public function __construct(ProductRepository $product)
    {
        parent::__construct();
        $this->model = trans('app.model.product');
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->all();

        $trashes = $this->product->trashOnly();

        return view('admin.product.index', compact('trashes', 'products'));
    }

    // function will process the ajax request
    public function getProducts(Request $request)
    {
        $products = $this->product->all();

        return Datatables::of($products)
            ->addColumn('option', function ($product) {
                return view('admin.partials.actions.product.options', compact('product'));
            })
            ->editColumn('name', function ($product) {
                return view('admin.partials.actions.product.name', compact('product'));
            })
            ->editColumn('gtin', function ($product) {
                return view('admin.partials.actions.product.gtin', compact('product'));
            })
            ->editColumn('category', function ($product) {
                return view('admin.partials.actions.product.category', compact('product'));
            })
            ->editColumn('inventories_count', function ($product) {
                return view('admin.partials.actions.product.inventories_count', compact('product'));
            })
            ->rawColumns(['name', 'gtin', 'category', 'inventories_count', 'status', 'option'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $this->authorize('create', \App\Product::class); // Check permission

        $product = $this->product->store($request);
        $product->locations()->sync($request->input('origin_country'));

        $request->session()->flash('success', trans('messages.created', ['model' => $this->model]));

        return response()->json($this->getJsonParams($product));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->find($id);

        $this->authorize('view', $product); // Check permission

        return view('admin.product._show', compact('product'));
    }

  /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
       
        $product = Product::find($request->product_id);
  

        return view('pages.backend.admin.edit-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = $this->product->update($request, $id);
        $product->locations()->sync($request->input('origin_country'));
        $this->authorize('update', $product); // Check permission
        $request->session()->flash('success', trans('messages.updated', ['model' => $this->model]));

        return response()->json($this->getJsonParams($product));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct( $id , $name )
    {
        $product = Product::where('name',$name)->where('id',$id)->first();

        if($product)
        {
            DB::table('products')->where('name',$name)->where('id',$id)->delete();
            return redirect()->back()
            ->with('success','Product deleted successfully '.$id);
        }
     
        return redirect()->back()
                        ->with('success','Missing '.$id);
    }



    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->product->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->product->destroy($id);
        
        return back()->with('success', trans('messages.deleted', ['model' => $this->model]));
    }

    /**
     * return json params to procceed the form.
     *
     * @param  Product $product
     *
     * @return array
     */
    private function getJsonParams($product)
    {
        return [
            'id' => $product->id,
            'model' => 'product',
            'redirect' => route('admin.catalog.product.index'),
        ];
    }

    public function getspecificProduct( $productname )
    {
     
                
            //  return  $users = User::Where('role_id','=',1)->get();
            $products = Product::where('name',$productname)->get();

     
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
      
              

     return view('pages.backend.admin.specific-product',compact('products'));
      
    }
}
