<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAccessRoleRequest;
use App\Http\Requests\UserAccessRoleUpdateRequest;
use App\UserAccessRole;
use App\UserActionCategory;
use Illuminate\Support\Facades\Auth;

class UserAccessRoleController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', UserAccessRole::class);
        return view('roles.index', ['roles' => UserAccessRole::where('id', '>', 1)->paginate(15)]);
    }

    public function create()
    {
        $this->authorize('viewAny', UserAccessRole::class);
        $this->authorize('create', UserAccessRole::class);
        $types = UserActionCategory::with('userActions')->get();
        $role = new UserAccessRole();
        $array = [];
        return view('roles.create', compact('types', 'role', 'array'));
    }

    public function store(UserAccessRoleRequest $request)
    {
        $this->authorize('viewAny', UserAccessRole::class);
        $this->authorize('create', UserAccessRole::class);
        $role = UserAccessRole::create($request->only('role_name'));
        $role->userActions()->sync($request->input('actions',[]));
        return redirect()->route('roles.index')->with('status', 'Role Successfully Created');

    }

    public function show(UserAccessRole $role)
    {
        $this->routeBlock($role);
        $this->authorize('viewAny', UserAccessRole::class);
        return view('roles.show' , compact('role'));
    }

    public function edit(UserAccessRole $role)
    {
        $this->myOwnRole($role);
        $this->routeBlock($role);
        $this->authorize('viewAny', UserAccessRole::class);
        $this->authorize('update', $role);
        $types = UserActionCategory::with('userActions')->get();
        $array = [];
        foreach($role->userActions as $value){
            $array[] = $value->id;
        }
        return view('roles.edit', compact('types','role', 'array')); // use route model binding
    }

    public function update(UserAccessRoleUpdateRequest $request, UserAccessRole $role)
    {
        $this->myOwnRole($role);
        $this->routeBlock($role);
        $this->authorize('viewAny', UserAccessRole::class);
        $this->authorize('update', $role);
        $role->update($request->only('role_name'));
        $role->userActions()->sync($request->input('actions',[]));
        return redirect()->route('roles.index')->with('status' , 'Role Successfully Updated');
    }

    private function routeBlock($role)
    {
        if(in_array($role->id ,[1])){
            return abort(404);
        }
    }

    private function myOwnRole($role)
    {
        if (Auth::user()->userAccessRole->id == $role->id){
            return abort(404);
        }
    }

}
