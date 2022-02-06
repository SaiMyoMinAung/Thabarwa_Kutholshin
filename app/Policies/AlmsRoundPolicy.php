<?php

namespace App\Policies;

use App\AlmsRound;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlmsRoundPolicy
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
        return auth()->user()->can('read-alms-round');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\AlmsRound  $almsRound
     * @return mixed
     */
    public function view(Admin $admin, AlmsRound $almsRound)
    {
        return auth()->user()->can('read-alms-round');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return auth()->user()->can('create-alms-round');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\AlmsRound  $almsRound
     * @return mixed
     */
    public function update(Admin $admin, AlmsRound $almsRound)
    {
        return auth()->user()->can('update-alms-round');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\AlmsRound  $almsRound
     * @return mixed
     */
    public function delete(Admin $admin, AlmsRound $almsRound)
    {
        return auth()->user()->can('delete-alms-round');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\AlmsRound  $almsRound
     * @return mixed
     */
    public function restore(Admin $admin, AlmsRound $almsRound)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\AlmsRound  $almsRound
     * @return mixed
     */
    public function forceDelete(Admin $admin, AlmsRound $almsRound)
    {
        //
    }
}
