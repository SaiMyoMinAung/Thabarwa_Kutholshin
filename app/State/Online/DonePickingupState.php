<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class DonePickingupState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::DONE_PICKINGUP();
    }

    public function canChangeAssignedStoreKeeperState(): bool
    {
        return $this->donatedItem->is_done_pickingup == 1 &&
            $this->donatedItem->store_keeper_volunteer_id == null;
    }
}
