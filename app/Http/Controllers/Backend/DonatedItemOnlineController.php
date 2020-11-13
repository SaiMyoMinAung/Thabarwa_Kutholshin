<?php

namespace App\Http\Controllers\Backend;

use App\DonatedItem;
use App\Http\Controllers\Controller;
use App\State\Online\IncompleteState;
use App\State\Online\NotRequiredRepairState;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\AssignDriverStoreRequest;
use App\Http\Requests\AssignDeliverStoreRequest;
use App\Http\Requests\AssignRepairerStoreRequest;
use App\Http\Requests\AssignStoreKeeperStoreRequest;
use App\Http\Resources\DonatedItem\DonatedItemResource;
use App\State\Online\Transition\RequiredRepairTransition;
use App\State\Online\Transition\NotRequiredRepairTransition;
use App\State\Online\Transition\CompleteToIncompleteTransition;
use App\State\Online\Transition\IncompleteToCompleteTransition;
use App\State\Online\Transition\StoringToDoneStoringTransition;
use App\State\Online\Transition\DoneRepairingToCompleteTransition;
use App\State\Online\Transition\PickingUpToDonePickingUpTransition;
use App\State\Online\Transition\RepairingToDoneRepairingTransition;
use App\State\Online\Transition\ConfirmedToAssignedDriverTransition;
use App\State\Online\Transition\DeliveringToDoneDeliveringTransition;
use App\State\Online\Transition\NotRequiredRepairToCompleteTransition;
use App\State\Online\Transition\AssignedOrReassignedToStoringTransition;
use App\State\Online\Transition\DoneRepairedToAssignedDeliverTransition;
use App\State\Online\Transition\DoneStoringToAssignedRepairerTransition;
use App\State\Online\Transition\AssignedOrReassignToDeliveringTransition;
use App\State\Online\Transition\AssignedOrReassignedToPickingUpTransition;
use App\State\Online\Transition\AssignedOrReassignedToRepairingTransition;
use App\State\Online\Transition\AssignedDriverToReassignedDriverTransition;
use App\State\Online\Transition\RequiredRepairToAssignedRepairerTransition;
use App\State\Online\Transition\AssignedDeliverToReassignedDeliverTransition;
use App\State\Online\Transition\DonePickingupToAssignedStoreKeeperTransition;
use App\State\Online\Transition\NotRequiredRepairToAssignedDeliverTransition;
use App\State\Online\Transition\AssignedRepairerToReassignedRepairerTransition;
use App\State\Online\Transition\AssignedStoreKeeperToReassignedStoreKeeperTransition;

class DonatedItemOnlineController extends Controller
{
    public function assignDriver(AssignDriverStoreRequest $request, DonatedItem $donatedItem)
    {
        if ($donatedItem->pickedup_volunteer_id == null) {
            $t = new ConfirmedToAssignedDriverTransition();
            $donatedItem = $t($donatedItem);
        } else {
            $t = new AssignedDriverToReassignedDriverTransition();
            $donatedItem = $t($donatedItem);
        }

        $assignDriverData = $request->assignDriverData()->all();
        $donatedItem->update($assignDriverData);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }

    public function changePickingupState(DonatedItem $donatedItem)
    {
        $t = new AssignedOrReassignedToPickingUpTransition();
        $donatedItem = $t($donatedItem);

        $donatedItem->update([
            'is_pickingup' => 1
        ]);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }

    public function changeDonePickingupState(DonatedItem $donatedItem)
    {
        $t = new PickingUpToDonePickingUpTransition();
        $donatedItem = $t($donatedItem);

        $donatedItem->update([
            'is_done_pickingup' => 1
        ]);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }

    public function assignStoreKeeper(AssignStoreKeeperStoreRequest $request, DonatedItem $donatedItem)
    {
        if ($donatedItem->store_keeper_volunteer_id == null) {
            $t = new DonePickingupToAssignedStoreKeeperTransition();
            $donatedItem = $t($donatedItem);
        } else {
            $t = new AssignedStoreKeeperToReassignedStoreKeeperTransition();
            $donatedItem = $t($donatedItem);
        }

        $assignStoreKeeperData = $request->assignStoreKeeperData()->all();
        $donatedItem->update($assignStoreKeeperData);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }

