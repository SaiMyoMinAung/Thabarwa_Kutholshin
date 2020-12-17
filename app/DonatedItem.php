<?php

namespace App;

use App\Volunteer;
use App\RequestedItem;
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

    public function setItemUniqueIdAttribute()
    {
        $count = static::count();

        $defaultPadLeft = 6;

        do {
            $numlength = strlen((string) $count);

            if ($numlength >= 6 && preg_match("/^[9]+$/i", $count)) {

                $defaultPadLeft = $numlength + 1;

                $count = 0;
            }

            $count++;

            $item_unique_id = str_pad($count, $defaultPadLeft, "0", STR_PAD_LEFT);
        } while (static::where('item_unique_id', $item_unique_id)->exists());

        $text = (string) $item_unique_id; // convert into a string

        $arr = str_split($text, "3"); // break string in 3 character sets

        $formatted_item_unique_id = implode("-", $arr);  // implode array with comma

        $this->attributes['item_unique_id'] = $formatted_item_unique_id;
    }

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

    public function requestedItems()
    {
        return $this->hasMany(RequestedItem::class, 'donated_item_id');
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

    public function offices()
    {
        return $this->belongsToMany(Office::class, 'donated_item_offices')->withTimestamps()
            ->orderBy('donated_item_offices.id', 'desc');
    }
}
