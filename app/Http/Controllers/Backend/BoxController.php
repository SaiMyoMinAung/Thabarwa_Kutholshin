<?php

namespace App\Http\Controllers\Backend;

use App\Box;
use Exception;
use Illuminate\Http\Request;
use App\Http\Resources\BoxResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\BoxStoreRequest;
use App\Http\Requests\BoxUpdateRequest;
use App\Http\Resources\BoxResourceCollection;
use App\Http\Resources\Select2\BoxSelect2ResourceCollection;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $boxes = Box::withTrashed()->with('store')->where('name', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')->paginate(5);

        return response()->json(new BoxResourceCollection($boxes), 200);
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
    public function store(BoxStoreRequest $request)
    {
        try {
            $validated_data = $request->validated();
            $box = Box::create($validated_data);
            return response()->json(new BoxResource($box), 201);
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
    public function update(BoxUpdateRequest $request, Box $box)
    {
        try {
            $validated_data = $request->validated();
            $box->update($validated_data);
            return response()->json(new BoxResource($box), 200);
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
    public function destroy(Box $box)
    {
        try {
            if ($box->trashed()) {
                $box->restore();
            } else {
                $box->delete();
            }
            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            report($e);
            return response()->json(['message' => 'fail'], 500);
        }
    }

    public function getBoxesOfAuth(Request $request)
    {
        $boxes = auth()->user()->office->boxes()
            ->where('boxes.name', 'like', '%' . $request->q . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return response()->json(new BoxSelect2ResourceCollection($boxes), 200);
    }
}
