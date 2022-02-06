<?php

namespace App\Policies;

use App\Volunteer;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class VolunteerPolicy
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
        return auth()->user()->can('read-volunteer');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Volunteer  $volunteer
     * @return mixed
     */
    public function view(Admin $admin, Volunteer $volunteer)
    {
        return auth()->user()->can('read-volunteer');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return auth()->user()->can('create-volunteer');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Volunteer  $volunteer
     * @return mixed
     */
    public function update(Admin $admin, Volunteer $volunteer)
    {
        return auth()->user()->can('update-volunteer');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Volunteer  $volunteer
     * @return mixed
     */
    public function delete(Admin $admin, Volunteer $volunteer)
    {
        return auth()->user()->can('delete-volunteer');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Volunteer  $volunteer
     * @return mixed
     */
    public function restore(Admin $admin, Volunteer $volunteer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Volunteer  $volunteer
     * @return mixed
     */
    public function forceDelete(Admin $admin, Volunteer $volunteer)
    {
        //
    }
}
