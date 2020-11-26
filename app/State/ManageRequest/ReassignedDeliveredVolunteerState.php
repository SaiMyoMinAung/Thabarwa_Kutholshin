<?php

namespace App\State\ManageRequest;

use App\Status\RequestedItemStatus;
use App\State\ManageRequest\RequestedItemState;

class ReassignedDeliveredVolunteerState extends RequestedItemState
{
    public function status()
    {
        return RequestedItemStatus::REASSIGNED_DELIVER();
    }

    public function canChangeReassignedDeliveredVolunteerState(): bool
    {
        return $this->requestedItem->delivered_volunteer_id != null &&
            !$this->requestedItem->is_delivering;
    }

    public function canChangeDeliveringState(): bool
    {
        return $this->requestedItem->delivered_volunteer_id != null &&
            !$this->requestedItem->is_delivering &&
            !$this->requestedItem->is_done_delivering;
    }
}
