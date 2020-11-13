<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class AssignRepairerState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::ASSIGNED_REPAIRER();
    }

    public function canChangeReAssignedRepairerState(): bool
    {
        return $this->donatedItem->repaired_volunteer_id != null
            && $this->donatedItem->is_required_repairing;
    }

    public function canChangeRepairingState(): bool
    {
        return $this->donatedItem->store_keeper_volunteer_id != null
            && $this->donatedItem->is_done_storing == 0
            && $this->donatedItem->repaired_volunteer_id != null
            && $this->donatedItem->is_required_repairing;
    }
}
