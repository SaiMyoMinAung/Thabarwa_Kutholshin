<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonationStoreFormRequest;
use App\Repository\DonationRepository;

class DonationController extends Controller
{
    public $donation;

    public function __construct(DonationRepository $donation)
    {
        $this->donation = $donation;
    }

    public function save(DonationStoreFormRequest $request)
    {
        return response()->json($request->donationData()->all(), 200);
    }
}
