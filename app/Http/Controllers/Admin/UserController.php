<?php

namespace App\Http\Controllers\Admin;

use App\Common\Authorizable;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Events\User\UserCreated;
use App\Events\User\UserUpdated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepository;
use App\Http\Requests\Validations\CreateUserRequest;
use App\Http\Requests\Validations\UpdateUserRequest;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use Authorizable;

    private $model_name;

    private $user;

    /**
     * construct.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        parent::__construct();
        $this->model_name = trans('app.model.user');
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->all();

        $trashes = $this->user->trashOnly();

        return view('admin.user.index', compact('users', 'trashes'));
    }

     /**
     * Display a listing of users with roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function system_actors(Request $request)
    {
       

        $roles = Role::orderBy('id','asc')->get();
   

        if( $request->has('role'))
        {
            $roleName = $sentrole = $request->role;

            $users = User::whereHas('roles', function ($q) use ($roleName) {
                $q->where('name', $roleName);
            })->paginate(10);
        }
   
        else
        {
            $sentrole = $roleName = "Merchant";

            $users = User::where("role_id", 3)->paginate(10);
            
        }     
        $pean = Str::random(10);

        return view('pages.backend.admin.actors', compact('roles','users','pean','sentrole'));
    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Check if the merchant can add more user in the team
        if (auth()->user()->isFromPlatform() || auth()->user()->shop->canAddMoreUser()) {
            return view('admin.user._create');
        }

        return view('admin.partials._max_user_limit_notice');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = $this->user->store($request);

        event(new UserCreated($user, auth()->user()->getName(), $request->get('password')));

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
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
        $user = $this->user->find($id);

        return view('admin.user._show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        return view('admin.user._edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        if (env('APP_DEMO') == true && $id <= config('system.demo.users', 3)) {
            return back()->with('warning', trans('messages.demo_restriction'));
        }

        $user = $this->user->update($request, $id);

        event(new UserUpdated($user));

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        if (env('APP_DEMO') == true && $id <= config('system.demo.users', 3)) {
            return back()->with('warning', trans('messages.demo_restriction'));
        }

        $user = $this->user->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model_name]));
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
        $this->user->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model_name]));
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
        $this->user->destroy($id);

        return back()->with('success', trans('messages.deleted', ['model' => $this->model_name]));
    }

    
    /**
     * Suspend user.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function suspend_user($id)
    {
        $user = $this->user->find($id);
        

            if($user->suspended>0)
            {
            $user->Where('id',$id)->update(['suspended' => 0 ]);
            }
            else
            {
                $user->Where('id',$id)->update(['suspended' => 1 ]);
            }


        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }
}
