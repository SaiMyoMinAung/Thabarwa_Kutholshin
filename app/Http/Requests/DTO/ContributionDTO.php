<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class ContributionDTO extends DataTransferObject
{
    public $name;
    public $receive_office_id;
    public $office_id;
}
