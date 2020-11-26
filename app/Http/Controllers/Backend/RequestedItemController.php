<?php

namespace App\Http\Controllers\Backend;

use App\DonatedItem;
use App\RequestedItem;
use Illuminate\Http\Request;
use App\Status\RequestableType;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestedItemStoreRequest;
use App\Http\Requests\AssignDeliveredVolunteerStoreRequest;
use App\Http\Resources\DonatedItemManageRequest\RequestedItemResource;
use App\State\ManageRequest\Transition\CompleteToInCompleteTransition;
use App\State\ManageRequest\Transition\CancelToNewRequestStateTransition;
use App\State\ManageRequest\Transition\NewRequestStateToCancelTransition;
use App\State\ManageRequest\Transition\DoneDeliveringToCompleteTransition;
use App\State\ManageRequest\Transition\DeliveringToDoneDeliveringTransition;
use App\Http\Resources\DonatedItemManageRequest\RequestedItemResourceCollection;
use App\Http\Resources\DonatedItemManageRequest\DonatedItemManageRequestResource;
use App\State\ManageRequest\Transition\AssignedOrReassignedToDeliveringTransition;
use App\State\ManageRequest\Transition\AssignedDeliveredVolunteerToReassignedTransition;
use App\State\ManageRequest\Transition\NewRequestStateToAssignedDeliveredVolunteerTransition;

class RequestedItemController extends Controller
{
    public function index($uuid, Request $request)
    {
        $requestedItem = $this->fetchRequestItems($uuid, $request);

        if (!$requestedItem['donated_item']->is_complete) {
            return back()->with('danger', 'You Must Manage To Complete State');
        }

        return view('backend.donated_item.manage_request', compact('requestedItem'));
    }

    public function store(RequestedItemStoreRequest $request, DonatedItem $donated_item)
    {
        $requestedItemData = $request->requestedItemData()->all();
        
        $donated_item->requestedItems()->create($requestedItemData);

        return $this->fetchRequestItems($donated_item->uuid);
    }

    public function fetchRequestItems($uuid)
    {
        $donated_item = DonatedItem::where('uuid', $uuid)->firstOrFail();
        $requested_items = $donated_item->requestedItems()->paginate(5);

        $requestedItem = [
            'donated_item' => new DonatedItemManageRequestResource($donated_item),
            'requested_items' => new RequestedItemResourceCollection($requested_items),
        ];

        return $requestedItem;
    }

    public function fetchRequestableTypes()
    {
        $requestable_types = RequestableType::keys();
        $map_data = array_map(function ($requestable_type) {
            return [
                'id' => $requestable_type,
                'name' => $requestable_type
            ];
        }, $requestable_types);

        return [
            'data' => $map_data
        ];
    }

    public function assignDeliver(RequestedItem $requested_item, AssignDeliveredVolunteerStoreRequest $request)
    {
        if ($requested_item->delivered_volunteer_id == null) {
            $t = new NewRequestStateToAssignedDeliveredVolunteerTransition();
            $requested_item = $t($requested_item);
        } else {
            $t = new AssignedDeliveredVolunteerToReassignedTransition();
            $requested_item = $t($requested_item);
        }

        $assignDeliveredVolunteerData = $request->validated();
        $requested_item->update($assignDeliveredVolunteerData);

        $requested_item = RequestedItem::where('uuid', $requested_item->uuid)->first();

        return response()->json(new RequestedItemResource($requested_item), 200);
    }

    public function changeDeliveringState(RequestedItem $requested_item)
    {
        $t = new AssignedOrReassignedToDeliveringTransition();
        $requested_item = $t($requested_item);

        $requested_item->update([
            'is_delivering' => 1
        ]);

        $requested_item = RequestedItem::where('uuid', $requested_item->uuid)->first();

        return response()->json(new RequestedItemResource($requested_item), 200);
    }

    public function changeDoneDeliveringState(RequestedItem $requested_item)
    {
        $t = new DeliveringToDoneDeliveringTransition();
        $requested_item = $t($requested_item);

        $requested_item->update([
            'is_done_delivering' => 1
        ]);

        $requested_item = RequestedItem::where('uuid', $requested_item->uuid)->first();

        return response()->json(new RequestedItemResource($requested_item), 200);
    }

    public function changeCompleteState(RequestedItem $requested_item)
    {
        $t = new DoneDeliveringToCompleteTransition();
        $requested_item = $t($requested_item);

        $requested_item->update([
            'is_complete' => true
        ]);

        $requested_item = RequestedItem::where('uuid', $requested_item->uuid)->first();

        return response()->json(new RequestedItemResource($requested_item), 200);
    }

    public function changeInCompleteState(RequestedItem $requested_item)
    {
        $t = new CompleteToInCompleteTransition();
        $requested_item = $t($requested_item);

        $requested_item->update([
            'is_complete' => false
        ]);

        $requested_item = RequestedItem::where('uuid', $requested_item->uuid)->first();

        return response()->json(new RequestedItemResource($requested_item), 200);
    }

    public function changeCancelState(RequestedItem $requested_item)
    {
        $t = new NewRequestStateToCancelTransition();
        $requested_item = $t($requested_item);

        $requested_item->update([
            'is_cancel' => true
        ]);

        $requested_item = RequestedItem::where('uuid', $requested_item->uuid)->first();

        return response()->json(new RequestedItemResource($requested_item), 200);
    }

    public function recoverRequestedItem(RequestedItem $requested_item)
    {
        $t = new CancelToNewRequestStateTransition();
        $requested_item = $t($requested_item);

        $requested_item->update([
            'is_cancel' => false
        ]);

        $requested_item = RequestedItem::where('uuid', $requested_item->uuid)->first();

        return response()->json(new RequestedItemResource($requested_item), 200);
    }
}
