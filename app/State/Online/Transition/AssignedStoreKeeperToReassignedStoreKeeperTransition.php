<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\ReassignedStoreKeeperState;
use Illuminate\Validation\ValidationException;

class AssignedStoreKeeperToReassignedStoreKeeperTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeReassignedStoreKeeperState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Assigned Store Keeper State.'],
            ]);
            throw $error;
        }
        $reassignedStoreKeeperState = new ReassignedStoreKeeperState($donatedItem);
        $donatedItem->state_class = get_class($reassignedStoreKeeperState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
