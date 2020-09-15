<?php

namespace App\State;

use App\DonatedItem;
use Illuminate\Validation\ValidationException;

class ManageTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {

        if (!$donatedItem->canManage()) {
            $error = ValidationException::withMessages([
                'transition_error' => ['Can Manage This Donated Item After Confirmed To Donor.'],
            ]);
            throw $error;
        }

        return $donatedItem;

        // History::log($invoice, "Pending to Paid");
    }
}
