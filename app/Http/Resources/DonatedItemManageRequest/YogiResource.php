<?php

namespace App\Http\Resources\DonatedItemManageRequest;

use App\Http\Resources\CityResource;
use App\Http\Resources\WardResource;
use Illuminate\Http\Resources\Json\JsonResource;

class YogiResource extends JsonResource
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
            'uuid' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => new CityResource($this->city),
            'ward' => new WardResource($this->ward)
        ];
    }
}
