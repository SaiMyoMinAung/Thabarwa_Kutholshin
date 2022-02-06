<?php

namespace App\Policies;

use App\Yogi;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class YogiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return auth()->user()->can('read-yogi');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Yogi  $yogi
     * @return mixed
     */
    public function view(Admin $admin, Yogi $yogi)
    {
        return auth()->user()->can('read-yogi');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return auth()->user()->can('create-yogi');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Yogi  $yogi
     * @return mixed
     */
    public function update(Admin $admin, Yogi $yogi)
    {
        return auth()->user()->can('update-yogi');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Yogi  $yogi
     * @return mixed
     */
    public function delete(Admin $admin, Yogi $yogi)
    {
        return auth()->user()->can('delete-yogi');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Yogi  $yogi
     * @return mixed
     */
    public function restore(Admin $admin, Yogi $yogi)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Yogi  $yogi
     * @return mixed
     */
    public function forceDelete(Admin $admin, Yogi $yogi)
    {
        //
    }
}
