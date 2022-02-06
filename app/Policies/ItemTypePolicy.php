<?php

namespace App\Policies;

use App\ItemType;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemTypePolicy
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
        return auth()->user()->can('read-item-type');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ItemType  $itemType
     * @return mixed
     */
    public function view(Admin $admin, ItemType $itemType)
    {
        return auth()->user()->can('read-item-type');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return auth()->user()->can('create-item-type');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ItemType  $itemType
     * @return mixed
     */
    public function update(Admin $admin, ItemType $itemType)
    {
        return auth()->user()->can('update-item-type');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ItemType  $itemType
     * @return mixed
     */
    public function delete(Admin $admin, ItemType $itemType)
    {
        return auth()->user()->can('delete-item-type');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ItemType  $itemType
     * @return mixed
     */
    public function restore(Admin $admin, ItemType $itemType)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ItemType  $itemType
     * @return mixed
     */
    public function forceDelete(Admin $admin, ItemType $itemType)
    {
        //
    }
}
