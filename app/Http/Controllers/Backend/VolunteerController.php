<?php

namespace App\Http\Controllers\Backend;

use App\Volunteer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\VolunteerStoreFormRequest;
use App\Http\Requests\VolunteerUpdateFormRequest;
use App\Http\Resources\Select2\VolunteerSelect2ResourceCollection;
use App\ViewModels\VolunteerViewModel;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $columns = array(
                0 => 'id',
                1 => 'name',
                2 => 'email',
                3 => 'phone',
                4 => 'office',
                5 => 'option',
            );

            $totalData = Volunteer::count();

            $limit = $request->input('length');
            $start = $request->input('start');

            $volunteers = Volunteer::query();

            if (!empty($request->input('search.value'))) {
                $search = $request->input('search.value');

                $volunteers->where('volunteers.name', 'LIKE', "%{$search}%")
                    ->orWhere('volunteers.email', 'LIKE', "%{$search}%")
                    ->orWhere('volunteers.phone', 'LIKE', "%{$search}%")
                    ->orWhereHas('city', function (Builder $query) use ($search) {
                        $query->where('cities.name', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('office', function (Builder $query) use ($search) {
                        $query->where('offices.name', 'LIKE', "%{$search}%");
                    });
            }

            // sorting
            $dir = $request->input('order.0.dir');
            $order = $columns[$request->input('order.0.column')];
            $order = ($order == 'DT_RowIndex') ? 'created_at' : $order;

            if ($order == 'office') {
                $volunteers->select('volunteers.*')->join('offices', 'volunteers.office_id', '=', 'offices.id')
                    ->orderBy('offices.name', $dir);
            } else {
                $volunteers->orderBy($order, $dir);
            }

            // Add Data Filter By City
            $volunteers->whereHas('city', function (Builder $query) {
                $query->where('cities.id', auth()->user()->city->id);
            });

            // Run The Query
            $volunteers = $volunteers->offset($start)
                ->limit($limit)
                ->get();

            $totalFiltered = $volunteers->count();

            $data = [];
            if (!empty($volunteers)) {
                foreach ($volunteers as $key => $volunteer) {

                    $edit =  route('volunteers.edit', $volunteer->uuid);
                    $delete = route('volunteers.destroy', $volunteer->uuid);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['uuid'] = $volunteer->uuid;
                    $nestedData['name'] = $volunteer->name;
                    $nestedData['email'] = $volunteer->email ?? '-';
                    $nestedData['phone'] = $volunteer->phone;
                    $nestedData['office'] = $volunteer->office->name . ' (' . $volunteer->city->name . ')'  ?? '-';
                    $nestedData['options'] = "<a class='btn btn-default text-primary' data-uuid=$volunteer->uuid data-toggle='editconfirmation' data-href=$edit><i class='fas fa-edit'></i></a> - ";
                    $nestedData['options'] .= "<a class='btn btn-default text-danger' data-toggle='confirmation' data-href=$delete><i class='fas fa-trash'></i></a>";
                    $data[] = $nestedData;
                }
            }

            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );

            return $json_data;
        }

        return view('backend.volunteer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $viewModel = new VolunteerViewModel();

        return view('backend.volunteer.create', $viewModel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VolunteerStoreFormRequest $request)
    {
        $data = $request->volunteerData()->all();

        $jobData = $request->volunteerJobData();
        
        $volunteer = Volunteer::create($data);

        $volunteer = $volunteer->fresh();

        $volunteer->volunteerJobs()->sync($jobData);
        
        return redirect(route('volunteers.index'))->with('success', 'Create Volunteer Successful.');
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
    public function edit(Volunteer $volunteer)
    {
        $viewModel = new VolunteerViewModel($volunteer, true);

        return view('backend.volunteer.create', $viewModel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VolunteerUpdateFormRequest $request, Volunteer $volunteer)
    {
        $data = $request->volunteerData()->all();

        $jobData = $request->volunteerJobData();

        $volunteer->update($data);

        $volunteer->volunteerJobs()->sync($jobData);

        return redirect(route('volunteers.index'))->with('success', 'Update Volunteer Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();

        return back()->with('success', 'Delete Volunteer Successful.');
    }

    public function getAllVolunteers(Request $request)
    {
        $volunteers = Volunteer::with(['state_region', 'office'])->where('name', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')->paginate(5);

        return response()->json(new VolunteerSelect2ResourceCollection($volunteers), 200);
    }

    public function getDriverVolunteers(Request $request)
    {
        $volunteers = auth()->user()->office->volunteers()
            ->where('name', 'like', '%' . $request->q . '%')
            ->whereHas('volunteerJobs', function (Builder $query) {
                $query->where('name', JOB_DRIVER);
            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return response()->json(new VolunteerSelect2ResourceCollection($volunteers), 200);
    }

    public function getStoreKeeperVolunteers(Request $request)
    {
        $volunteers = auth()->user()->office->volunteers()
            ->where('name', 'like', '%' . $request->q . '%')
            ->whereHas('volunteerJobs', function (Builder $query) {
                $query->where('name', JOB_STORE_KEEPER);
            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return response()->json(new VolunteerSelect2ResourceCollection($volunteers), 200);
    }

    public function getRepairerVolunteers(Request $request)
    {
        $volunteers = auth()->user()->office->volunteers()
            ->where('name', 'like', '%' . $request->q . '%')
            ->whereHas('volunteerJobs', function (Builder $query) {
                $query->where('name', JOB_REPAIRER);
            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return response()->json(new VolunteerSelect2ResourceCollection($volunteers), 200);
    }

    public function getDeliveredVolunteers(Request $request)
    {
        $volunteers = auth()->user()->office->volunteers()
            ->where('name', 'like', '%' . $request->q . '%')
            ->whereHas('volunteerJobs', function (Builder $query) {
                $query->where('name', JOB_DELIVER);
            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return response()->json(new VolunteerSelect2ResourceCollection($volunteers), 200);
    }
}
