<?php

namespace App\Http\Controllers\Backend;

use App\Volunteer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Select2\VolunteerSelect2ResourceCollection;

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
            );

            $totalData = Volunteer::count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if (empty($request->input('search.value'))) {
                $volunteers = Volunteer::offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $search = $request->input('search.value');

                $volunteers =  Volunteer::where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

                $totalFiltered = Volunteer::where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->count();
            }

            $data = array();
            if (!empty($volunteers)) {
                foreach ($volunteers as $key => $volunteer) {
                    $show =  route('volunteers.show', $volunteer->id);
                    $edit =  route('volunteers.edit', $volunteer->id);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['name'] = $volunteer->name;
                    $nestedData['email'] = $volunteer->email ?? '-';
                    $nestedData['phone'] = substr(strip_tags($volunteer->phone), 0, 50) . "...";
                    $nestedData['options'] = "&emsp;<a href='{$show}' title='SHOW' ><i class='fa fa-fw fa-eye'></i></a>
                              &emsp;<a href='{$edit}' title='EDIT' ><i class='fa fa-fw fa-edit'></i></a>";
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllVolunteers(Request $request)
    {

        $volunteers = Volunteer::with(['state_region', 'office'])->where('name', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')->paginate(5);

        return response()->json(new VolunteerSelect2ResourceCollection($volunteers), 200);
    }
}
