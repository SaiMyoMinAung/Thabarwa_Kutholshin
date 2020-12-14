<?php

namespace App;

use App\Ward;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Yogi extends Model
{
    use HasUUID;

    protected $guarded = [];

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id')->withDefault();
    }
}
