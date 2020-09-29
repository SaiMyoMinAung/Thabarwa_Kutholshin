<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseResourceCollection extends ResourceCollection
{
    public $data = [];

    public function __construct($resource)
    {
        $this->data["total"] = $resource->total();
        $this->data["per_page"] = $resource->perPage();
        $this->data["current_page"] = $resource->currentPage();
        $this->data["last_page"] = $resource->lastPage();
        $this->data["path"] = $resource->path();
        $this->data["from"] = ($resource->currentPage() == 1) ? 1 : $resource->currentPage() * $resource->perPage();
        $this->data["to"] = ($resource->currentPage() == 1) ? $resource->perPage() : $this->data["from"] + $resource->perPage();
        $this->data["first_page_url"] = $resource->path() . '?page=1';
        $this->data["last_page_url"] = $resource->path() . '?page=' . $resource->lastPage();
        $this->data["next_page_url"] = ($resource->currentPage() == $resource->lastPage()) ? null : $resource->path() . '?page=' . ($resource->currentPage() + 1);;
        $this->data["prev_page_url"] = ($resource->currentPage() == 1) ? null : $resource->path() . '?page=' . ($resource->currentPage() - 1);

        $resource = $resource->getCollection();
        
        parent::__construct($resource);
    }

    // Using Laravel >= 5.6
    // public function withResponse($request, $response)
    // {
    //     $jsonResponse = json_decode($response->getContent(), true);
    //     unset($jsonResponse['links'], $jsonResponse['meta']);
    //     $response->setContent(json_encode($jsonResponse));
    // }
}
