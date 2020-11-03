<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\AssignedDeliverState;
use Illuminate\Validation\ValidationException;

class NotRequiredRepairToAssignedDeliverTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeAssignedDeliverState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Assigned Deliver State.'],
            ]);
            throw $error;
        }
        $confirmedState = new AssignedDeliverState($donatedItem);
        $donatedItem->state_class = get_class($confirmedState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");
    }
}
