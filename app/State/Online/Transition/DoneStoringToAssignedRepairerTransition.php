<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\AssignRepairerState;
use Illuminate\Validation\ValidationException;

class DoneStoringToAssignedRepairerTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeAssignRepairerState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Assign Repairer State.'],
            ]);
            throw $error;
        }
        $reassignedDriverState = new AssignRepairerState($donatedItem);
        $donatedItem->state_class = get_class($reassignedDriverState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
