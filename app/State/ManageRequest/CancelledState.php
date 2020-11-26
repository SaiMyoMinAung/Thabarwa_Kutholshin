<?php

namespace App\State\ManageRequest;

use App\State\ManageRequest\RequestedItemState;
use App\Status\RequestedItemStatus;

class CancelledState extends RequestedItemState
{
    public function status()
    {
        return RequestedItemStatus::CANCELLED();
    }

    public function canChangeNewRequestState(): bool
    {
        return $this->requestedItem->delivered_volunteer_id == null
            && !$this->requestedItem->is_delivering
            && !$this->requestedItem->is_done_delivering
            && $this->requestedItem->is_cancel;
    }
}
