<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class ArriveAtOfficeDTO extends DataTransferObject
{
    public $is_arrive_at_office = 1;
}
