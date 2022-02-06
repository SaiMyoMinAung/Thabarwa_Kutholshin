<?php

namespace App\Policies;

use App\Role;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
        return auth()->user()->can('read-role');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Role  $role
     * @return mixed
     */
    public function view(Admin $admin, Role $role)
    {
        return auth()->user()->can('read-role');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return auth()->user()->can('create-role');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Role  $role
     * @return mixed
     */
    public function update(Admin $admin, Role $role)
    {
        return auth()->user()->can('update-role');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Role  $role
     * @return mixed
     */
    public function delete(Admin $admin, Role $role)
    {
        return auth()->user()->can('delete-role');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Role  $role
     * @return mixed
     */
    public function restore(Admin $admin, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Role  $role
     * @return mixed
     */
    public function forceDelete(Admin $admin, Role $role)
    {
        //
    }
}
