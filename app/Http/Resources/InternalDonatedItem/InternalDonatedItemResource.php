<?php

namespace App\Http\Resources\InternalDonatedItem;

use App\Status\Unit;
use App\Http\Resources\ItemTypeResource;
use App\Status\InternalDonatedItemStatus;
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
        $foundedUnit = Unit::advanceSearch($this->unit);
        $selectedUnit = [
            'id' => $foundedUnit['code'],
            'name' => $foundedUnit['label'] . '(' . $foundedUnit['symbol'] . ')'
        ];

        return [
            'uuid' => $this->uuid,
            'item_unique_id' => $this->item_unique_id,
            'name' => $this->name,
            'package_qty' => $this->package_qty,
            'socket_qty' => $this->socket_qty,
            'socket_per_package' => $this->socket_per_package,
            'unit' => $this->unit,
            'remark' => $this->remark,
            'item_type_id' => $this->item_type_id,
            'is_confirmed' => (bool) $this->is_confirmed,
            'status' => InternalDonatedItemStatus::advanceSearch($this->status)["label"],
            'selectedUnit' => $selectedUnit,
            'selectedItemType' => new ItemTypeResource($this->itemType)
        ];
    }
}
