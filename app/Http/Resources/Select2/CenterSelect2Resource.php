<?php

namespace App\Http\Resources\Select2;

use App\Http\Resources\CityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CenterSelect2Resource extends JsonResource
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
            'city' => new CityResource($this->city)
        ];
    }
}
