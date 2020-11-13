<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\CompleteState;
use Illuminate\Validation\ValidationException;

class DoneRepairingToCompleteTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeToCompleteState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Complete State.'],
            ]);
            throw $error;
        }
        $pickingupState = new CompleteState($donatedItem);
        $donatedItem->state_class = get_class($pickingupState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
