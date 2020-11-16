<?php

namespace App\Policies;

use App\User;
use App\UserAccessRole;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserAccessRolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return in_array(5, $this->array()); // View Access Role
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array(6, $this->array()); // Add Access Role
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\UserAccessRole  $userAccessRole
     * @return mixed
     */
    public function update(User $user, UserAccessRole $userAccessRole)
    {
        return in_array(7, $this->array()); // Update Access Role
    }

    private function array()
    {
        $array[] = 1000;
        $user = Auth::user();
        $user_roles = UserAccessRole::find($user->user_access_role_id);
        foreach($user_roles->userActions as $value){
            $array[] = $value->id;
        }
        return $array;
    }
}
