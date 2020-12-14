<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfficeResource;
use App\Http\Requests\OfficeStoreRequest;
use App\Http\Requests\OfficeUpdateRequest;
use App\Http\Resources\OfficeResourceCollection;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offices = Office::with('city')->where('name', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')->paginate(5);

        return response()->json(new OfficeResourceCollection($offices), 200);
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
    public function store(OfficeStoreRequest $request)
    {
        try {
            $validated_data = $request->validated();
            $office = Office::create($validated_data);
            return response()->json(new OfficeResource($office), 201);
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
    public function update(OfficeUpdateRequest $request, Office $office)
    {
        try {
            $validated_data = $request->validated();
            $office->update($validated_data);
            return response()->json(new OfficeResource($office), 200);
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
    public function destroy(Office $office)
    {
        try {
            $office->delete();
            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            report($e);
            return response()->json(['message' => 'fail'], 500);
        }
    }
}
