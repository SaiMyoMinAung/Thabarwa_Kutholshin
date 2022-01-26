<?php

namespace App\Http\Resources\InternalDonatedItem;

use App\Http\Resources\ItemTypeResource;
use App\Http\Resources\ItemSubTypeResource;
use App\Services\MainCalculation;
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
        $mainCalculation = new MainCalculation;
        $id = $this->requestable->id;
        $name = $this->requestable->name;
        $result = $mainCalculation->seperatePackageSackets($this->item_sub_type_id, $this->sacket_qty);
        $requestable_type = explode('\\', $this->requestable_type);
        $requestable_type = strtoupper($requestable_type[1]);

        return [
            'uuid' => $this->uuid,

            'sacket_qty' => $result['sacket_qty'],
            'package_qty' => $result['package_qty'],

            'item_type_id' => $this->item_type_id,
            'item_sub_type_id' => $this->item_sub_type_id,

            'requestable_type' => $requestable_type,
            'requestable_id' => $this->requestable_id,

            'selectedItemType' => new ItemTypeResource($this->itemType),
            'selectedItemSubType' => new ItemSubTypeResource($this->itemSubType),

            'selectedRequestableType' => ['id' => $requestable_type, 'name' => $requestable_type],
            'selectedRequestableTypeId' => ['id' => $id, 'name' => $name],
        ];
    }
}
