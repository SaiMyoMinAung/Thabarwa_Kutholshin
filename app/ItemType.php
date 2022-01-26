<?php

namespace App;

use App\Unit;
use App\ItemSubType;
use App\InternalDonatedItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemType extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function itemSubTypes()
    {
        return $this->hasMany(ItemSubType::class, 'item_type_id');
    }

    public function internalDonatedItems()
    {
        return $this->hasManyThrough(InternalDonatedItem::class, ItemSubType::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
