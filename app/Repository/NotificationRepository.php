<?php

namespace App\Repository;

use App\Admin;
use App\Repository\DonatedItemRepository;
use App\Http\Requests\DTO\DonatedItemNotiDTO;
use App\Jobs\SendDonatedItemNotiJob;

class NotificationRepository
{
    public $donatedItemRepo;

    public function __construct(DonatedItemRepository $donatedItemRepo)
    {
        $this->donatedItemRepo = $donatedItemRepo;
    }
    public function donatedItemNotiToAdmins($donated_item_uuid)
    {
        $donatedItem = $this->donatedItemRepo->findByUUID($donated_item_uuid);

        $notiData = new DonatedItemNotiDTO([
            'url' => route('donated_items.show', $donatedItem->uuid),
            'name' => $donatedItem->donor_name,
            'phone' => $donatedItem->phone,
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
