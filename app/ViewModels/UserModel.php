<?php

namespace App\ViewModels;

use App\City;
use App\User;
use Spatie\ViewModels\ViewModel;

class UserModel extends ViewModel
{
    public $user;
    public $edit;

    public function __construct(User $user = null, $edit = false)
    {
        $this->user = $user;
        $this->edit = $edit;
    }

    public function cities()
    {
        return City::withTrashed()->available()->get();
    }
}
