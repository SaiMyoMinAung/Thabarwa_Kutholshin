<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class DonatedItemNotiDTO extends DataTransferObject
{
    public $url;
    public $about_item;
    public $name;
    public $phone;
}
