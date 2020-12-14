<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class YogiDTO extends DataTransferObject
{
    public $name;
    public $phone;
    public $ward_id;
    public $password;
}
