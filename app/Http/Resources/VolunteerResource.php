<?php

namespace App\Http\Resources;

use App\Http\Resources\OfficeResource;
use App\Http\Resources\StateRegionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VolunteerResource extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'state_region' => new StateRegionResource($this->state_region),
            'office' => new OfficeResource($this->office),
            'is_available' => $this->is_available,
        ];
    }
}
