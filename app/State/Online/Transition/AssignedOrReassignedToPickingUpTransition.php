<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\PickingupState;
use Illuminate\Validation\ValidationException;

class AssignedOrReassignedToPickingUpTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangePickingUpState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Pickingup State.'],
            ]);
            throw $error;
        }
        $pickingupState = new PickingupState($donatedItem);
        $donatedItem->state_class = get_class($pickingupState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
