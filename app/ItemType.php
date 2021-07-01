<?php

namespace App;

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
        return $this->hasMany(InternalDonatedItem::class, 'item_type_id');
    }
}
