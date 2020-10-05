<?php

namespace App\Http\Resources;

use App\Http\Resources\OfficeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'store_number' => $this->store_number,
            'office' => new OfficeResource($this->office),
        ];
    }
}
