<?php

namespace App\Policies;

use App\Team;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
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
        return auth()->user()->can('read-team');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Team  $team
     * @return mixed
     */
    public function view(Admin $admin, Team $team)
    {
        return auth()->user()->can('read-team');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return auth()->user()->can('create-team');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Team  $team
     * @return mixed
     */
    public function update(Admin $admin, Team $team)
    {
        return auth()->user()->can('update-team');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Team  $team
     * @return mixed
     */
    public function delete(Admin $admin, Team $team)
    {
        return auth()->user()->can('delete-team');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Team  $team
     * @return mixed
     */
    public function restore(Admin $admin, Team $team)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Team  $team
     * @return mixed
     */
    public function forceDelete(Admin $admin, Team $team)
    {
        //
    }
}
