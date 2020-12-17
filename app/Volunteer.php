<?php

namespace App;

use App\Office;
use App\VolunteerJob;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

class Volunteer extends Model
{
    use HasUUID, BelongsToThrough;

    protected $guarded = [];

    public function volunteerJobs()
    {
        return $this->belongsToMany(VolunteerJob::class, 'volunteer_has_volunteer_jobs', 'volunteer_id', 'volunteer_job_id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id')->withDefault();
    }

    public function center()
    {
        return $this->belongsToThrough(Center::class, [Office::class]);
    }
}
