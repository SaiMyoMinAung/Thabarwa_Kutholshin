<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class AssignDeliverDTO extends DataTransferObject
{
    public $delivered_volunteer_id;
}
