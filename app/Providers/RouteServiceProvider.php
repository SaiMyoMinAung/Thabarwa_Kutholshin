<?php

namespace App\Providers;

use App\Box;
use App\City;
use App\Team;
use App\Unit;
use App\Ward;
use App\Yogi;
use App\Admin;
use App\Store;
use App\Center;
use App\Office;
use App\Country;
use App\ItemType;
use App\AlmsRound;
use App\Volunteer;
use App\ItemSubType;
use App\StateRegion;
use App\VolunteerJob;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/backend/dashboard';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();

        $this->app['router']->bind('item_type', function ($value) {
            return ItemType::withTrashed()->where('id', $value)->first();
        });

        $this->app['router']->bind('item_sub_type', function ($value) {
            return ItemSubType::withTrashed()->where('id', $value)->first();
        });

        $this->app['router']->bind('alms_round', function ($value) {
            return AlmsRound::withTrashed()->where('id', $value)->first();
        });

        $this->app['router']->bind('volunteer_job', function ($value) {
            return VolunteerJob::withTrashed()->where('id', $value)->first();
        });

        $this->app['router']->bind('ward', function ($value) {
            return Ward::withTrashed()->where('id', $value)->first();
        });

        $this->app['router']->bind('center', function ($value) {
            return Center::withTrashed()->where('id', $value)->first();
        });

        $this->app['router']->bind('city', function ($value) {
            return City::withTrashed()->where('id', $value)->first();
        });

        $this->app['router']->bind('state_region', function ($value) {
            return StateRegion::withTrashed()->where('id', $value)->first();
        });

        $this->app['router']->bind('country', function ($value) {
            return Country::withTrashed()->where('id', $value)->first();
        });

        $this->app['router']->bind('box', function ($value) {
            return Box::withTrashed()->where('uuid', $value)->first();
        });

        $this->app['router']->bind('store', function ($value) {
            return Store::withTrashed()->where('uuid', $value)->first();
        });

        $this->app['router']->bind('box', function ($value) {
            return Box::withTrashed()->where('uuid', $value)->first();
        });

        $this->app['router']->bind('unit', function ($value) {
            return Unit::withTrashed()->where('id', $value)->first();
        });

        $this->app['router']->bind('office', function ($value) {
            return Office::withTrashed()->where('uuid', $value)->first();
        });

        $this->app['router']->bind('admin', function ($value) {
            return Admin::withTrashed()->where('uuid', $value)->first();
        });

        $this->app['router']->bind('volunteer', function ($value) {
            return Volunteer::withTrashed()->where('uuid', $value)->first();
        });

        $this->app['router']->bind('team', function ($value) {
            return Team::withTrashed()->where('uuid', $value)->first();
        });

        $this->app['router']->bind('yogi', function ($value) {
            return Yogi::withTrashed()->where('uuid', $value)->first();
        });

        $this->app['router']->bind('user', function ($value) {
            return User::withTrashed()->where('uuid', $value)->first();
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapInternalDonatedItemRoutes();
        //
    }

    /**
     * Define the "internal donated item" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    public function mapInternalDonatedItemRoutes()
    {
        Route::group(
            [
                'middleware' => ['web', 'auth:admin', 'check.first.time.login'],
                'prefix' => 'backend',
                'namespace' => $this->namespace . '\Backend'
            ],
            base_path('routes/backend.php')
        );
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
