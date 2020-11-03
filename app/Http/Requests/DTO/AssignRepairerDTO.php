<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class AssignRepairerDTO extends DataTransferObject
{
    public $repaired_volunteer_id;
}
