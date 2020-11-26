<?php

namespace App\State\ManageRequest;

use App\RequestedItem;

abstract class RequestedItemState
{
    /** @var RequestedItem */
    public $requestedItem;

    public function __construct(RequestedItem $requestedItem)
    {
        $this->requestedItem = $requestedItem;
    }

    public function canChangeAssignedDeliveredVolunteerState(): bool
    {
        return false;
    }

    public function canChangeReassignedDeliveredVolunteerState(): bool
    {
        return false;
    }

    public function canChangeDeliveringState(): bool
    {
        return false;
    }

    public function canChangeCompleteState(): bool
    {
        return false;
    }

    public function canChangeInCompleteState(): bool
    {
        return false;
    }

    public function canChangeCancelState(): bool
    {
        return false;
    }

    public function canChangeNewRequestState(): bool
    {
        return false;
    }
}
