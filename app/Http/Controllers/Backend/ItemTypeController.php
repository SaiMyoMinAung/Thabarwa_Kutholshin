<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\ItemType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemTypeResource;
use App\Status\InternalDonatedItemStatus;
use App\Http\Requests\ItemTypeStoreRequest;
use App\Http\Requests\ItemTypeUpdateRequest;
use App\Http\Resources\ItemTypeResourceCollection;
use App\Http\Resources\Select2\ItemTypeSelect2ResourceCollection;

class ItemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemTypes = ItemType::withTrashed()->where('name', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')->paginate(5);

        return response()->json(new ItemTypeResourceCollection($itemTypes), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemTypeStoreRequest $request)
    {
        try {
            $validated_data = $request->validated();
            $itemType = ItemType::create($validated_data);
            return response()->json(new ItemTypeResource($itemType), 201);
        } catch (Exception $e) {
            report($e);
            return response()->json(['message' => 'fail'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemTypeUpdateRequest $request, ItemType $itemType)
    {
        try {
            $validated_data = $request->validated();
            $itemType->update($validated_data);
            return response()->json(new ItemTypeResource($itemType), 200);
        } catch (Exception $e) {
            report($e);
            return response()->json(['message' => 'fail'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemType $itemType)
    {
        try {
            if ($itemType->trashed()) {
                $itemType->restore();
            } else {
                $itemType->delete();
            }

            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            report($e);
            return response()->json(['message' => 'fail'], 500);
        }
    }

    public function getAllItemTypes(Request $request)
    {
        $itemTypes = ItemType::where('name', 'LIKE', '%' . $request->q . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return response()->json(new ItemTypeSelect2ResourceCollection($itemTypes), 200);
    }

    public function getStoreList()
    {
        // expected format
        // $data = [
        //     [
        //         'item_type' => 'Biscuit',
        //         'count' => 2,
        //         'item_sub_type' => [
        //             [
        //                 'name' => 'Shwe Biscuit',
        //                 'count' => '3'
        //             ],
        //             [
        //                 'name' => 'Mya Biscuit',
        //                 'count' => '4'
        //             ]
        //         ]
        //     ]
        // ];

        $office_id = auth()->user()->office->id;
        $available_status = InternalDonatedItemStatus::AVAILABLE()->getValue();
        $available_code = InternalDonatedItemStatus::advanceSearch($available_status);

        $storeList = ItemType::withCount(['internalDonatedItems' => function ($q) use ($office_id, $available_code) {
            $q->where('office_id', $office_id)->where('status', $available_code['code']);
        }])->with(['itemSubTypes' => function ($q) use ($office_id, $available_code) {
            $q->with([
                'sharedInternalDonatedItems',
                'internalDonatedItems' => function ($q) use ($office_id, $available_code) {
                    $q->where('office_id', $office_id)->where('status', $available_code['code']);
                }
            ]);
        }])->get()->map(function ($item, $key) {

            $storeList =  [
                'item_type' => $item->name,
                'count' => $item->internal_donated_items_count
            ];

            $itemSub = [];
            foreach ($item->itemSubTypes as $key => $itemSubType) {

                $sharedSockets = $itemSubType->sharedInternalDonatedItems->sum(function ($item) {
                    return $item->socket_qty;
                });

                $itemSub[$key] = [
                    'name' => $itemSubType->name,
                    'count' => $itemSubType->internalDonatedItems->sum(function ($item) {
                        return ($item->package_qty * $item->socket_per_package) + $item->socket_qty;
                    }) - $sharedSockets
                ];
            }

            $storeList['item_sub_type'] = $itemSub;

            return $storeList;
        });

        return response()->json($storeList, 200);
    }
}
