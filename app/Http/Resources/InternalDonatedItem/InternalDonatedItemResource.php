<?php

namespace App\Http\Resources\InternalDonatedItem;

use App\Http\Resources\AlmsRoundResource;
use App\Http\Resources\ItemTypeResource;
use App\Status\InternalDonatedItemStatus;
use App\Http\Resources\ItemSubTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Select2\UnitSelect2Resource;

class InternalDonatedItemResource extends JsonResource
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
            'item_unique_id' => $this->item_unique_id,
            'alms_round_id' => $this->alms_round_id,
            'package_qty' => $this->package_qty,
            'sacket_qty' => $this->sacket_qty,
            'item_type_id' => $this->item_type_id,
            'item_sub_type_id' => $this->item_sub_type_id,
            'is_confirmed' => (bool) $this->is_confirmed,
            'status' => InternalDonatedItemStatus::advanceSearch($this->status)["label"],
            'selectedAlmsRound' => new AlmsRoundResource($this->AlmsRound),
            'selectedItemType' => new ItemTypeResource($this->itemType),
            'selectedItemSubType' => new ItemSubTypeResource($this->itemSubType),
            'canConfirm' => auth()->user()->can('create-and-confirm-internal-donated-items')
        ];
    }
}
