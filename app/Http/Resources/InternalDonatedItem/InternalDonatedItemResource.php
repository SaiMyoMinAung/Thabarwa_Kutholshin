<?php

namespace App\Http\Resources\InternalDonatedItem;

use App\Http\Resources\AlmsRoundResource;
use App\Http\Resources\ItemTypeResource;
use App\Http\Resources\ItemSubTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'item_sub_type_id' => $this->item_sub_type_id,
            'is_confirmed' => (bool) $this->is_confirmed,
            'selectedAlmsRound' => new AlmsRoundResource($this->almsRound),
            'selectedItemSubType' => new ItemSubTypeResource($this->itemSubType),
            'canConfirm' => auth()->user()->can('create-and-confirm-internal-donated-items')
        ];
    }
}
