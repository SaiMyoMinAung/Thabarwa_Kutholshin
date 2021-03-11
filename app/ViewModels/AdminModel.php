<?php

namespace App\ViewModels;

use App\Admin;
use App\Office;
use App\TypeOfAdmin;
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

    public function typeOfAdmins()
    {
        return TypeOfAdmin::orderBy('id', 'desc')->get();
    }

    public function offices()
    {
        return Office::available()->get();
    }
}
