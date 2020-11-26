<?php

namespace App\State\ManageRequest;

use App\Status\RequestedItemStatus;
use App\State\ManageRequest\RequestedItemState;

class DoneDeliveringState extends RequestedItemState
{
    public function status()
    {
        return RequestedItemStatus::DONE_DELIVERING();
    }

    public function canChangeCompleteState(): bool
    {
        return !$this->requestedItem->is_cancel &&
            $this->requestedItem->delivered_volunteer_id != null &&
            $this->requestedItem->is_delivering &&
            $this->requestedItem->is_done_delivering;
    }
}
