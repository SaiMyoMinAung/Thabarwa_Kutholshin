<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\DeliveringState;
use Illuminate\Validation\ValidationException;

class AssignedOrReassignToDeliveringTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeDeliveringState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Delivering State.'],
            ]);
            throw $error;
        }
        $confirmedState = new DeliveringState($donatedItem);
        $donatedItem->state_class = get_class($confirmedState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");
    }
}
