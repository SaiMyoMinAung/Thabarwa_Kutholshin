<?php

namespace App\State;

use App\State\DonatedItemState;

class PickUpDonatedItemState extends DonatedItemState
{
    public function colour(): string
    {
        return 'green';
    }

    public function mustBePaid(): bool
    {
        return false;
    }
}