    public function changeStoringState(DonatedItem $donatedItem)
    {
        $t = new AssignedOrReassignedToStoringTransition();
        $donatedItem = $t($donatedItem);

        $donatedItem->update([
            'is_storing' => 1
        ]);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }

    public function changeDoneStoringState(DonatedItem $donatedItem)
    {
        $t = new StoringToDoneStoringTransition();
        $donatedItem = $t($donatedItem);

        $donatedItem->update([
            'is_done_storing' => 1
        ]);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }

    public function requiredRepair(DonatedItem $donatedItem, Request $request)
    {
        if ($request->required) {
            $t = new RequiredRepairTransition();
            $donatedItem = $t($donatedItem);
        } else {
            $t = new NotRequiredRepairTransition();
            $donatedItem = $t($donatedItem);
        }

        $donatedItem->update([
            'is_required_repairing' => (bool) $request->required
        ]);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }

    public function assignRepairer(AssignRepairerStoreRequest $request, DonatedItem $donatedItem)
    {
        if ($donatedItem->repaired_volunteer_id == null) {
            $t = new DoneStoringToAssignedRepairerTransition();
            $donatedItem = $t($donatedItem);
        } else {
            $t = new AssignedRepairerToReassignedRepairerTransition();
            $donatedItem = $t($donatedItem);
        }


        $assignRepairerData = $request->assignRepairerData()->all();
        $donatedItem->update($assignRepairerData);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }

    public function changeRepairingState(DonatedItem $donatedItem)
    {
        $t = new AssignedOrReassignedToRepairingTransition();
        $donatedItem = $t($donatedItem);

        $donatedItem->update([
            'is_repairing' => 1
        ]);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }
    public function changeDoneRepairingState(DonatedItem $donatedItem)
    {
        $t = new RepairingToDoneRepairingTransition();
        $donatedItem = $t($donatedItem);

        $donatedItem->update([
            'is_done_repairing' => 1
        ]);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }

    public function assignComplete(DonatedItem $donatedItem)
    {
        if ($donatedItem->state_class == get_class(new IncompleteState($donatedItem))) {
            $t = new IncompleteToCompleteTransition();
            $donatedItem = $t($donatedItem);
        } elseif ($donatedItem->state_class == get_class(new NotRequiredRepairState($donatedItem))) {
            $t = new NotRequiredRepairToCompleteTransition();
            $donatedItem = $t($donatedItem);
        } else {
            $t = new DoneRepairingToCompleteTransition();
            $donatedItem = $t($donatedItem);
        }

        $donatedItem->update([
            'is_complete' => 1
        ]);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }

    public function assignIncomplete(DonatedItem $donatedItem)
    {
        $t = new CompleteToIncompleteTransition();
        $donatedItem = $t($donatedItem);

        $donatedItem->update([
            'is_complete' => 0
        ]);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }

    public function assignDeliver(AssignDeliverStoreRequest $request, DonatedItem $donatedItem)
    {
        if ($donatedItem->is_required_repairing) {
            if ($donatedItem->delivered_volunteer_id == null) {
                $t = new DoneRepairedToAssignedDeliverTransition();
                $donatedItem = $t($donatedItem);
            } else {
                $t = new AssignedDeliverToReassignedDeliverTransition();
                $donatedItem = $t($donatedItem);
            }
        }

        $assignDeliverData = $request->assignDeliverData()->all();
        $donatedItem->update($assignDeliverData);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }

    public function changeDeliveringState(DonatedItem $donatedItem)
    {
        $t = new AssignedOrReassignToDeliveringTransition();
        $donatedItem = $t($donatedItem);

        $donatedItem->update([
            'is_delivering' => 1
        ]);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }
    public function changeDoneDeliveringState(DonatedItem $donatedItem)
    {
        $t = new DeliveringToDoneDeliveringTransition();
        $donatedItem = $t($donatedItem);

        $donatedItem->update([
            'is_done_delivering' => 1
        ]);

        $donatedItem = DonatedItem::where('uuid', $donatedItem->uuid)->first();

        return response()->json(new DonatedItemResource($donatedItem), 200);
    }
}
