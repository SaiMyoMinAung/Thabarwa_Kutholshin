<?php

namespace App;

use App\Office;
use App\StateRegion;
use App\VolunteerJob;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasUUID;

    protected $guarded = [];

    public function volunteerJobs()
    {
        return $this->belongsToMany(VolunteerJob::class, 'volunteer_has_volunteer_jobs', 'volunteer_id', 'volunteer_job_id');
    }

    public function state_region()
    {
        return $this->belongsTo(StateRegion::class, 'state_region_id')->withDefault();
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id')->withDefault();
    }
}
