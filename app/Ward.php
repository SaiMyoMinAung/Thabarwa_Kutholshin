<?php

namespace App;

use App\Center;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ward extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id')->withTrashed()->withDefault();
    }
}
