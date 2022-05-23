<?php

namespace App\Http\Controllers\Admin;

use App\Common\Authorizable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleRepository;
use App\Http\Requests\Validations\CreateRoleRequest;
use App\Http\Requests\Validations\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Module;

class RoleController extends Controller
{
    use Authorizable;

    private $model_name;

    private $role;

    /**
     * construct
     */
    public function __construct(RoleRepository $role)
    {
        parent::__construct();

        $this->model_name = trans('app.model.role');

        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role->all();

        $trashes = $this->role->trashOnly();

        return view('admin.role.index', compact('roles', 'trashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $this->role->store($request);

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->role->find($id);

        $role_permissions = $this->role->getPermissions($role);

        return view('admin.role._show', compact('role', 'role_permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
       
        $role = Role::findByName($request->rolename);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$request->roleid)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('pages.backend.admin.edit-role', compact('role','permissions','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if( env('APP_DEMO') == true && $id <= config('system.demo.roles', 3) )
            return back()->with('warning', trans('messages.demo_restriction'));

            $this->validate($request, [
                'name' => 'required',
                'permission' => 'required',
            ]);

            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->description = $request->input('description');
            $role->save();
    
    
            $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles')->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        if( env('APP_DEMO') == true && $id <= config('system.demo.roles', 3) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $this->role->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model_name]));
    }

    
    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteRole( $id , $name )
    {
        $role = Role::where('name',$name)->where('id',$id)->first();

        if($role)
        {
            DB::table('roles')->where('name',$name)->where('id',$id)->delete();
            return redirect()->back()
            ->with('success','Role '.$name.' deleted successfully ');
        }
     
        return redirect()->back()
                        ->with('success','Missing role'.$role);
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
        $this->role->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->role->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

    public function createRole(Request $request)
    {
        $rolename = $request->input('role_name');

        $role = New Role();
        $role->name = $rolename;
        $role->description = $request->input('role_description');
        $role->save();

        $module_permissions = $request->input('permissions');

        // foreach($module_permissions as $module_permission )
        // {
        //     $extract_module = explode('_',$module_permission);
        //     $module = $extract_module[0];
        //     $permission = $module_permission;
        // }

        dd($module_permissions);

        // $role->givePermissionTo([$module_permissions]);

        // $role->associate()->save();

        return back()->with('success',  'Role created successfully');
    }

    public function createNewRole(Request $request)
    {
        $this->validate($request, [
            'role_name' => 'required|unique:roles,name',
            'permission' => 'required',
            'role_target' => 'required'
        ]);

        $rolee = Role::create([
            'name' => $request->input('role_name'),
            'description' => $request->input('role_description'),
            'level' => $request->input('role_target'),
        ]);

        $user = Auth::user();
        $user->assignRole($request->input('role_name'));

       
         // give logged user admin
         if($request->input('role_name') === 'Super Admin')
         {
         $rolee->givePermissionTo(Permission::all());
         }
          // end give logged user admin
        $rolee->givePermissionTo($request->input('permission'));

        // $role->syncPermissions($request->input('permission'));

// dd($request->input('permission'));

        return redirect()->back()
                        ->with('success','Role created successfully');
    }

    public function createNewPermission(Request $request)
    {
        $this->validate($request, [
            'permission_slug' => 'required',
            'module_id' => 'required',
        ]);

        $moduleName = Module::find($request->input('module_id'));

        $name = $request->input('permission_slug')."_".$moduleName->name;

        $check_existance_of_permission = Permission::where('name',$name)->first();

        if($check_existance_of_permission == Null )
        {
            Permission::create([
            'name' => strtolower($request->input('permission_slug'))."_".strtolower($moduleName->name),
            'module_id' => $request->input('module_id'),
            'slug' => ucfirst(strtolower($request->input('permission_slug')))
        ]);
          return redirect()->back()
                        ->with('success','Permission created successfully');
    }
        return redirect()->back()
                        ->with('success','Permissin already exists!');
    }

    public function showRoleswithPermissions()
    {

        $roles = Role::orderBy('id','desc')->get();
        foreach( $roles as $role )
        {
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
            $role->push($rolePermissions);
        }

        return view('pages.backend.admin.roles',compact('roles'));
    }

    // update users role
    public function userroleupdater(Request $request,$id,$name)
    {
        $user = User::Where('name',$name)->where('id',$id)->first();

        // $user->syncRoles($request->role);

        $user->assignRole($request->role);

        //$role = Role::findByName($request->role);
        // $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        //     ->where("role_has_permissions.role_id",$role->id)
        //     ->get();

        // $user->syncPermissions($rolePermissions);

        return back()->with('success', 'Role changed');
    }

}
