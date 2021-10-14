<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\AlmsRound;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemTypeResource;
use App\Http\Resources\AlmsRoundResource;
use App\Http\Requests\AlmsRoundStoreRequest;
use App\Http\Requests\AlmsRoundUpdateRequest;
use App\Http\Resources\AlmsRoundResourceCollection;

class AlmsRoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $almsRounds = AlmsRound::withTrashed()->where('name', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')->paginate(5);

        return response()->json(new AlmsRoundResourceCollection($almsRounds), 200);
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
    public function store(AlmsRoundStoreRequest $request)
    {
        try {
            $validated_data = $request->validated();
            $almsRound = AlmsRound::create($validated_data);
            return response()->json(new AlmsRoundResource($almsRound), 201);
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
    public function update(AlmsRoundUpdateRequest $request, AlmsRound $almsRound)
    {
        try {
            $validated_data = $request->validated();
            $almsRound->update($validated_data);
            return response()->json(new ItemTypeResource($almsRound), 200);
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
    public function destroy(AlmsRound $almsRound)
    {
        try {
            if ($almsRound->trashed()) {
                $almsRound->restore();
            } else {
                $almsRound->delete();
            }

            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            report($e);
            return response()->json(['message' => 'fail'], 500);
        }
    }

    public function getAllAlmsRound()
    {
        $data = AlmsRound::where('center_id', auth()->user()->center->id)
            ->orderBy('id', 'desc')->paginate(5);

        return response()->json(new AlmsRoundResourceCollection($data), 200);
    }
}
