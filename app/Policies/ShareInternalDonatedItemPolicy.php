<?php

namespace App\Policies;

use App\ShareInternalDonatedItem;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShareInternalDonatedItemPolicy
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
        return auth()->user()->can('read-share-internal-donated-item');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ShareInternalDonatedItem  $shareInternalDonatedItem
     * @return mixed
     */
    public function view(Admin $admin, ShareInternalDonatedItem $shareInternalDonatedItem)
    {
        return auth()->user()->can('read-share-internal-donated-item');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return auth()->user()->can('create-share-internal-donated-item');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ShareInternalDonatedItem  $shareInternalDonatedItem
     * @return mixed
     */
    public function update(Admin $admin, ShareInternalDonatedItem $shareInternalDonatedItem)
    {
        return auth()->user()->can('update-share-internal-donated-item');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ShareInternalDonatedItem  $shareInternalDonatedItem
     * @return mixed
     */
    public function delete(Admin $admin, ShareInternalDonatedItem $shareInternalDonatedItem)
    {
        return auth()->user()->can('delete-share-internal-donated-item');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ShareInternalDonatedItem  $shareInternalDonatedItem
     * @return mixed
     */
    public function restore(Admin $admin, ShareInternalDonatedItem $shareInternalDonatedItem)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ShareInternalDonatedItem  $shareInternalDonatedItem
     * @return mixed
     */
    public function forceDelete(Admin $admin, ShareInternalDonatedItem $shareInternalDonatedItem)
    {
        //
    }
}
