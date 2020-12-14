<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class TeamDTO extends DataTransferObject
{
    public $name;
    public $email;
    public $phone;
    public $center_id;
    public $note;
    public $is_available;
}
