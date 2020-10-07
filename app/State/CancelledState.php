<?php

namespace App\State;

use App\State\DonatedItemState;

class CancelledState extends DonatedItemState
{
    public function status(): string
    {
        return 'cancelled';
    }

    public function canChangeConfirmedState(): bool
    {
        return $this->donatedItem->is_confirmed == 0;
    }
}
