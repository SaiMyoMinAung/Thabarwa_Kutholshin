<?php

namespace App;

use App\KindOfDonation;
use App\Status\TypeOfMoney;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationRecord extends Model
{
    use HasUUID, SoftDeletes;

    protected $guarded = [];

    public function kindOfDonation()
    {
        return $this->belongsTo(KindOfDonation::class, 'kind_of_donation_id')->withDefault();
    }

    public function getFormatedCashAttribute()
    {
        return number_format($this->donation_cash);
    }

    public function getLabelAttribute()
    {
        return TypeOfMoney::advanceSerach($this->type_of_money);
    }
}
