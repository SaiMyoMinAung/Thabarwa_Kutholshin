<?php

namespace App;

use App\City;
use App\Admin;
use App\Store;
use App\Volunteer;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasUUID;

    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function stores()
    {
        return $this->hasMany(Store::class, 'office_id');
    }

    public function boxes()
    {
        return $this->hasManyThrough(Box::class, Store::class, 'office_id', 'store_id');
    }

    public function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class, 'office_id');
    }

    public static function canDoOffices()
    {
        $auth_admin_city_id =  auth()->user()->city->id;

        return self::where('city_id', $auth_admin_city_id)->where('is_open', 1);
    }
}
