<?php

namespace App\Http\Resources;

use App\Http\Resources\CenterResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
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
            'address' => $this->address,
            'is_open' => $this->is_open,
            'center' => new CenterResource($this->center),
        ];
    }
}
