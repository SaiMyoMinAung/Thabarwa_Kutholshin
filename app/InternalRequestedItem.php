<?php

namespace App;

use App\Admin;
use App\Traits\HasUUID;
use App\InternalDonatedItem;
use Illuminate\Database\Eloquent\Model;

class InternalRequestedItem extends Model
{
    use HasUUID;

    protected $guarded = [];

    /**
     * Get the parent commentable model (post or video).
     */
    public function requestable()
    {
        return $this->morphTo();
    }

    public function internalDonatedItem()
    {
        return $this->belongsTo(InternalDonatedItem::class, 'internal_donated_item_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
