<?php

namespace App\State\ManageRequest;

use App\State\ManageRequest\RequestedItemState;
use App\Status\RequestedItemStatus;

class NewRequestState extends RequestedItemState
{
    public function status()
    {
        return RequestedItemStatus::NEW_REQUEST();
    }

    public function canChangeAssignedDeliveredVolunteerState(): bool
    {
        return !$this->requestedItem->is_cancel
            && $this->requestedItem->delivered_volunteer_id == null
            && !$this->requestedItem->is_delivering;
    }

    public function canChangeCancelState(): bool
    {
        return !$this->requestedItem->is_cancel
            && $this->requestedItem->delivered_volunteer_id == null
            && !$this->requestedItem->is_delivering
            && !$this->requestedItem->is_done_delivering;
    }
}
