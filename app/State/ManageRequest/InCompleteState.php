<?php

namespace App\State\ManageRequest;

use App\Status\RequestedItemStatus;
use App\State\ManageRequest\RequestedItemState;

class InCompleteState extends RequestedItemState
{
    public function status()
    {
        return RequestedItemStatus::INCOMPLETE();
    }

    public function canChangeCompleteState(): bool
    {
        return !$this->requestedItem->is_cancel &&
            $this->requestedItem->is_done_delivering &&
            !$this->requestedItem->is_complete;
    }
}
