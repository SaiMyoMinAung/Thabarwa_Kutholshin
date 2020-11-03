<?php

namespace App\Http\Controllers\Backend;

use App\StateRegion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StateRegionResource;
use App\Http\Requests\StateRegionStoreRequest;
use App\Http\Requests\StateRegionUpdateRequest;
use App\Http\Resources\StateRegionResourceCollection;
use Exception;

class StateRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stateRegions = StateRegion::with('country')->where('name', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')->paginate(5);

        return response()->json(new StateRegionResourceCollection($stateRegions), 200);
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
    public function store(StateRegionStoreRequest $request)
    {
        try {
            $validated_data = $request->validated();
            $stateRegion = StateRegion::create($validated_data);
            return response()->json(new StateRegionResource($stateRegion), 201);
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
    public function update(StateRegionUpdateRequest $request, StateRegion $stateRegion)
    {
        try {
            $validated_data = $request->validated();
            $stateRegion->update($validated_data);
            return response()->json(new StateRegionResource($stateRegion), 200);
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
    public function destroy(StateRegion $stateRegion)
    {
        try {
            $stateRegion->delete();
            return response()->json(new StateRegionResource($stateRegion), 200);
        } catch (Exception $e) {
            report($e);
            return response()->json(['message' => 'fail'], 500);
        }
    }
}
