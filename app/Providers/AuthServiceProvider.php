<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\User' => 'App\Policies\UserPolicy',
         'App\Reader' => 'App\Policies\ReaderPolicy',
         'App\UserAccessRole' => 'App\Policies\UserAccessRolePolicy',
         'App\Author' => 'App\Policies\AuthorPolicy',
         'App\EbookCategory' => 'App\Policies\EbookCategoryPolicy',
         'App\Ebook' => 'App\Policies\EbookPolicy',
         'App\EbookPage' => 'App\Policies\EbookPagePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
