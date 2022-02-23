<?php

namespace App\Http\Resources;

use App\Http\Resources\OfficeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ContributionResource extends JsonResource
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
            'receiveOffice' => new OfficeResource($this->receiveOffice)
        ];
    }
}
