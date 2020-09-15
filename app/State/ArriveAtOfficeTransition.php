<?php

namespace App\State;

use App\DonatedItem;
use Illuminate\Validation\ValidationException;

class ArriveAtOfficeTransition
{
    public function __invoke(DonatedItem $donatedItem, $updateData = null): DonatedItem
    {
        if (!$donatedItem->canArriveAtOffice()) {
            if ($donatedItem->is_pickingup) {
                $validationMessage = "You've Been Marked As Arrive At Office.";
            } else {
                $validationMessage = "Cann't Mark As Arrive At Office Before Picking Up.";
            }
            $error = ValidationException::withMessages([
                'transition_error' => [$validationMessage],
            ]);
            throw $error->redirectTo(route('donated_items.manage', ['donated_item' => $donatedItem->uuid, 'stepper' => Request()->stepper]));
        }

        $donatedItem->update($updateData);

        return $donatedItem;

        // History::log($invoice, "Pending to Paid");
    }
}
