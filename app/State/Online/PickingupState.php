<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class PickingupState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::PICKINGUP();
    }

    public function canChangeDonePickingUpState(): bool
    {
        return $this->donatedItem->is_pickingup == 1;
    }
}
