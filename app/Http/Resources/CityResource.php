<?php

namespace App\Http\Resources;

use App\Http\Resources\StateRegionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'is_available' => $this->is_available,
            'stateRegion' => new StateRegionResource($this->stateRegion),
            'deleted_at' => $this->deleted_at,
        ];
    }
}
