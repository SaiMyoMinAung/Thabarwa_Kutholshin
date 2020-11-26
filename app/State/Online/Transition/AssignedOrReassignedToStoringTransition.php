<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\StoringState;
use Illuminate\Validation\ValidationException;

class AssignedOrReassignedToStoringTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeStoringState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Storing State.'],
            ]);
            throw $error;
        }
        $pickingupState = new StoringState($donatedItem);
        $donatedItem->state_class = get_class($pickingupState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
