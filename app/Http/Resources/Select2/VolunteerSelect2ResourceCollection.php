<?php

namespace App\Http\Resources\Select2;

use App\Http\Resources\BaseResourceCollection;

class VolunteerSelect2ResourceCollection extends BaseResourceCollection
{
    public function toArray($request)
    {
        $this->data["data"] = $this->collection;

        return $this->data;
    }
}