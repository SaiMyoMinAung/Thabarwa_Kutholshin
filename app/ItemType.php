<?php

namespace App;

use App\InternalDonatedItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemType extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function internalDonatedItems()
    {
        return $this->hasMany(InternalDonatedItem::class, 'item_type_id');
    }
}
