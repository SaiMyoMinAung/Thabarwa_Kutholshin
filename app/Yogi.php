<?php

namespace App;

use App\Ward;
use App\Center;
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

    public function center()
    {
        return $this->belongsToMany(Center::class, [Ward::class]);
    }
}
