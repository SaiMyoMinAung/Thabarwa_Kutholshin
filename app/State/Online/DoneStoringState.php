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

    public function canChangeAssignRepairerState(): bool
    {
        return $this->donatedItem->is_done_pickingup &&
            $this->donatedItem->is_done_storing &&
            $this->donatedItem->is_required_repairing;
    }

    public function canChangeNotRequiredRepairState(): bool
    {
        return $this->donatedItem->is_done_pickingup &&
            $this->donatedItem->is_done_storing &&
            $this->donatedItem->is_required_repairing &&
            $this->donatedItem->repaired_volunteer_id == null;
    }
}
