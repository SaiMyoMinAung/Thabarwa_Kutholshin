<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class ProfileDTO extends DataTransferObject
{
    public $name;
    public $email;
    public $phone;
}