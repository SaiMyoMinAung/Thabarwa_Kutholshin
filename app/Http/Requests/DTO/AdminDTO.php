<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class AdminDTO extends DataTransferObject
{
    public $name;
    public $email;
    public $password;
    public $phone;
    public $office_id;
}
