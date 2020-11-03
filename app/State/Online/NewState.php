<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class NewState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::NEW_STATE();
    }

    public function canChangeConfirmedState(): bool
    {
        return $this->donatedItem->is_confirmed != 1;
    }

}
