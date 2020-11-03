<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\DoneRepairingState;
use Illuminate\Validation\ValidationException;

class RepairingToDoneRepairingTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeDoneRepairingState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Done Repairing State.'],
            ]);
            throw $error;
        }
        $pickingupState = new DoneRepairingState($donatedItem);
        $donatedItem->state_class = get_class($pickingupState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
