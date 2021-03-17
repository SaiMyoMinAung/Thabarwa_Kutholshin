<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function stateRegion()
    {
        return $this->belongsTo(StateRegion::class, 'state_region_id')->withTrashed()->withDefault();
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1)->orderBy('id', 'desc');
    }
}
