<?php

namespace App\Policies;

use App\ItemSubType;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemSubTypePolicy
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
        return auth()->user()->can('read-item-sub-type');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ItemSubType  $itemSubType
     * @return mixed
     */
    public function view(Admin $admin, ItemSubType $itemSubType)
    {
        return auth()->user()->can('read-item-sub-type');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return auth()->user()->can('create-item-sub-type');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ItemSubType  $itemSubType
     * @return mixed
     */
    public function update(Admin $admin, ItemSubType $itemSubType)
    {
        return auth()->user()->can('update-item-sub-type');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ItemSubType  $itemSubType
     * @return mixed
     */
    public function delete(Admin $admin, ItemSubType $itemSubType)
    {
        return auth()->user()->can('delete-item-sub-type');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ItemSubType  $itemSubType
     * @return mixed
     */
    public function restore(Admin $admin, ItemSubType $itemSubType)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\ItemSubType  $itemSubType
     * @return mixed
     */
    public function forceDelete(Admin $admin, ItemSubType $itemSubType)
    {
        //
    }
}
