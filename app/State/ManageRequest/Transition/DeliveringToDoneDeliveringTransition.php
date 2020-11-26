<?php

namespace App\State\ManageRequest\Transition;

use App\RequestedItem;
use Illuminate\Validation\ValidationException;
use App\State\ManageRequest\DoneDeliveringState;

class DeliveringToDoneDeliveringTransition
{
    public function __invoke(RequestedItem $requestedItem): RequestedItem
    {
        if (!$requestedItem->state->canChangeDoneDeliveringState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Done Delivering State.'],
            ]);
            throw $error;
        }
        
        $deliveringState = new DoneDeliveringState($requestedItem);
        $requestedItem->state_class = get_class($deliveringState);
        $requestedItem->status = $requestedItem->state->status();
        $requestedItem->save();

        return $requestedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
