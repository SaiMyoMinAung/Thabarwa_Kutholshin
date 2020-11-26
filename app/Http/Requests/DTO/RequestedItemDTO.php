<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class RequestedItemDTO extends DataTransferObject
{
    public $request_no;
    public $status;
    public $state_class;
    public $requestable_id;
    public $requestable_type;
    public $qty;
}
