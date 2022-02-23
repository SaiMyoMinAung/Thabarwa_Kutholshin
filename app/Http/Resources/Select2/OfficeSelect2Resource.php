<?php

namespace App\Http\Resources\Select2;

use App\Http\Resources\CenterResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OfficeSelect2Resource extends JsonResource
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
            'center' => new CenterResource($this->center)
        ];
    }
}
