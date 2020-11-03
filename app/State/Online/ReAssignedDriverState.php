<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class ReAssignedDriverState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::REASSIGNED_DRIVER();
    }

    public function canChangeReAssignedDriverState(): bool
    {
        return $this->donatedItem->pickedup_volunteer_id != null &&
            $this->donatedItem->is_done_pickingup == 0;
    }
    
    public function canChangePickingUpState(): bool
    {
        return $this->donatedItem->pickedup_volunteer_id != null;
    }
}
