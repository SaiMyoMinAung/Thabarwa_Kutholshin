<?php

namespace App\State\ManageRequest;

use App\Status\RequestedItemStatus;
use App\State\ManageRequest\RequestedItemState;

class AssignedDeliveredVolunteerState extends RequestedItemState
{
    public function status()
    {
        return RequestedItemStatus::ASSIGNED_DELIVER();
    }

    public function canChangeReassignedDeliveredVolunteerState(): bool
    {
        return !$this->requestedItem->is_cancel &&
            $this->requestedItem->delivered_volunteer_id != null &&
            $this->requestedItem->is_delivering == 0;
    }

    public function canChangeDeliveringState(): bool
    {
        return !$this->requestedItem->is_cancel &&
            $this->requestedItem->delivered_volunteer_id != null &&
            !$this->requestedItem->is_delivering &&
            !$this->requestedItem->is_done_delivering;
    }
}
