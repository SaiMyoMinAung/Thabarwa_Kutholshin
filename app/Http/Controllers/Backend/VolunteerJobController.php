<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\VolunteerJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VolunteerJobResource;
use App\Http\Requests\VolunteerJobStoreRequest;
use App\Http\Requests\VolunteerJobUpdateRequest;
use App\Http\Resources\VolunteerJobResourceCollection;

class VolunteerJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $volunteerJobs = VolunteerJob::withTrashed()->where('name', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')->paginate(5);

        return response()->json(new VolunteerJobResourceCollection($volunteerJobs), 200);
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
    public function store(VolunteerJobStoreRequest $request)
    {
        try {
            $validated_data = $request->validated();
            $volunteerJobs = VolunteerJob::create($validated_data);
            return response()->json(new VolunteerJobResource($volunteerJobs), 201);
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
    public function update(VolunteerJobUpdateRequest $request, VolunteerJob $volunteerJob)
    {
        try {
            $validated_data = $request->validated();
            $volunteerJob->update($validated_data);
            return response()->json(new VolunteerJobResource($volunteerJob), 200);
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
    public function destroy(VolunteerJob $volunteerJob)
    {
        try {
            if ($volunteerJob->trashed()) {
                $volunteerJob->restore();
            } else {
                $volunteerJob->delete();
            }

            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            report($e);
            return response()->json(['message' => 'fail'], 500);
        }
    }
}
