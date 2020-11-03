<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class ConfirmedState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::CONFIRMED();
    }

    public function canChangeConfirmedState(): bool
    {
        return $this->donatedItem->is_confirmed_by_donor == 0;
    }

    public function canChangeCancelledState(): bool
    {
        return $this->donatedItem->is_confirmed_by_donor == 1;
    }

    public function canChangeAssignedDriverState(): bool
    {
        return $this->donatedItem->is_confirmed_by_donor == 1
            && $this->donatedItem->is_pickingup == 0
            && $this->donatedItem->is_done_pickingup == 0;
    }
}
