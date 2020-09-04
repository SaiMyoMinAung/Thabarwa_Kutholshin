<?php

namespace App\Repository;

use App\DonatedItem;

class DonatedItemRepository extends BaseRepository
{
    public $model;

    public function __construct(DonatedItem $donation)
    {
        $this->model = $donation;
    }

}
