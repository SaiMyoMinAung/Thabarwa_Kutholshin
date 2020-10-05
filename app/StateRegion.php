<?php

namespace App;

use App\Country;
use Illuminate\Database\Eloquent\Model;

class StateRegion extends Model
{
    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
