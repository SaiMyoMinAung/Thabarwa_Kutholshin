<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class RequiredRepairState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::REQUIRED_REPAIR();
    }

    public function canChangeNotRequiredRepairState(): bool
    {
        return $this->donatedItem->repaired_volunteer_id == null;
    }

    public function canChangeAssignRepairerState(): bool
    {
        return $this->donatedItem->is_required_repairing;
    }
}
