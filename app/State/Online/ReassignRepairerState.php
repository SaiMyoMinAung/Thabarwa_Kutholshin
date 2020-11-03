<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class ReassignRepairerState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::REASSIGNED_REPAIRER();
    }

    public function canChangeRepairingState(): bool
    {
        return $this->donatedItem->repaired_volunteer_id != null &&
            $this->donatedItem->is_required_repairing;
    }

    public function canChangeReAssignedRepairerState(): bool
    {
        return $this->donatedItem->repaired_volunteer_id != null &&
            $this->donatedItem->is_required_repairing;
    }
}
