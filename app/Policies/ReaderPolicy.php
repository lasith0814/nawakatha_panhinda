<?php

namespace App\Policies;

use App\Reader;
use App\User;
use App\UserAccessRole;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ReaderPolicy
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
        return in_array(8, $this->array()); // View user
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array(9, $this->array()); // Create user
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reader  $model
     * @return mixed
     */
    public function update(User $user, Reader $model)
    {
        return in_array(10, $this->array()); // Update user
    }
    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reader  $model
     * @return mixed
     */
    public function delete(User $user, Reader $model)
    {
        return in_array(11, $this->array()); // On/Off user
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
