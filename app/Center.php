<?php

namespace App;

use App\City;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withDefault();
    }
}
