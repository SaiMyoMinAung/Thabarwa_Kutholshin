<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\IncompleteState;
use Illuminate\Validation\ValidationException;

class CompleteToIncompleteTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeToIncompleteState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Incomplete State.'],
            ]);
            throw $error;
        }
        $pickingupState = new IncompleteState($donatedItem);
        $donatedItem->state_class = get_class($pickingupState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
