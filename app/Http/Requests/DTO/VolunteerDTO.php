<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class VolunteerDTO extends DataTransferObject
{
    public $name;
    public $email;
    public $password;
    public $phone;
    public $state_region_id;
    public $office_id;
}
