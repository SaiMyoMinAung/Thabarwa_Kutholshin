<?php

namespace App;

use App\ItemType;
use App\Traits\HasUUID;
use App\InternalRequestedItem;
use App\Traits\HasItemUniqueId;
use Illuminate\Database\Eloquent\Model;
use App\Status\InternalDonatedItemStatus;
use Illuminate\Database\Eloquent\Builder;

class InternalDonatedItem extends Model
{
    use HasUUID, HasItemUniqueId;

    // To Work FindMany Added PrimaryKey
    // protected $primaryKey = 'uuid';
    // protected $keyType = 'string';

    protected $guarded = [];

    public function itemType()
    {
        return $this->belongsTo(ItemType::class, 'item_type_id')->withDefault();
    }

    public function internalRequestedItems()
    {
        return $this->hasMany(InternalRequestedItem::class, 'internal_donated_item_id');
    }

    public function getLatestHistory()
    {
        return $this->hasOne(ContributionInternalDonatedItemHistory::class, 'internal_donated_item_id')->orderBy('id', 'desc');
    }

    public function histories()
    {
        return $this->hasMany(ContributionInternalDonatedItemHistory::class, 'internal_donated_item_id');
    }

    public function contributions()
    {
        return $this->belongsToMany(Contribution::class, 'contribution_internal_donated_item_histories')->withPivot('is_accepted', 'is_confirmed');
    }

    public function getLeftSocketsAttribute()
    {
        $orginalTotal = ($this->package_qty * $this->socket_per_package) + $this->socket_qty;
        $requestedSocket = 0;
        if ($this->internalRequestedItems->count() > 0) {
            foreach ($this->internalRequestedItems as $request) {
                $requestedSocket += ($request->package_qty * $this->socket_per_package) + $request->socket_qty;
            }
        }

        return $orginalTotal - $requestedSocket;
    }

    public function changeCompleteStatus()
    {
        $totalSockets = ($this->package_qty * $this->socket_per_package) + $this->socket_qty;

        $requestedSockets = $this->internalRequestedItems()->get()->sum(function ($item) {
            return ($item->package_qty * $this->socket_per_package) + $item->socket_qty;
        });

        if ($totalSockets == $requestedSockets) {
            $this->update(['status' => InternalDonatedItemStatus::advanceSearch('Complete')["code"]]);
        }
    }

    public function scopeAvailable($query)
    {
        return $query->with('getLatestHistory')
            ->where('status', InternalDonatedItemStatus::advanceSearch('Available')["code"]);
    }

    public function scopeFilterByHistory($query)
    {
        return $query->doesntHave('histories')->orWhereHas('histories', function ($q) {

            $q->where('id', function ($q) {

                $q->from('contribution_internal_donated_item_histories as sub')
                    ->selectRaw('max(id)')
                    ->whereRaw('contribution_internal_donated_item_histories.internal_donated_item_id = sub.internal_donated_item_id');
            })->where('is_confirmed', 1)->where('is_accepted', 1);
        });
    }

    public function scopeFilterByOffice($query)
    {
        return $query->where('office_id', auth()->user()->office->id);
    }
}