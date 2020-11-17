<?php

namespace App\Http\Controllers;

use App\Repository\DonatedItemRepository;
use App\Repository\NotificationRepository;
use App\Http\Requests\DonationStoreFormRequest;
use Exception;

class DonationController extends Controller
{
    public $donatedItem;
    public $notiRepo;

    public function index()
    {
        return view('donate.donate');
    }

    public function __construct(DonatedItemRepository $donatedItem, NotificationRepository $notiRepo)
    {
        $this->donatedItem = $donatedItem;
        $this->notiRepo = $notiRepo;
    }

    public function save(DonationStoreFormRequest $request)
    {
        $donatedItemData = $request->donatedItemData()->all();

        $donatedItem = $this->donatedItem->createRecord($donatedItemData);

        try {
            $this->notiRepo->donatedItemNotiToAdmins($donatedItem->uuid);
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
