<?php

namespace App\Http\Resources;

class InternalRequestItemResourceCollection extends BaseResourceCollection
{
    public function toArray($request)
    {
        $this->data["data"] = $this->collection;

        return $this->data;
    }
}