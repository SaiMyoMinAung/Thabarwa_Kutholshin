<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class CancelledState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::CANCELLED();
    }

    public function canChangeConfirmedState(): bool
    {
        return $this->donatedItem->is_confirmed_by_donor == 0;
    }
}
