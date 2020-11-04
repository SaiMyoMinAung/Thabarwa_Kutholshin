<?php

namespace App;

use App\Center;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $guarded = [];

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id')->withDefault();
    }
}
