<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasUUID;

    protected $guarded = [];
}
