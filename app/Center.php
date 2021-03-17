<?php

namespace App;

use App\City;
use App\Team;
use App\Ward;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Center extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withTrashed()->withDefault();
    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'center_id');
    }

    public function wards()
    {
        return $this->hasMany(Ward::class, 'center_id');
    }

    public static function canDoCenters()
    {
        $auth_admin_city_id =  auth()->user()->city->id;

        return self::where('city_id', $auth_admin_city_id)->where('is_available', 1);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1)->orderBy('id', 'desc');
    }
}
