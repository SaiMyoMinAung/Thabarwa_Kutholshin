<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class ReassignedStoreKeeperState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::REASSIGNED_STORE_KEEPER();
    }

    public function canChangeReassignedStoreKeeperState(): bool
    {
        return $this->donatedItem->is_done_pickingup == 1
            && $this->donatedItem->store_keeper_volunteer_id != null
            && $this->donatedItem->is_storing == 0;
    }

    public function canChangeStoringState(): bool
    {
        return $this->donatedItem->is_done_pickingup == 1
            && $this->donatedItem->store_keeper_volunteer_id != null
            && $this->donatedItem->is_storing == 0;
    }
}
