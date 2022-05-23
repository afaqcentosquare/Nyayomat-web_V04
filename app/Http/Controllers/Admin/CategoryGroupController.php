<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\CategorySubGroup;
use App\CategoryGroup;
use App\Category;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryGroup\CategoryGroupRepository;
use App\Http\Requests\Validations\CreateCategoryGroupRequest;
use App\Http\Requests\Validations\UpdateCategoryGroupRequest;

class CategoryGroupController extends Controller
{
    use Authorizable;

    private $model_name;

    private $categoryGroup;

    /**
     * construct
     */
    public function __construct(CategoryGroupRepository $categoryGroup)
    {
        parent::__construct();
        $this->model_name = trans('app.model.category_group');
        $this->categoryGroup = $categoryGroup;
    }

    function formatGroupSlug($name, $char='-')
    {
            $newname = strtolower($name);
            $newname = preg_replace('/[^[:alnum:]]/', ' ', $newname);
            $newname = preg_replace('/[[:space:]]+/', $char, $newname);
            return trim($newname, $char);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $groups = CategoryGroup::with(['subgroups' , 'categories'])->paginate(10);

     
         //   $categories = Category::with('products')->get();

           return view('pages.backend.admin.group',compact('groups'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category._createGrp');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $slug = $this->formatGroupSlug($request->groupname);

        CategoryGroup::create([
            'name' => $request->groupname,
            'slug' =>  $slug,
            'description' => $request->description,
            'icon' =>  $request->group_icon,  
        ]);

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryGroup = $this->categoryGroup->find($id);

        return view('admin.category._editGrp', compact('categoryGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryGroupRequest $request, $id)
    {
        if( env('APP_DEMO') == true && $id <= config('system.demo.category_groups', 9) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $this->categoryGroup->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        if( env('APP_DEMO') == true && $id <= config('system.demo.category_groups', 9) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $this->categoryGroup->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model_name]));
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->categoryGroup->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->categoryGroup->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

    public function getSubGroups(Request $request)
    {
        $category_group = CategoryGroup::where("name", $request->group_id)->first();
        $data = CategorySubGroup::where("category_group_id",$category_group->id)
                    ->get(["name"]);
         return response()->json($data);
    }


    public function getCategoriesBySubGroups(Request $request)
    {
        $category_sub_group = CategorySubGroup::where("name", $request->sub_group_id)->first();
        $data = Category::where("category_sub_group_id",$category_sub_group->id)
                    ->get(["name"]);
         return response()->json($data);
    }

}
