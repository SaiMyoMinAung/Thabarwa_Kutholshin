<?php

namespace App;

use App\ShareInternalDonatedItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemSubType extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function itemType()
    {
        return $this->belongsTo(ItemType::class, 'item_type_id')->withDefault();
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id')->withDefault();
    }

    public function internalDonatedItems()
    {
        return $this->hasMany(InternalDonatedItem::class, 'item_sub_type_id');
    }

    public function sharedInternalDonatedItems()
    {
        return $this->hasMany(ShareInternalDonatedItem::class, 'item_sub_type_id');
    }

}
