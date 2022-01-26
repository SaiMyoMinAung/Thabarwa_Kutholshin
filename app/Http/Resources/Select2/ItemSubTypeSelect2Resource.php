<?php

namespace App\Http\Resources\Select2;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemSubTypeSelect2Resource extends JsonResource
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
            'name' => $this->name . " ( " . $this->unit->package_unit . "one တွင်" . $this->unit->loose_unit . $this->sacket_per_package . " ပါဝင်သည်။ )",
        ];
    }
}
