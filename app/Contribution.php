<?php

namespace App;

use App\Office;
use App\Volunteer;
use App\InternalDonatedItem;
use Illuminate\Database\Eloquent\Model;
use App\ContributionInternalDonatedItemHistory;

class Contribution extends Model
{
    protected $guarded = [];

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id')->withDefault();
    }

    public function receiveOffice()
    {
        return $this->belongsTo(Office::class, 'receive_office_id')->withDefault();
    }

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id')->withDefault();
    }
}
