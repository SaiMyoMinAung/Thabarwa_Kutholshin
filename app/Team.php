<?php

namespace App;

use App\Center;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

class Team extends Model
{
    use HasUUID, BelongsToThrough;
    
    protected $guarded = [];

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id')->withDefault();
    }

    public function city()
    {
        return $this->belongsToThrough(City::class, [Center::class]);
    }

}
