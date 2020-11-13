<?php

namespace App\Http\Resources\DonatedItem;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Select2\BoxSelect2Resource;
use App\Http\Resources\Select2\StoreSelect2Resource;
use App\Http\Resources\Select2\VolunteerSelect2Resource;

class DonatedItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'about_item' => $this->about_item,
            'statusName' => $this->statusName,
            // Assign Driver Step
            'pickedup_volunteer_id' => $this->pickedup_volunteer_id,
            'pickedup_volunteer' => new VolunteerSelect2Resource($this->pickedupVolunteer),
            'is_pickingup' => (bool) $this->is_pickingup,
            'is_done_pickingup' => (bool) $this->is_done_pickingup,
            // Assign Store Keeper Step
            'store_keeper_volunteer_id' => $this->store_keeper_volunteer_id,
            'store_keeper_volunteer' => new VolunteerSelect2Resource($this->storeKeeperVolunteer),
            'is_storing' => (bool) $this->is_storing,
            'is_done_storing' => (bool) $this->is_done_storing,
            'officeName' => auth()->user()->office->name,
            'store' => new StoreSelect2Resource($this->store),
            'store_id' => $this->store_id,
            'box' => new BoxSelect2Resource($this->box),
            'box_id' => $this->box_id,
            // Assign Repairer Step
            'repaired_volunteer' => new VolunteerSelect2Resource($this->repairedVolunteer),
            'repaired_volunteer_id' => $this->repaired_volunteer_id,
            'is_repairing' => (bool) $this->is_repairing,
            'is_required_repairing' => (bool) $this->is_required_repairing,
            'is_done_repairing' => (bool) $this->is_done_repairing,
            // Assign Complete Step
            'is_complete' => (bool) $this->is_complete,
        ];
    }
}
