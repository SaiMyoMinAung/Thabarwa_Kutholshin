<?php

namespace App;

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
}
