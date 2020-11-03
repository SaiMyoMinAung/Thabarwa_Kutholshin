<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\AssignedStoreKeeperState;
use Illuminate\Validation\ValidationException;

class DonePickingupToAssignedStoreKeeperTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeAssignedStoreKeeperState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Assigned Store Keeper State.'],
            ]);
            throw $error;
        }
        $assignedStoreKeeperState = new AssignedStoreKeeperState($donatedItem);
        $donatedItem->state_class = get_class($assignedStoreKeeperState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
