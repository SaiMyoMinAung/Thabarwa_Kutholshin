<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class UserDTO extends DataTransferObject
{
    public $name;
    public $email;
    public $password;
    public $phone;
    public $city_id;
    public $is_special_donor;
}
