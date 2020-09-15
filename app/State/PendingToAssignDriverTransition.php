<?php

namespace App\State;

use App\DonatedItem;

class PendingToAssignDriverTransition
{
    public function __invoke(DonatedItem $donatedItem): DonatedItem
    {
        if (!$donatedItem->canAssignDriver()) {
            throw new InvalidTransitionException(self::class, $donatedItem);
        }

        $donatedItem->status_class = AssignDriverState::class;
        $donatedItem->save();

        return $donatedItem;

        // History::log($invoice, "Pending to Paid");
    }
}
