<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class DoneRepairingState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::DONE_REPAIRING();
    }

    public function canChangeToCompleteState(): bool
    {
        return $this->donatedItem->is_done_pickingup
            && $this->donatedItem->is_done_storing
            && $this->donatedItem->is_done_repairing;
    }
}
