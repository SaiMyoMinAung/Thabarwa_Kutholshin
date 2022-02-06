<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Center;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CenterResource;
use App\Http\Requests\CenterStoreRequest;
use App\Http\Requests\CenterUpdateRequest;
use App\Http\Resources\CenterResourceCollection;
use App\Http\Resources\Select2\CenterSelect2ResourceCollection;

class CenterController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Center::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $centers = Center::withTrashed()->with('city')->where('name', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')->paginate(5);

        return response()->json(new CenterResourceCollection($centers), 200);
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
    public function store(CenterStoreRequest $request)
    {
        try {
            $validated_data = $request->validated();
            $center = Center::create($validated_data);
            return response()->json(new CenterResource($center), 201);
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
    public function update(CenterUpdateRequest $request, Center $center)
    {
        try {
            $validated_data = $request->validated();
            $center->update($validated_data);
            return response()->json(new CenterResource($center), 200);
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
    public function destroy(Center $center)
    {
        try {
            if ($center->trashed()) {
                $center->restore();
            } else {
                $center->delete();
            }
            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            report($e);
            return response()->json(['message' => 'fail'], 500);
        }
    }

    public function getAllCenters(Request $request)
    {
        $centers = Center::where('name', 'LIKE', "%$request->q%")->paginate(5);

        return response()->json(new CenterSelect2ResourceCollection($centers), 200);
    }
}
