<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class AssignStoreKeeperDTO extends DataTransferObject
{
    public $store_keeper_volunteer_id;
    public $store_id;
    public $box_id;
}
