<?php

namespace App;

use App\Traits\HasUUID;
use App\State\DonatedItemState;
use Illuminate\Database\Eloquent\Model;

class DonatedItem extends Model
{
    use HasUUID;

    protected $guarded = [];

    protected $casts = [
        'pickedup_at' => 'date',
        'is_confirm_by_donor' => 'boolean',
    ];

    public function getStateAttribute(): DonatedItemState
    {
        return new $this->state_class($this);
    }

    public function canManage()
    {
        return $this->state->canManage();
    }

    public function canAssignDriver()
    {
        return $this->state->canAssignDriver();
    }

    public function canArriveAtOffice()
    {
        return $this->state->canArriveAtOffice();
    }

    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id')->withDefault();
    }
}
