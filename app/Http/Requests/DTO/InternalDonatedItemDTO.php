<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class InternalDonatedItemDTO extends DataTransferObject
{
    public $date;
    public $alms_round_id;
    public $package_qty;
    public $sacket_qty;
    public $item_sub_type_id;
    public $status;
    public $is_confirmed;
    public $office_id;
    public $admin_id;
}
