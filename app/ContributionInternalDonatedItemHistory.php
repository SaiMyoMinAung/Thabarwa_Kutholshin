<?php

namespace App;

use App\InternalDonatedItem;
use Illuminate\Database\Eloquent\Model;

class ContributionInternalDonatedItemHistory extends Model
{
    protected $guarded = [];

    public function internalDonatedItem()
    {
        return $this->belongsTo(InternalDonatedItem::class, 'internal_donated_item_id')->withDefault();
    }
}
