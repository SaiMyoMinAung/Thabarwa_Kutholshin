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

    public function internalDonatedItems()
    {
        return $this->belongsToMany(InternalDonatedItem::class, 'contribution_internal_donated_item_histories')->withPivot('is_accepted', 'is_confirmed');
    }

    public function histories()
    {
        return $this->hasMany(ContributionInternalDonatedItemHistory::class, 'contribution_id');
    }

    public function atLeastOneItemConfirmed($contribution)
    {
        $history = $contribution->histories()->where('is_confirmed', 1)->count();

        return $history > 0;
    }
}
