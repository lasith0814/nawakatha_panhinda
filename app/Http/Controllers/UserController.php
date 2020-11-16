<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use App\UserAccessRole;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('viewAny' , User::class);
        return view('users.index', ['users' => User::where('id', '>', 2)->paginate(15)]);
    }

    public function indexInactive()
    {
        $this->authorize('viewAny' , User::class);
        return view('users.inactive', ['users' => User::where('id', '>', 2)->onlyTrashed()->paginate(15)]);
    }
    public function create()
    {
        $this->authorize('viewAny', User::class);
        $this->authorize('create', User::class);
        $types = UserAccessRole::where('id', '>', 1)->get();
        $user = new User();
        return view('users.create', compact('types', 'user'));
    }

    public function store(UserRequest $request)
    {
        $this->authorize('viewAny', User::class);
        $this->authorize('create', User::class);
        User::create(
            Arr::add($request->except('password','password_confirmation'), 'password', Hash::make($request->password))
        );
        return redirect()->route('users.index')->with('status', 'User Successfully Created');
    }

    public function deactivate(User $user)
    {
        $this->myOwnRole($user);
        $this->routeBlock($user);
        $this->authorize('viewAny', User::class);
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'User Successfully Deactivated. See on Inactive user list');
    }

    public function activate(User $user)
    {
        $this->myOwnRole($user);
        $this->routeBlock($user);
        $this->authorize('viewAny', User::class);
        $this->authorize('delete', $user);
        $user->restore();
        return redirect()->route('users.inactive')->with('status', 'User Successfully Activated. See on Active user list');
    }

    public function show(User $user)
    {
        $this->routeBlock($user);
        $this->authorize('viewAny', User::class);
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->myOwnRole($user);
        $this->routeBlock($user);
        $this->authorize('viewAny', User::class);
        $this->authorize('update', $user);
        $types = UserAccessRole::where('id', '>', 1)->get();
        return view('users.edit', compact('types', 'user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->myOwnRole($user);
        $this->routeBlock($user);
        $this->authorize('viewAny', User::class);
        $this->authorize('update', $user);
        $user->update($request->all());
        if ($user->trashed()){
            return redirect()->route('users.inactive')->with('status' , 'User Successfully Updated');
        }
        return redirect()->route('users.index')->with('status' , 'User Successfully Updated');
    }

    public function password(User $user, Request $request)
    {
        $this->myOwnRole($user);
        $request->validate([
            'password' => ['required', 'min:8', 'max:15', 'confirmed' , 'spaceNotAllow'],
            'password_confirmation' => ['required', 'min:8', 'max:15' , 'spaceNotAllow'],
        ]);
        $user->update(['password' => Hash::make($request->get('password'))]);

        return redirect()->route('users.edit' ,$user)->with('status_password' , 'Password successfully updated');
    }

    private function routeBlock($user)
    {
        if(in_array($user->id ,[1,2])){
            return abort(404);
        }
    }

    private function myOwnRole($user)
    {
        if (Auth::user()->id == $user->id){
            return abort(404);
        }
    }
}
