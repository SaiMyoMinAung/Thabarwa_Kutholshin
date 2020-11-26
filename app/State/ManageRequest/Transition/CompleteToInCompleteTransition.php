<?php

namespace App\State\ManageRequest\Transition;

use App\RequestedItem;
use App\State\ManageRequest\InCompleteState;
use Illuminate\Validation\ValidationException;

class CompleteToInCompleteTransition
{
    public function __invoke(RequestedItem $requestedItem): RequestedItem
    {
        if (!$requestedItem->state->canChangeInCompleteState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To InComplete State.'],
            ]);
            throw $error;
        }

        $reassignedState = new InCompleteState($requestedItem);
        $requestedItem->state_class = get_class($reassignedState);
        $requestedItem->status = $requestedItem->state->status();
        $requestedItem->save();

        return $requestedItem;
    }
}
