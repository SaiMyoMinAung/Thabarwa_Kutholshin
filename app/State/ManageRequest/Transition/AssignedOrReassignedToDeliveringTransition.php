<?php

namespace App\State\ManageRequest\Transition;

use App\RequestedItem;
use App\State\ManageRequest\DeliveringState;
use Illuminate\Validation\ValidationException;

class AssignedOrReassignedToDeliveringTransition
{
    public function __invoke(RequestedItem $requestedItem): RequestedItem
    {
        if (!$requestedItem->state->canChangeDeliveringState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Delivering State.'],
            ]);
            throw $error;
        }
        
        $deliveringState = new DeliveringState($requestedItem);
        $requestedItem->state_class = get_class($deliveringState);
        $requestedItem->status = $requestedItem->state->status();
        $requestedItem->save();

        return $requestedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
