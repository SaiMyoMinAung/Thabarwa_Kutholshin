<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class NotRequiredRepairState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::NOT_REQUIRED_REPAIR();
    }
    public function canChangeToCompleteState(): bool
    {
        return $this->donatedItem->is_done_pickingup
            && $this->donatedItem->is_done_storing
            && $this->donatedItem->repaired_volunteer_id == null
            && !$this->donatedItem->is_done_repairing
            && !$this->donatedItem->is_required_repairing;
    }

    public function canChangeRequiredRepairState(): bool
    {
        return $this->donatedItem->repaired_volunteer_id == null;
    }

    public function canChangeAssignedDeliverState(): bool
    {
        return $this->donatedItem->is_done_pickingup
            && $this->donatedItem->is_done_storing
            && !$this->donatedItem->is_required_repairing;
    }
}
