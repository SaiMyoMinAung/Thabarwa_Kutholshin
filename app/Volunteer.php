<?php

namespace App;

use App\Office;
use App\VolunteerJob;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Znck\Eloquent\Traits\BelongsToThrough;

class Volunteer extends Model
{
    use HasUUID, BelongsToThrough, SoftDeletes;

    protected $guarded = [];

    public function volunteerJobs()
    {
        return $this->belongsToMany(VolunteerJob::class, 'volunteer_has_volunteer_jobs', 'volunteer_id', 'volunteer_job_id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id')->withTrashed()->withDefault();
    }

    public function center()
    {
        return $this->belongsToThrough(Center::class, [Office::class])->withTrashed()->withDefault();
    }
}
