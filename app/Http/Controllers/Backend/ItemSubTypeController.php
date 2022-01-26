<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\ItemSubType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemSubTypeResource;
use App\Http\Requests\ItemSubTypeStoreRequest;
use App\Http\Requests\ItemSubTypeUpdateRequest;
use App\Http\Resources\ItemSubTypeResourceCollection;
use App\Http\Resources\Select2\ItemSubTypeSelect2ResourceCollection;

class ItemSubTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemSubTypes = ItemSubType::withTrashed()->where('name', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')->paginate(5);

        return response()->json(new ItemSubTypeResourceCollection($itemSubTypes), 200);
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
    public function store(ItemSubTypeStoreRequest $request)
    {
        try {
            $validated_data = $request->validated();
            $itemType = ItemSubType::create($validated_data);
            return response()->json(new ItemSubTypeResource($itemType), 201);
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
    public function update(ItemSubTypeUpdateRequest $request, ItemSubType $itemSubType)
    {
        try {
            $validated_data = $request->validated();
            $itemSubType->update($validated_data);
            return response()->json(new ItemSubTypeResource($itemSubType), 200);
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
    public function destroy(ItemSubType $itemSubType)
    {
        try {
            if ($itemSubType->trashed()) {
                $itemSubType->restore();
            } else {
                $itemSubType->delete();
            }

            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            report($e);
            return response()->json(['message' => 'fail'], 500);
        }
    }

    public function getAllItemSubTypes(Request $request)
    {
        $itemSubTypes = ItemSubType::query();

        if ($request->q) {
            $itemSubTypes->where('name', 'LIKE', '%' . $request->q . '%');
        }

        $data = $itemSubTypes->orderBy('id', 'desc')->paginate(5);

        return response()->json(new ItemSubTypeSelect2ResourceCollection($data), 200);
    }
}
