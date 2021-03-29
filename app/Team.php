<?php

namespace App;

use App\Center;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Znck\Eloquent\Traits\BelongsToThrough;

class Team extends Model
{
    use HasUUID, BelongsToThrough, SoftDeletes;

    protected $guarded = [];

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id')->withTrashed()->withDefault();
    }

    // It only work for whereHas query
    public function city()
    {
        return $this->belongsToThrough(City::class, [Center::class]);
    }
}
