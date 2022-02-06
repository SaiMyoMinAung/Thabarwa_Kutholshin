<?php

namespace App\Policies;

use App\InternalDonatedItem;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class InternalDonatedItemPolicy
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
        //
        return auth()->user()->can('read-internal-donated-items');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\InternalDonatedItem  $internalDonatedItem
     * @return mixed
     */
    public function view(Admin $admin, InternalDonatedItem $internalDonatedItem)
    {
        return auth()->user()->can('read-internal-donated-items');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return auth()->user()->can('create-internal-donated-items');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\InternalDonatedItem  $internalDonatedItem
     * @return mixed
     */
    public function update(Admin $admin, InternalDonatedItem $internalDonatedItem)
    {
        return auth()->user()->can('update-internal-donated-items');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\InternalDonatedItem  $internalDonatedItem
     * @return mixed
     */
    public function delete(Admin $admin, InternalDonatedItem $internalDonatedItem)
    {
        return auth()->user()->can('delete-internal-donated-items');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\InternalDonatedItem  $internalDonatedItem
     * @return mixed
     */
    public function restore(Admin $admin, InternalDonatedItem $internalDonatedItem)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\InternalDonatedItem  $internalDonatedItem
     * @return mixed
     */
    public function forceDelete(Admin $admin, InternalDonatedItem $internalDonatedItem)
    {
        //
    }
}
