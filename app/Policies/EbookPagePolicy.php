<?php

namespace App\Policies;

use App\EbookPage;
use App\User;
use App\UserAccessRole;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EbookPagePolicy
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
        return in_array(17, $this->array()); // View Ebook Page
    }


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array(18, $this->array()); // Add Ebook Page
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param EbookPage $page
     * @return mixed
     */
    public function update(User $user, EbookPage $page)
    {
        return in_array(19, $this->array()); // Update Ebook Page
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\User $user
     * @param EbookPage $page
     * @return mixed
     */
    public function forceDelete(User $user, EbookPage $page)
    {
        return in_array(20, $this->array()); // Delete Ebook Page
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
