<?php

namespace App\State;

use App\DonatedItem;
use Illuminate\Validation\ValidationException;

class StoreTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->canStore()) {
            $error = ValidationException::withMessages([
                'transition_error' => ["Cann't Store."],
            ]);
            throw $error->redirectTo(route('donated_items.manage', ['donated_item' => $donatedItem->uuid, 'stepper' => Request()->stepper]));
        }

        return $donatedItem;

        // History::log($invoice, "Pending to Paid");
    }
}
