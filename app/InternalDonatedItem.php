<?php

namespace App;

use App\Traits\HasUUID;
use App\Traits\HasItemUniqueId;
use Illuminate\Database\Eloquent\Model;
use App\Status\InternalDonatedItemStatus;

class InternalDonatedItem extends Model
{
    use HasUUID, HasItemUniqueId;

    // To Work FindMany Added PrimaryKey
    // protected $primaryKey = 'uuid';
    // protected $keyType = 'string';

    protected $guarded = [];

    public function almsRound()
    {
        return $this->belongsTo(AlmsRound::class, 'alms_round_id')->withDefault();
    }

    public function itemSubType()
    {
        return $this->belongsTo(ItemSubType::class, 'item_sub_type_id')->withDefault();
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', InternalDonatedItemStatus::advanceSearch('Available')["code"]);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('is_confirmed', 1);
    }

    public function scopeFilterByOffice($query)
    {
        return $query->where('office_id', auth()->user()->office->id);
    }
}
