<?php

namespace App\Repository;

use App\Admin;
use Illuminate\Support\Str;
use App\Repository\UserRepository;
use App\Repository\DonatedItemRepository;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\DTO\DonatedItemNotiDTO;
use App\Jobs\SendDonatedItemNoti;
use App\Jobs\SendDonatedItemNotiJob;
use App\Notifications\DonatedItemNotification;
use Exception;

class NotificationRepository
{
    public $userRepo;
    public $donatedItemRepo;

    public function __construct(UserRepository $userRepo, DonatedItemRepository $donatedItemRepo)
    {
        $this->userRepo = $userRepo;
        $this->donatedItemRepo = $donatedItemRepo;
    }
    public function donatedItemNotiToAdmins($donor_uuid, $donated_item_uuid)
    {
        $donor = $this->userRepo->findByUUID($donor_uuid);
        $donatedItem = $this->donatedItemRepo->findByUUID($donated_item_uuid);

        $notiData = new DonatedItemNotiDTO([
            'url' => route('donated_items.show', $donatedItem->uuid),
            'name' => $donor->name,
            'phone' => $donor->phone,
            'about_item' => $donatedItem->about_item,
        ]);

        $admins = $this->filterAdmins($donatedItem->state_region_id);

        SendDonatedItemNotiJob::dispatch($admins, $notiData);
    }

    public function filterAdmins($state_region_id)
    {
        $admins = Admin::where('state_region_id', $state_region_id)->get();

        if ($admins->count() === 0) {
            $admins = Admin::where('is_main', 1)->get();
        }

        return $admins;
    }
}
