<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\RequiredRepairState;
use Illuminate\Validation\ValidationException;

class RequiredRepairTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeRequiredRepairState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Required Repair State.'],
            ]);
            throw $error;
        }
        $requiredRepairState = new RequiredRepairState($donatedItem);
        $donatedItem->state_class = get_class($requiredRepairState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
