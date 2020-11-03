<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\DoneDeliveringState;
use Illuminate\Validation\ValidationException;

class DeliveringToDoneDeliveringTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeDoneDeliveringState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Done Delivering State.'],
            ]);
            throw $error;
        }

        $reassignedDriverState = new DoneDeliveringState($donatedItem);
        $donatedItem->state_class = get_class($reassignedDriverState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
