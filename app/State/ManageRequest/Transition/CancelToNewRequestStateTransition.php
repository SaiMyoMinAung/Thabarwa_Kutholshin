<?php

namespace App\State\ManageRequest\Transition;

use App\RequestedItem;
use App\State\ManageRequest\NewRequestState;
use Illuminate\Validation\ValidationException;

class CancelToNewRequestStateTransition
{
    public function __invoke(RequestedItem $requestedItem): RequestedItem
    {
        if (!$requestedItem->state->canChangeNewRequestState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To New Request State.'],
            ]);
            throw $error;
        }

        $newRequestState = new NewRequestState($requestedItem);
        $requestedItem->state_class = get_class($newRequestState);
        $requestedItem->status = $requestedItem->state->status();
        $requestedItem->save();

        return $requestedItem;
    }
}
