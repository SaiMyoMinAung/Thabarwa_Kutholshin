<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasUUID;
    
    protected $guarded = [];

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
}
