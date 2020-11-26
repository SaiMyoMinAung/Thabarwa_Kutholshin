<?php

namespace App\State\ManageRequest\Transition;

use App\RequestedItem;
use Illuminate\Validation\ValidationException;
use App\State\ManageRequest\AssignedDeliveredVolunteerState;

class NewRequestStateToAssignedDeliveredVolunteerTransition
{
    public function __invoke(RequestedItem $requestedItem): RequestedItem
    {
        if (!$requestedItem->state->canChangeAssignedDeliveredVolunteerState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Assigned Delivered Volunteer State.'],
            ]);
            throw $error;
        }

        $assignedVolunteerState = new AssignedDeliveredVolunteerState($requestedItem);
        $requestedItem->state_class = get_class($assignedVolunteerState);
        $requestedItem->status = $requestedItem->state->status();
        $requestedItem->save();

        return $requestedItem;
    }
}
