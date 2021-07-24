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

    public function internalDonatedItems()
    {
        return $this->hasMany(InternalDonatedItem::class, 'item_sub_type_id');
    }

    public function sharedInternalDonatedItems()
    {
        return $this->hasMany(ShareInternalDonatedItem::class, 'item_sub_type_id');
    }

    public function getLeftSocketsAttribute()
    {
        return $this->internalDonatedItems()
            ->where('office_id', auth()->user()->office->id)
            ->get()
            ->sum(function ($item) {
                return ($item->package_qty * $item->socket_per_package) + $item->socket_qty;
            });
    }
}
