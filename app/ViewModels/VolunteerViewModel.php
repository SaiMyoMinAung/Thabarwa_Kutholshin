<?php

namespace App\ViewModels;

use App\Office;
use App\Volunteer;
use App\VolunteerJob;
use Spatie\ViewModels\ViewModel;
use Illuminate\Database\Eloquent\Collection;

class VolunteerViewModel extends ViewModel
{
    public $indexUrl = null;
    public $edit = null;

    public function __construct(Volunteer $volunteer = null, $edit = false)
    {
        $this->volunteer = $volunteer;

        $this->indexUrl = route('volunteers.index');

        $this->edit = $edit;
    }

    public function volunteer(): Volunteer
    {
        return $this->volunteer ?? new Volunteer();
    }

    public function offices(): Collection
    {
        return Office::withTrashed()->get();
    }

    public function jobs(): Collection
    {
        return VolunteerJob::withTrashed()->get();
    }

    public function selectedJobs()
    {
        if ($this->volunteer) {
            return $this->volunteer->volunteerJobs->map(function ($job) {
                return $job->only(['id']);
            })->flatten()->toArray();
        } else {
            return [];
        }
    }
}
