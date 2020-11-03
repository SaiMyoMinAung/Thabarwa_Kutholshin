<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class DonatedItemDTO extends DataTransferObject
{
    public $about_item;
    public $pickedup_at;
    public $pickedup_info;
    public $donated_user_id;
    public $remark;
    public $status;
    public $state_class;
    public $kind_of_item;
    // public $item_type_id;
    // public $state_region_id;
    // public $delivered_at;
    // public $delivered_info;
    // public $store_id;
    // public $receiver_id;
    // public $item_unique_id;
    // public $pickedup_driver_id;
    // public $delivered_driver_id;
}
