<?php

namespace App\State\ManageRequest\Transition;

use App\RequestedItem;
use App\State\ManageRequest\CancelledState;
use Illuminate\Validation\ValidationException;

class NewRequestStateToCancelTransition
{
    public function __invoke(RequestedItem $requestedItem): RequestedItem
    {
        if (!$requestedItem->state->canChangeCancelState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Cancel State.'],
            ]);
            throw $error;
        }

        $cancelledState = new CancelledState($requestedItem);
        $requestedItem->state_class = get_class($cancelledState);
        $requestedItem->status = $requestedItem->state->status();
        $requestedItem->save();

        return $requestedItem;
    }
}
