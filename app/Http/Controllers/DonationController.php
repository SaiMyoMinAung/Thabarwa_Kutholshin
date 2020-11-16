<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use App\Repository\DonatedItemRepository;
use App\Repository\NotificationRepository;
use App\Http\Requests\DonationStoreFormRequest;
use Exception;

class DonationController extends Controller
{
    public $donatedItem;
    public $user;
    public $notiRepo;

    public function index()
    {
        return view('donate.donate');
    }

    public function __construct(UserRepository $user, DonatedItemRepository $donatedItem, NotificationRepository $notiRepo)
    {
        $this->donatedItem = $donatedItem;
        $this->user = $user;
        $this->notiRepo = $notiRepo;
    }

    public function save(DonationStoreFormRequest $request)
    {
        $donorData = $request->userData();
        $checkRecord = ['phone' => $donorData->phone];
        $donor = $this->user->updateOrCreateRecord($checkRecord, $donorData->all());

        $donatedItemData = $request->donatedItemData($donor->id)->all();
        $donatedItem = $this->donatedItem->createRecord($donatedItemData);
        
        try {
            $this->notiRepo->donatedItemNotiToAdmins($donor->uuid, $donatedItem->uuid);
        } catch (Exception $e) {
            report($e);
        }

        if ($donatedItem) {
            return response()->json(['message' => 'success', 'data' => $donatedItem], 200);
        } else {
            return response()->json(['message' => 'error'], 200);
        }
    }
}
