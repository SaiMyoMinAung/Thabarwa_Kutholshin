<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Box extends Model
{
    use HasUUID, SoftDeletes;

    protected $guarded = [];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id')->withTrashed()->withDefault();
    }
}
