<?php

namespace App\Http\Controllers\Backend;

use App\Unit;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UnitResource;
use App\Http\Requests\UnitStoreRequest;
use App\Http\Requests\UnitUpdateRequest;
use App\Http\Resources\UnitResourceCollection;
use App\Http\Resources\Select2\UnitSelect2ResourceCollection;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $units = Unit::withTrashed()->where('package_unit', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')->paginate(5);

        return response()->json(new UnitResourceCollection($units), 200);
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
    public function store(UnitStoreRequest $request)
    {
        try {
            $validated_data = $request->validated();
            $almsRound = Unit::create($validated_data);
            return response()->json(new UnitResource($almsRound), 201);
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
    public function update(UnitUpdateRequest $request, Unit $unit)
    {
        try {
            $validated_data = $request->validated();
            $unit->update($validated_data);
            return response()->json(new UnitResource($unit), 200);
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
    public function destroy(Unit $unit)
    {
        try {
            if ($unit->trashed()) {
                $unit->restore();
            } else {
                $unit->delete();
            }

            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            report($e);
            return response()->json(['message' => 'fail'], 500);
        }
    }

    public function getAllUnits()
    {
        $units = Unit::query();

        $data = $units->orderBy('id', 'desc')->paginate(5);

        return response()->json(new UnitSelect2ResourceCollection($data), 200);
    }
}
