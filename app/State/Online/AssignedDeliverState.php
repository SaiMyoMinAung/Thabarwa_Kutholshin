<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class AssignedDeliverState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::ASSIGNED_DELIVER();
    }

    public function canChangeReassignedDeliverState(): bool
    {
        return $this->donatedItem->delivered_volunteer_id != null &&
            $this->donatedItem->is_delivering == 0;
    }

    public function canChangeDeliveringState(): bool
    {
        return $this->donatedItem->delivered_volunteer_id != null;
    }

    // public function canChangePickingUpState(): bool
    // {
    //     return $this->donatedItem->pickedup_volunteer_id != null;
    // }
}
