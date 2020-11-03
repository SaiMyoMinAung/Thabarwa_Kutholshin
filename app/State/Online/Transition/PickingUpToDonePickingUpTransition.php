<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\DonePickingupState;
use Illuminate\Validation\ValidationException;

class PickingUpToDonePickingUpTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeDonePickingUpState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Done Pickingup State.'],
            ]);
            throw $error;
        }
        $pickingupState = new DonePickingupState($donatedItem);
        $donatedItem->state_class = get_class($pickingupState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
