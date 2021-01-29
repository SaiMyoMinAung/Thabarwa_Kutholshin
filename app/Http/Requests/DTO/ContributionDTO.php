<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class ContributionDTO extends DataTransferObject
{
    public $title;
    public $note;
    public $volunteer_id;
    public $office_id;
    public $receive_office_id;
}
