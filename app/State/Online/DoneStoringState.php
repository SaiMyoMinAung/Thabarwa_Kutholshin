<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class DoneStoringState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::DONE_STORING();
    }

    public function canChangeRequiredRepairState(): bool
    {
        return $this->donatedItem->is_done_pickingup
            && $this->donatedItem->is_done_storing;
    }
    public function canChangeNotRequiredRepairState(): bool
    {
        return $this->donatedItem->is_done_storing &&
            $this->donatedItem->repaired_volunteer_id == null;
    }
}
