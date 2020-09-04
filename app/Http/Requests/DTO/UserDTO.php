<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class UserDTO extends DataTransferObject
{
    public $name;
    public $email;
    public $email_verified_at;
    public $password;
    public $remember_token;
    public $created_at;
    public $updated_at;
    public $phone;
    public $state_region_id;
}
