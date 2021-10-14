<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
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
            'package_unit' => $this->package_unit,
            'package_symbol' => $this->package_symbol,
            'loose_unit' => $this->loose_unit,
            'loose_symbol' => $this->loose_symbol,
            'deleted_at' => $this->deleted_at
        ];
    }
}
