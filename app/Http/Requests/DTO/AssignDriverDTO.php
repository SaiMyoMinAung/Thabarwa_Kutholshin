<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class AssignDriverDTO extends DataTransferObject
{
    public $pickedup_volunteer_id;
}
