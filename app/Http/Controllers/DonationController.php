<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use App\Repository\DonatedItemRepository;
use App\Http\Requests\DonationStoreFormRequest;

class DonationController extends Controller
{
    public $donatedItem;
    public $user;

    public function __construct(UserRepository $user, DonatedItemRepository $donatedItem)
    {
        $this->donatedItem = $donatedItem;
        $this->user = $user;
    }

    public function save(DonationStoreFormRequest $request)
    {
        $donorData = $request->userData();
        $checkRecord = ['phone' => $donorData->phone];
        $donor = $this->user->updateOrCreateRecord($checkRecord, $donorData->all());

        $donatedItemData = $request->donatedItemData($donor->id)->all();
        $donatedItem = $this->donatedItem->createRecord($donatedItemData);

        if ($donatedItem) {
            return response()->json(['message' => 'success', 'data' => $donatedItem], 200);
        } else {
            return response()->json(['message' => 'error'], 200);
        }
    }
}
