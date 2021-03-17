<?php

namespace App;

use App\Ward;
use App\Center;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Yogi extends Model
{
    use HasUUID, SoftDeletes;

    protected $guarded = [];

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id')->withTrashed()->withDefault();
    }

    public function center()
    {
        return $this->belongsToMany(Center::class, [Ward::class])->withTrashed()->withDefault();
    }
}
