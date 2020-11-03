<?php

namespace App;

use App\Store;
use App\StateRegion;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasUUID;

    protected $guarded = [];

    public function stateRegion()
    {
        return $this->belongsTo(StateRegion::class, 'state_region_id');
    }

    public function stores()
    {
        return $this->hasMany(Store::class, 'office_id');
    }

    public function boxes()
    {
        return $this->hasManyThrough(Box::class, Store::class, 'office_id', 'store_id');
    }
}
