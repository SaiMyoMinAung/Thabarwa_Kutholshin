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

    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1)->orderBy('id', 'desc');
    }
}
