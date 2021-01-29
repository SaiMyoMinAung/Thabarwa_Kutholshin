<?php

namespace App\Http\Controllers\Backend;

use App\InternalDonatedItem;
use Illuminate\Http\Request;
use App\InternalRequestedItem;
use App\Http\Controllers\Controller;
use App\Status\InternalDonatedItemStatus;
use App\Http\Requests\InternalRequestedItemsStoreFormRequest;
use App\Http\Resources\InternalRequestItemResourceCollection;
use App\Http\Resources\InternalDonatedItem\InternalDonatedItemResource;

class InternalRequestedItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InternalDonatedItem $internalDonatedItem, Request $request)
    {
        $internalRequestItems = $internalDonatedItem->internalRequestedItems()->orderBy('id', 'desc')->paginate(5);

        return response()->json(new InternalRequestItemResourceCollection($internalRequestItems), 200);
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
    public function store(InternalRequestedItemsStoreFormRequest $request, InternalDonatedItem $internalDonatedItem)
    {
        $data = $request->internalRequestedItemData()->all();

        $internalDonatedItem->internalRequestedItems()->create($data);

        $internalDonatedItem->changeCompleteStatus();

        return response()->json(new InternalDonatedItemResource($internalDonatedItem), 200);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(InternalDonatedItem $internalDonatedItem, InternalRequestedItem $internalRequestedItem)
    {
        if ($internalDonatedItem->status != InternalDonatedItemStatus::advanceSearch('Complete')["code"]) {
            $internalRequestedItem->delete();
            return response()->json(true, 200);
        } else {
            return response()->json(false, 403);
        }
    }
}
