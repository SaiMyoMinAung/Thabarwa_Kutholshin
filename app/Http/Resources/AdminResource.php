<?php

namespace App\Http\Resources;


use App\Http\Resources\CenterResource;
use App\Http\Resources\OfficeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'is_reginal_admin' => (bool) $this->is_reginal_admin,
            'is_super' => (bool) $this->is_super,
            'center' => new CenterResource($this->center),
            'office' => new OfficeResource($this->office),
        ];
    }
}
