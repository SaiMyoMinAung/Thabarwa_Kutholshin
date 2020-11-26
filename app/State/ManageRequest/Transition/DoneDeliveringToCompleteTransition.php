<?php

namespace App\State\ManageRequest\Transition;

use App\RequestedItem;
use App\State\ManageRequest\CompleteState;
use Illuminate\Validation\ValidationException;

class DoneDeliveringToCompleteTransition
{
    public function __invoke(RequestedItem $requestedItem): RequestedItem
    {
        if (!$requestedItem->state->canChangeCompleteState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Complete State.'],
            ]);
            throw $error;
        }

        $reassignedState = new CompleteState($requestedItem);
        $requestedItem->state_class = get_class($reassignedState);
        $requestedItem->status = $requestedItem->state->status();
        $requestedItem->save();

        return $requestedItem;
    }
}
