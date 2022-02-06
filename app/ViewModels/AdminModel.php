<?php

namespace App\ViewModels;

use App\Admin;
use App\Constants\SuperRoleConstant;
use App\Office;
use Spatie\Permission\Models\Role;
use Spatie\ViewModels\ViewModel;

class AdminModel extends ViewModel
{
    public $admin;
    public $edit;

    public function __construct(Admin $admin = null, $edit = false)
    {
        $this->admin = $admin;
        $this->edit = $edit;
    }

    public function offices()
    {
        return Office::withTrashed()->available()->get();
    }

    public function roles()
    {
        return Role::where('name', '!=', SuperRoleConstant::SuperRole)->get();
    }
}
