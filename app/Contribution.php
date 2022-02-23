<?php

namespace App;

use App\Office;
use Illuminate\Database\Eloquent\Model;
class Contribution extends Model
{
    protected $guarded = [];

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id')->withDefault();
    }

    public function receiveOffice()
    {
        return $this->belongsTo(Office::class, 'receive_office_id')->withDefault();
    }
}
