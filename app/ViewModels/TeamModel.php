<?php

namespace App\ViewModels;

use App\Team;
use App\Center;
use Spatie\ViewModels\ViewModel;

class TeamModel extends ViewModel
{
    public $edit;
    public $team;

    public function __construct(Team $team = null, $edit = false)
    {
        $this->team = $team;
        $this->edit = $edit;
    }

    public function centers()
    {
        return Center::available()->get();
    }
}
