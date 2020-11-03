<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\AssignedDriverState;
use Illuminate\Validation\ValidationException;

class ConfirmedToAssignedDriverTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeAssignedDriverState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Assigned Driver State.'],
            ]);
            throw $error;
        }
        $assignedDriverState = new AssignedDriverState($donatedItem);
        $donatedItem->state_class = get_class($assignedDriverState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        // Request()->session()->reflash();
        // Request()->session()->flash('transition_success', 'Confirmed To Cancelled Transition Is Successful.');

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
