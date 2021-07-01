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
            'name' => $this->name,
            'item_type' => new ItemTypeResource($this->itemType),
            'deleted_at' => $this->deleted_at
        ];
    }
}
