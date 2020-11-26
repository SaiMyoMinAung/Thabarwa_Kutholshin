<?php

namespace App\State\ManageRequest;

use App\Status\RequestedItemStatus;
use App\State\ManageRequest\RequestedItemState;

class CompleteState extends RequestedItemState
{
    public function status()
    {
        return RequestedItemStatus::COMPLETE();
    }

    public function canChangeInCompleteState(): bool
    {
        return !$this->requestedItem->is_cancel
            && $this->requestedItem->is_done_delivering
            && $this->requestedItem->is_complete;
    }
}
