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
        $donatedItem = $this->requestedItem->donatedItem;

        $totalItemCount = $donatedItem->qty;

        $requestedItemCount = $donatedItem->requestedItems()->where('status', '!=', RequestedItemStatus::CANCELLED())->get()->sum('qty');

        $canRequest = $totalItemCount >= ($requestedItemCount + $this->requestedItem->qty);
        
        return $this->requestedItem->delivered_volunteer_id == null
            && !$this->requestedItem->is_delivering
            && !$this->requestedItem->is_done_delivering
            && $this->requestedItem->is_cancel
            && $canRequest;
    }
}
