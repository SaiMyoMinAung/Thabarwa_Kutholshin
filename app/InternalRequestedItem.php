<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class InternalRequestedItem extends Model
{
    use HasUUID;

    protected $guarded = [];

    /**
     * Get the parent commentable model (post or video).
     */
    public function requestable()
    {
        return $this->morphTo();
    }
}
