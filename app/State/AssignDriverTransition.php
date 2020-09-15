<?php

namespace App\State;

use App\DonatedItem;
use Illuminate\Validation\ValidationException;

class AssignDriverTransition
{
    public function __invoke(DonatedItem $donatedItem, $updateData = null): DonatedItem
    {
        if (!$donatedItem->canAssignDriver()) {
            $error = ValidationException::withMessages([
                'transition_error' => ["Cann't Assign Again After Picking Up."],
            ]);
            throw $error->redirectTo(route('donated_items.manage', ['donated_item' => $donatedItem->uuid, 'stepper' => Request()->stepper]));
        }

        $donatedItem->update($updateData);

        return $donatedItem;

        // History::log($invoice, "Pending to Paid");
    }
}
