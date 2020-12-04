<?php

declare(strict_types=1);

namespace App\Http\Requests\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class DonationRecordDTO extends DataTransferObject
{
    public $date_of_donation;
    public $sr_no;
    public $certificate_no;
    public $center_id;
    public $kind_of_donation_id;
    public $main_donor_name;
    public $donation_cash;
    public $type_of_money;
    public $donor;
    public $donation_material;
    public $estimate_cost;
    public $record_by;
}
