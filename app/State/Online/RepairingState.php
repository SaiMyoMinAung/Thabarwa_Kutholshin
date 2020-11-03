<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class RepairingState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::REPAIRING();
    }

    public function canChangeDoneRepairingState(): bool
    {
        return $this->donatedItem->is_repairing &&
            $this->donatedItem->repaired_volunteer_id != null;
    }
}
