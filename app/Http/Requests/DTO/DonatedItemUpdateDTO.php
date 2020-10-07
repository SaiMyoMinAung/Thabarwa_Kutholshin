<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class DonatedItemUpdateDTO extends DataTransferObject
{
    public $about_item;
    public $pickedup_at;
    public $pickedup_info;
    public $remark;
}
