<?php

namespace App\Http\Controllers\Backend;

use App\City;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Requests\CityStoreRequest;
use App\Http\Requests\CityUpdateRequest;
use App\Http\Resources\CityResourceCollection;
use App\Http\Resources\Select2\CitySelect2ResourceCollection;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cities = City::withTrashed()->with('stateRegion')->where('name', 'LIKE', "%$request->q%")->orderBy('id', 'desc')->paginate(5);

        return response()->json(new CityResourceCollection($cities), 200);
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
    public function store(CityStoreRequest $request)
    {
        try {
            $validated_data = $request->validated();
            $city = City::create($validated_data);
            return response()->json(new CityResource($city), 201);
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
    public function update(CityUpdateRequest $request, City $city)
    {
        try {
            $validated_data = $request->validated();
            $city->update($validated_data);
            return response()->json(new CityResource($city), 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'fail'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        try {
            if ($city->trashed()) {
                $city->restore();
            } else {
                $city->delete();
            }
            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            report($e);
            return response()->json(['message' => 'fail'], 500);
        }
    }

    public function getAllCities(Request $request)
    {
        $cities = City::where('name', 'LIKE', "%$request->q%")->paginate(5);

        return response()->json(new CitySelect2ResourceCollection($cities), 200);
    }
}
