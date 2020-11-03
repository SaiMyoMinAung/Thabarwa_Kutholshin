<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\ReassignedDeliverState;
use Illuminate\Validation\ValidationException;

class AssignedDeliverToReassignedDeliverTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeReassignedDeliverState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Reassigned Deliver State.'],
            ]);
            throw $error;
        }
        $confirmedState = new ReassignedDeliverState($donatedItem);
        $donatedItem->state_class = get_class($confirmedState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");
    }
}
