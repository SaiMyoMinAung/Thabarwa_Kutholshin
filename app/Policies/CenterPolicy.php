<?php

namespace App\Policies;

use App\Center;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class CenterPolicy
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
        return auth()->user()->can('read-center');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Center  $center
     * @return mixed
     */
    public function view(Admin $admin, Center $center)
    {
        return auth()->user()->can('read-center');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return auth()->user()->can('create-center');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Center  $center
     * @return mixed
     */
    public function update(Admin $admin, Center $center)
    {
        return auth()->user()->can('update-center');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Center  $center
     * @return mixed
     */
    public function delete(Admin $admin, Center $center)
    {
        return auth()->user()->can('delete-center');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Center  $center
     * @return mixed
     */
    public function restore(Admin $admin, Center $center)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Center  $center
     * @return mixed
     */
    public function forceDelete(Admin $admin, Center $center)
    {
        //
    }
}
