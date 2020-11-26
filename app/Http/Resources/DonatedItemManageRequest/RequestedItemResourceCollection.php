<?php

namespace App\Http\Resources\DonatedItemManageRequest;

use App\Http\Resources\BaseResourceCollection;

class RequestedItemResourceCollection extends BaseResourceCollection
{
    public function toArray($request)
    {
        $this->data["data"] = $this->collection;

        return $this->data;
    }
}
