<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\ConfirmedState;
use Illuminate\Validation\ValidationException;

class NewToConfirmedTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeConfirmedState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Confirmed State.'],
            ]);
            throw $error;
        }
        
        $confirmedState = new ConfirmedState($donatedItem);
        $donatedItem->state_class = get_class($confirmedState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->is_confirmed_by_donor = 1;
        $donatedItem->save();

        Request()->session()->reflash();
        Request()->session()->flash('transition_success', 'New To Confirmed Transition Is Successful.');
        
        return $donatedItem;
        // History::log($invoice, "Pending to Paid");
    }
}
