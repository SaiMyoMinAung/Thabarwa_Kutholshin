<?php

namespace App\State;

use App\DonatedItem;
use App\State\CancelledState;
use Illuminate\Validation\ValidationException;

class ConfirmedToCancelledTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeCancelledState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Cancelled State.'],
            ]);
            throw $error;
        }
        $confirmedState = new CancelledState($donatedItem);
        $donatedItem->state_class = get_class($confirmedState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->is_confirmed = 0;
        $donatedItem->save();

        Request()->session()->reflash();
        Request()->session()->flash('transition_success', 'Confirmed To Cancelled Transition Is Successful.');

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");
    }
}
