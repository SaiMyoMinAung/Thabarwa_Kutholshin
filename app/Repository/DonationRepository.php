<?php

namespace App\Repository;

use App\Donation;

class DonationRepository
{
    protected $donation;

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    public function save()
    {
        return true;
    }
}
