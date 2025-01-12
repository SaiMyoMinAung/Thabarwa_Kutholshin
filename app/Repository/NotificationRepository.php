<?php

namespace App\Repository;

use App\Admin;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendDonatedItemNotiJob;
use App\Repository\DonatedItemRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\DTO\DonatedItemNotiDTO;

class NotificationRepository
{
    public $donatedItemRepo;

    public function __construct(DonatedItemRepository $donatedItemRepo)
    {
        $this->donatedItemRepo = $donatedItemRepo;
    }
    public function donatedItemNotiToAdmins($donated_item_uuid, $office_id = null)
    {
        $donatedItem = $this->donatedItemRepo->findByUUID($donated_item_uuid);

        $notiData = new DonatedItemNotiDTO([
            'url' => route('donated_items.show', $donatedItem->uuid),
            'name' => $donatedItem->donor_name,
            'phone' => $donatedItem->phone,
            'about_item' => $donatedItem->about_item,
        ]);

        $admins = $this->filterAdmins($donatedItem->state_region_id, $office_id);

        if ($admins->first()) {
            $donatedItem->update(['office_id' => $admins->first()->office->id]);
            $donatedItem->offices()->attach($admins->first()->office->id);
        }

        SendDonatedItemNotiJob::dispatch($admins, $notiData);
    }

    public function filterAdmins($state_region_id, $office_id)
    {
        if (!is_null($office_id)) {
            $admins = Admin::where('is_regional_admin', 1)->where('office_id', $office_id)->get();
        } else {
            $admins = Admin::where('is_regional_admin', 1)->whereHas('stateRegion', function (Builder $query) use ($state_region_id) {
                $query->where('state_regions.id', $state_region_id);
            })->get();
        }

        if ($admins->count() === 0) {
            $admins = Admin::where('is_super', 1)->get();
        }

        return $admins;
    }
}
