<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Validator::extend('spaceNotAllow', function ($attribute, $value) {
            if(preg_match('/^\S*$/u', $value)){
                return true;
            }
            return false;
        });
        Validator::replacer('spaceNotAllow', function ($message, $attribute, $rule, $parameters) {
            return 'This field is not allowed to use whitespaces';
        });
    }
}
