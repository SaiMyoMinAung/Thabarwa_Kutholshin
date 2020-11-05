<?php

namespace App;

use App\Volunteer;
use App\Traits\HasUUID;
use Illuminate\Support\Str;
use App\State\DonatedItemState;
use App\Status\KindOfItemStatus;
use App\Status\DonatedItemStatus;
use Illuminate\Database\Eloquent\Model;

class DonatedItem extends Model
{
    use HasUUID;

    protected $guarded = [];

    protected $casts = [
        'pickedup_at' => 'date',
        'is_confirmed_by_donor' => 'boolean',
    ];

    public function getStateAttribute(): DonatedItemState
    {
        return new $this->state_class($this);
    }

    public function getShortAboutItemAttribute()
    {
        return Str::limit($this->about_item, 20, '...');
    }

    public function getStatusNameAttribute()
    {
        return DonatedItemStatus::search($this->status);
    }

    public function getKindOfItemNameAttribute()
    {
        return KindOfItemStatus::search($this->kind_of_item);
    }

    public function donor()
    {
        return $this->belongsTo(User::class, 'donated_user_id')->withDefault();
    }

    public function pickedupVolunteer()
    {
        return $this->belongsTo(Volunteer::class, 'pickedup_volunteer_id')->withDefault();
    }

    public function storeKeeperVolunteer()
    {
        return $this->belongsTo(Volunteer::class, 'store_keeper_volunteer_id')->withDefault();
    }

    public function repairedVolunteer()
    {
        return $this->belongsTo(Volunteer::class, 'repaired_volunteer_id')->withDefault();
    }

    public function deliveredVolunteer()
    {
        return $this->belongsTo(Volunteer::class, 'delivered_volunteer_id')->withDefault();
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id')->withDefault();
    }

    public function box()
    {
        return $this->belongsTo(Box::class, 'box_id')->withDefault();
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id')->withDefault();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withDefault();
    }

    public function stateRegion()
    {
        return $this->belongsTo(StateRegion::class, 'state_region_id')->withDefault();
    }
}
