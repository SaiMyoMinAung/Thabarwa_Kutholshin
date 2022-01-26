<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class ShareInternalDonatedItemDTO extends DataTransferObject
{
    public $date;

    public $sacket_qty;

    public $item_type_id;
    public $item_sub_type_id;

    public $admin_id;

    public $requestable_type;
    public $requestable_id;

    public $office_id;
}
