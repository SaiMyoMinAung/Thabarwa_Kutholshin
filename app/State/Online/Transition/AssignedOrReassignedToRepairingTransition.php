<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\RepairingState;
use Illuminate\Validation\ValidationException;

class AssignedOrReassignedToRepairingTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeRepairingState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Repairing State.'],
            ]);
            throw $error;
        }
        $repairingState = new RepairingState($donatedItem);
        $donatedItem->state_class = get_class($repairingState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
