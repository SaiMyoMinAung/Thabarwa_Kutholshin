<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class InternalRequestedItemDTO extends DataTransferObject
{
    public $requestable_type;
    public $requestable_id;
    public $package_qty;
    public $socket_qty;
    public $admin_id;
}
