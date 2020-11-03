<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\ReAssignedDriverState;
use Illuminate\Validation\ValidationException;

class AssignedDriverToReassignedDriverTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeReAssignedDriverState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Reassigned Driver State.'],
            ]);
            throw $error;
        }
        $reassignedDriverState = new ReAssignedDriverState($donatedItem);
        $donatedItem->state_class = get_class($reassignedDriverState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        // Request()->session()->reflash();
        // Request()->session()->flash('transition_success', 'Confirmed To Cancelled Transition Is Successful.');

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
