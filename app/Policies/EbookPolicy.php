<?php

namespace App\Policies;

use App\Ebook;
use App\User;
use App\UserAccessRole;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EbookPolicy
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
        return in_array(12, $this->array()); // View Ebook
    }


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array(13, $this->array()); // Add Ebook
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param Ebook $book
     * @return mixed
     */
    public function update(User $user, Ebook $book)
    {
        return in_array(14, $this->array()); // Update Ebook
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\User $user
     * @param Ebook $book
     * @return mixed
     */
    public function delete(User $user, Ebook $book)
    {
        return in_array(15, $this->array()); // On/Off Ebook
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\User $user
     * @param Ebook $book
     * @return mixed
     */
    public function forceDelete(User $user, Ebook $book)
    {
        return in_array(16, $this->array()); // Delete Ebook
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
