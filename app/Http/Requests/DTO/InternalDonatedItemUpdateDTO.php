<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class InternalDonatedItemUpdateDTO extends DataTransferObject
{
    public $name;
    public $package_qty;
    public $socket_qty;
    public $socket_per_package;
    public $unit;
    public $item_type_id;
    public $remark;
    public $is_confirmed;
}
