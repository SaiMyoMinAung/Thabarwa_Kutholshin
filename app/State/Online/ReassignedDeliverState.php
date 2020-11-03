<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class ReassignedDeliverState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::REASSIGNED_DELIVER();
    }

    public function canChangeReassignedDeliverState(): bool
    {
        return $this->donatedItem->delivered_volunteer_id != null &&
            !$this->donatedItem->is_done_delivering &&
            !$this->donatedItem->is_delivering;
    }

    public function canChangeDeliveringState(): bool
    {
        return $this->donatedItem->delivered_volunteer_id != null;
    }
}
