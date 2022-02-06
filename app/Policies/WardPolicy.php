<?php

namespace App\Policies;

use App\Ward;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class WardPolicy
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
        return auth()->user()->can('read-ward');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Ward  $ward
     * @return mixed
     */
    public function view(Admin $admin, Ward $ward)
    {
        return auth()->user()->can('read-ward');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return auth()->user()->can('create-ward');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Ward  $ward
     * @return mixed
     */
    public function update(Admin $admin, Ward $ward)
    {
        return auth()->user()->can('update-ward');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Ward  $ward
     * @return mixed
     */
    public function delete(Admin $admin, Ward $ward)
    {
        return auth()->user()->can('delete-ward');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Ward  $ward
     * @return mixed
     */
    public function restore(Admin $admin, Ward $ward)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Ward  $ward
     * @return mixed
     */
    public function forceDelete(Admin $admin, Ward $ward)
    {
        //
    }
}
