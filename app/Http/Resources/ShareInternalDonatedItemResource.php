<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShareInternalDonatedItemResource extends JsonResource
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
            'item_type' => $this->itemType,
            'item_sub_type' => $this->itemSubType,
            'name' => $this->requestable->name,
            'type' => $this->requestable_type,
            'package_qty' => $this->package_qty,
            'socket_qty' => $this->socket_qty
        ];
    }
}
