<?php

namespace App\Http\Resources;

use App\Http\Resources\StoreResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BoxResource extends JsonResource
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
            'uuid' => $this->uuid,
            'name' => $this->name,
            'box_number' => $this->box_number,
            'store' => new StoreResource($this->store),
        ];
    }
}
