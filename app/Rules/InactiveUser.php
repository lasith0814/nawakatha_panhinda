<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class InactiveUser implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::where($attribute, $value)->withTrashed()->first();
        if ($user == null){
            return false;
        }
        else{
            if($user->trashed()){
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You were deactivated by Administration';
    }
}
