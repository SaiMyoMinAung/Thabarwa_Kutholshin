<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasUUID;
    
    protected $guarded = [];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
