<?php

namespace App\Http\Resources;

use App\Http\Resources\CenterResource;
use Illuminate\Http\Resources\Json\JsonResource;

class WardResource extends JsonResource
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
            'center' => new CenterResource($this->center),
            'deleted_at' => $this->deleted_at,
        ];
    }
}
