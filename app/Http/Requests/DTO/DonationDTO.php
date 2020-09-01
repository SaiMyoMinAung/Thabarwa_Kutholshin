<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class DonationDTO extends DataTransferObject
{
    public $about_item;
    public $name;
    public $phone;
    public $pickedup_address;
    public $pickedup_at;
    public $email;
    public $image;
    public $remark;
}
