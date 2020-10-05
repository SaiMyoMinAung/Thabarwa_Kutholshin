<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public function stateRegion()
    {
        return $this->belongsTo(StateRegion::class, 'state_region_id');
    }
}
