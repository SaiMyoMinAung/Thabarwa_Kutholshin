<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KindOfDonation extends Model
{
    protected $guarded = [];

    public function donationRecords()
    {
        return $this->hasMany(DonationRecord::class, 'kind_of_donation_id');
    }
}
