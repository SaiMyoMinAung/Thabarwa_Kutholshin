<?php

namespace App;

use App\Center;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = [];

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id')->withDefault();
    }

}
