<?php

namespace App;

use App\State\DonatedItemState;
use Illuminate\Database\Eloquent\Model;

class DonatedItem extends Model
{
    protected $guarded = [];

    public function getStateAttribute(): DonatedItemState
    {
        return new $this->state_class($this);
    }

    public function mustBePaid(): bool
    {
        return $this->state->mustBePaid();
    }
}
