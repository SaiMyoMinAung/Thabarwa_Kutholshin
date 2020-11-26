<?php

namespace App\State\ManageRequest\Transition;

use App\RequestedItem;
use Illuminate\Validation\ValidationException;
use App\State\ManageRequest\ReassignedDeliveredVolunteerState;

class AssignedDeliveredVolunteerToReassignedTransition
{
    public function __invoke(RequestedItem $requestedItem): RequestedItem
    {
        if (!$requestedItem->state->canChangeReAssignedDeliveredVolunteerState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To ReAssigned Delivered Volunteer State.'],
            ]);
            throw $error;
        }

        $reassignedState = new ReassignedDeliveredVolunteerState($requestedItem);
        $requestedItem->state_class = get_class($reassignedState);
        $requestedItem->status = $requestedItem->state->status();
        $requestedItem->save();

        return $requestedItem;
    }
}
