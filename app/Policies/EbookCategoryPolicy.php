<?php

namespace App\Policies;

use App\EbookCategory;
use App\User;
use App\UserAccessRole;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EbookCategoryPolicy
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
        return in_array(21, $this->array()); // View Ebook Category
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array(22, $this->array()); // Add Ebook Category
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\EbookCategory  $ebookCategory
     * @return mixed
     */
    public function update(User $user, EbookCategory $ebookCategory)
    {
        return in_array(23, $this->array()); // Update Ebook Category
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
