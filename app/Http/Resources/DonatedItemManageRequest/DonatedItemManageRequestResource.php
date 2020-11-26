<?php

namespace App\Http\Resources\DonatedItemManageRequest;

use Illuminate\Http\Resources\Json\JsonResource;

class DonatedItemManageRequestResource extends JsonResource
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
            'item_unique_id' => $this->item_unique_id,
            'about_item' => $this->about_item,
            'donor_name' => $this->donor_name,
        ];
    }
}
