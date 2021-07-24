<?php

namespace App\Http\Resources\InternalDonatedItem;

use App\Http\Resources\ItemTypeResource;
use App\Http\Resources\ItemSubTypeResource;
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
        $id = $this->requestable->id;
        $name = $this->requestable->name;

        return [
            'uuid' => $this->uuid,

            'package_qty' => $this->package_qty,
            'socket_qty' => $this->socket_qty,

            'item_type_id' => $this->item_type_id,
            'item_sub_type_id' => $this->item_sub_type_id,

            'requestable_type' => $this->requestable_type,
            'requestable_id' => $this->requestable_id,

            'selectedItemType' => new ItemTypeResource($this->itemType),
            'selectedItemSubType' => new ItemSubTypeResource($this->itemSubType),

            'selectedRequestableType' => ['id' => $this->requestable_type, 'name' => $this->requestable_type],
            'selectedRequestableTypeId' => ['id' => $id, 'name' => $name],
        ];
    }
}
