<?php

namespace App\Http\ViewComposers;

use App\Admin;
use Illuminate\Contracts\View\View;

class AdminComposer
{
    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (isset(auth()->user()->id)) {
            $admin = Admin::with('office', 'center')->find(auth()->user()->id);
            $view->with('admin', $admin);
        }
    }
}
