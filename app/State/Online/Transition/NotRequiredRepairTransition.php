<?php

namespace App\State\Online\Transition;

use App\DonatedItem;
use App\State\Online\NotRequiredRepairState;
use Illuminate\Validation\ValidationException;

class NotRequiredRepairTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->state->canChangeNotRequiredRepairState()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Cannot Change To Not Required Repair State.'],
            ]);
            throw $error;
        }
        $requiredRepairState = new NotRequiredRepairState($donatedItem);
        $donatedItem->state_class = get_class($requiredRepairState);
        $donatedItem->status = $donatedItem->state->status();
        $donatedItem->save();

        return $donatedItem;
        // History::log($invoice, "Pending to Paid");

    }
}
