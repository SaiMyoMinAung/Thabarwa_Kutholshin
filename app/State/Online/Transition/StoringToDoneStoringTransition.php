<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\DoneStoringState;
use Illuminate\Validation\ValidationException;

class StoringToDoneStoringTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeDoneStoringState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Done Storing State.'],
            ]);
            throw $error;
        }
        $pickingupState = new DoneStoringState($donatedItem);
        $donatedItem->state_class = get_class($pickingupState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
