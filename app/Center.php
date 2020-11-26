<?php

namespace App;

use App\City;
use App\Team;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withDefault();
    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'center_id');
    }
}
