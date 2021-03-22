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
            return $user->typeOfAdmins->where('name', DONATION_RECORD_ADMIN)->count() > 0
                || $user->is_super;
        });

        Gate::define('can-do-donated-item-record', function ($user) {
            return $user->typeOfAdmins->where('name', DONATED_ITEM_RECORD_ADMIN)->count() > 0
                || $user->is_super;
        });

        Gate::define('can-do-internal-donated-item-record', function ($user) {
            return $user->typeOfAdmins->where('name', INTERNAL_DONATED_ITEM_RECORD_ADMIN)->count() > 0
                || $user->is_super;
        });

        Gate::define('can-do-setting', function ($user) {
            return $user->typeOfAdmins->where('name', SETTING)->count() > 0
                || $user->is_super;
        });

        Gate::define('super-admin', function ($user) {
            return $user->is_super;
        });
    }
}
