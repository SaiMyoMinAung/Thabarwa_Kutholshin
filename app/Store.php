<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasUUID, SoftDeletes;

    protected $guarded = [];

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id')->withTrashed()->withDefault();
    }

    public function boxes()
    {
        return $this->hasMany(Box::class, 'store_id');
    }
}
