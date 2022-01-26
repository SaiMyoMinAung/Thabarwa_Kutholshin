<?php

namespace App\Http\Resources;

use App\Http\Resources\ItemTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemSubTypeResource extends JsonResource
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
            'id' => $this->id,
            'original_name' => $this->name,
            'name' => $this->name  . " ( " . $this->unit->package_unit . " one တွင်" . $this->unit->loose_unit . $this->sacket_per_package . " ပါဝင်သည်။ )",
            'unit' => new UnitResource($this->unit),
            'sacket_per_package' => $this->sacket_per_package,
            'item_type' => new ItemTypeResource($this->itemType),
            'deleted_at' => $this->deleted_at
        ];
    }
}
