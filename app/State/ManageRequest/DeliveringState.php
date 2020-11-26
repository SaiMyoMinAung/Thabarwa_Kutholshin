<?php

namespace App\State\ManageRequest;

use App\Status\RequestedItemStatus;
use App\State\ManageRequest\RequestedItemState;

class DeliveringState extends RequestedItemState
{
    public function status()
    {
        return RequestedItemStatus::DELIVERING();
    }

    public function canChangeDoneDeliveringState(): bool
    {
        return !$this->requestedItem->is_cancel &&
            $this->requestedItem->delivered_volunteer_id != null &&
            $this->requestedItem->is_delivering &&
            !$this->requestedItem->is_done_delivering;
    }
}
