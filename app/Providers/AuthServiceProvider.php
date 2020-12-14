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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('can-do-donation-record', function ($user) {
            return $user->typeOfAdmin->name == DONATION_RECORD_ADMIN;
        });

        Gate::define('can-do-donated-item-record', function ($user) {
            return $user->typeOfAdmin->name == DONATED_ITEM_RECORD_ADMIN;
        });

        Gate::define('can-do-setting', function ($user) {
            return $user->typeOfAdmin->name == SETTING;
        });
    }
}
