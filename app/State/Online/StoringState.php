<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class StoringState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::STORING();
    }
    
    public function canChangeDoneStoringState(): bool
    {
        return $this->donatedItem->is_done_pickingup == 1 &&
         $this->donatedItem->is_storing == 1 &&
            $this->donatedItem->store_keeper_volunteer_id != null;
    }
}
