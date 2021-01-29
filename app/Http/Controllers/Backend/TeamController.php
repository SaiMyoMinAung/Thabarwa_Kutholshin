<?php

namespace App\Http\Controllers\Backend;

use App\Team;
use Illuminate\Http\Request;
use App\ViewModels\TeamModel;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\TeamStoreFormRequest;
use App\Http\Requests\TeamUpdateFormRequest;
use App\Http\Resources\DonatedItemManageRequest\TeamResource;
use App\Http\Resources\Select2\TeamSelect2ResourceCollection;

class TeamController extends Controller
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
                0 => 'DT_RowIndex',
                1 => 'name',
                2 => 'email',
                3 => 'phone',
                4 => 'center',
                5 => 'option'
            );

            $totalData = Team::count();

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $order = ($order == 'DT_RowIndex') ? 'created_at' : $order;
            $dir = $request->input('order.0.dir');

            $teams = Team::query();

            if (!empty($request->input('search.value'))) {
                $search = $request->input('search.value');

                $teams->where('teams.name', 'LIKE', "%{$search}%")
                    ->orWhere('teams.email', 'LIKE', "%{$search}%")
                    ->orWhere('teams.phone', 'LIKE', "%{$search}%")
                    ->orWhereHas('city', function (Builder $query) use ($search) {
                        $query->where('cities.name', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('center', function (Builder $query) use ($search) {
                        $query->where('centers.name', 'LIKE', "%{$search}%");
                    });
            }

            // sorting
            if ($order == 'center') {
                $teams->select('teams.*')->join('centers', 'teams.center_id', '=', 'centers.id')
                    ->orderBy('centers.name', $dir);
            } else {
                $teams->orderBy($order, $dir);
            }

            // Add Data Filter By City
            // Need To Do Query.It doesn't work completely
            // $teams->whereHas('city', function (Builder $query) {
            //     $query->where('cities.id', auth()->user()->city->id);
            // });

            // Run The Query
            $teams = $teams->offset($start)
                ->limit($limit)
                ->get();

            $totalFiltered = $teams->count();

            $data = [];
            if (!empty($teams)) {
                foreach ($teams as $key => $team) {

                    $edit =  route('teams.edit', $team->uuid);
                    $delete = route('teams.destroy', $team->uuid);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['uuid'] = $team->uuid;
                    $nestedData['name'] = $team->name;
                    $nestedData['email'] = $team->email ?? '-';
                    $nestedData['phone'] = $team->phone;
                    $nestedData['office'] = $team->center->name . ' (' . $team->city->name . ')'  ?? '-';
                    $nestedData['options'] = "<a class='btn btn-default text-primary' data-uuid=$team->uuid data-toggle='editconfirmation' data-href=$edit><i class='fas fa-edit'></i></a> - ";
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

        return view('backend.team.index');
    }

    public function getAllTeams(Request $request)
    {
        $teams = Team::where('teams.name', 'like', '%' . $request->q . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return response()->json(new TeamSelect2ResourceCollection($teams), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teamModel = new TeamModel();

        return view('backend.team.create', $teamModel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamStoreFormRequest $request)
    {
        $data = $request->teamData()->all();

        $team = Team::create($data);

        if (Request()->ajax()) {
            return response()->json(new TeamResource($team), 200);
        }

        return redirect(route('teams.index'))->with('success', 'Create Team Successful.');
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
    public function edit(Team $team)
    {
        $teamModel = new TeamModel($team, true);

        return view('backend.team.create', $teamModel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamUpdateFormRequest $request, Team $team)
    {
        $data = $request->teamData()->all();

        $team->update($data);

        return redirect(route('teams.index'))->with('success', 'Update Team Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return back()->with('success', 'Delete Team Successful.');
    }
}
