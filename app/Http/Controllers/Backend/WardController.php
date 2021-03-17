<?php

namespace App\Http\Controllers\Backend;

use App\Ward;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WardResource;
use App\Http\Requests\WardStoreRequest;
use App\Http\Requests\WardUpdateRequest;
use App\Http\Resources\WardResourceCollection;
use App\Http\Resources\Select2\WardSelect2ResourceCollection;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $wards = Ward::withTrashed()->with('center')->where('name', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')->paginate(5);

        return response()->json(new WardResourceCollection($wards), 200);
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
    public function store(WardStoreRequest $request)
    {
        try {
            $validated_data = $request->validated();
            $ward = Ward::create($validated_data);
            return response()->json(new WardResource($ward), 201);
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
    public function update(WardUpdateRequest $request, Ward $ward)
    {
        try {
            $validated_data = $request->validated();
            $ward->update($validated_data);
            return response()->json(new WardResource($ward), 200);
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
    public function destroy(Ward $ward)
    {
        try {
            if ($ward->trashed()) {
                $ward->restore();
            } else {
                $ward->delete();
            }

            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            report($e);
            return response()->json(['message' => 'fail'], 500);
        }
    }

    public function getAllWards(Request $request)
    {
        $wards = auth()->user()->center->wards()->paginate(5);

        return response()->json(new WardSelect2ResourceCollection($wards), 200);
    }
}
