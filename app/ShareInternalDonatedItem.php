<?php

namespace App;

use App\Admin;
use App\ItemType;
use App\ItemSubType;
use App\Services\MainCalculation;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class ShareInternalDonatedItem extends Model
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

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function itemType()
    {
        return $this->belongsTo(ItemType::class, 'item_type_id')->withDefault();
    }

    public function itemSubType()
    {
        return $this->belongsTo(ItemSubType::class, 'item_sub_type_id')->withDefault();
    }

    public function scopeFilterByOffice($query)
    {
        return $query->where('office_id', auth()->user()->office->id);
    }

    public function getAmountTextAttribute()
    {
        $mainCalculation = new MainCalculation;

        $calculated = $mainCalculation->seperatePackageSackets($this->item_sub_type_id, $this->sacket_qty);

        return $calculated['text'];
    }
}
