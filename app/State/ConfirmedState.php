<?php

namespace App\State;

use App\State\DonatedItemState;

class ConfirmedState extends DonatedItemState
{
    public function status(): string
    {
        return 'confirmed';
    }

    public function canChangeConfirmedState(): bool
    {
        return $this->donatedItem->is_confirmed == 0;
    }

    public function canChangeCancelledState(): bool
    {
        return $this->donatedItem->is_confirmed == 1;
    }
}
