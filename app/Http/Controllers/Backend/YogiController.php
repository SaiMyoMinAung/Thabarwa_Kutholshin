<?php

namespace App\Http\Controllers\Backend;

use App\Yogi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\YogiStoreFormRequest;
use App\Http\Requests\YogiUpdateFormRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\Select2\YogiSelect2ResourceCollection;
use App\ViewModels\YogiViewModel;

class YogiController extends Controller
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
                2 => 'phone',
                3 => 'ward',
                4 => 'option',
            );

            $totalData = Yogi::count();

            $limit = $request->input('length');
            $start = $request->input('start');

            $yogis = Yogi::query();

            if (!empty($request->input('search.value'))) {
                $search = $request->input('search.value');

                $yogis->where('yogis.name', 'LIKE', "%{$search}%")
                    ->orWhere('yogis.phone', 'LIKE', "%{$search}%")
                    ->orWhereHas('ward', function (Builder $query) use ($search) {
                        $query->where('wards.name', 'LIKE', "%{$search}%");
                    });
            }

            // sorting
            $dir = $request->input('order.0.dir');
            $order = $columns[$request->input('order.0.column')];
            $order = ($order == 'DT_RowIndex') ? 'created_at' : $order;

            if ($order == 'ward') {
                $yogis->whereHas('ward', function (Builder $query) use ($dir) {
                    $query->orderBy('wards.name', $dir);
                });
            } else {
                $yogis->orderBy($order, $dir);
            }

            // Run The Query
            $yogis = $yogis->offset($start)
                ->limit($limit)
                ->get();

            $totalFiltered = $yogis->count();

            $data = [];
            if (!empty($yogis)) {
                foreach ($yogis as $key => $volunteer) {

                    $edit =  route('yogis.edit', $volunteer->uuid);
                    $delete = route('yogis.destroy', $volunteer->uuid);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['uuid'] = $volunteer->uuid;
                    $nestedData['name'] = $volunteer->name;
                    $nestedData['phone'] = $volunteer->phone ?? '-';
                    $nestedData['ward'] = $volunteer->ward->name . ' (' . $volunteer->ward->center->name . ')'  ?? '-';
                    $nestedData['options'] = "<a class='btn btn-default text-primary' data-uuid=$volunteer->uuid data-toggle='editconfirmation' data-href=$edit><i class='fas fa-edit'></i></a> - ";
                    $nestedData['options'] .= "<a class='btn btn-default text-danger' data-toggle='confirmation' data-href=$delete><i class='fas fa-trash'></i></a>";
                    $nestedData['created_at'] = $volunteer->created_at;
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

        return view('backend.yogi.index');
    }

    public function getAllYogis(Request $request)
    {
        $yogis = auth()->user()->stateRegion
            ->yogis()
            ->where('yogis.name', 'like', '%' . $request->q . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return response()->json(new YogiSelect2ResourceCollection($yogis), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $viewModel = new YogiViewModel();

        return view('backend.yogi.create', $viewModel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(YogiStoreFormRequest $request)
    {
        $yogiData = $request->yogiData()->all();

        Yogi::create($yogiData);

        return redirect(route('yogis.index'))->with('success', 'Create Yogi Successful.');
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
    public function edit(Yogi $yogi)
    {
        $viewModel = new YogiViewModel($yogi, true);

        return view('backend.yogi.create', $viewModel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(YogiUpdateFormRequest $request, Yogi $yogi)
    {
        $yogiData = $request->yogiData()->all();

        $yogi->update($yogiData);

        return redirect(route('yogis.index'))->with('success', 'Update Yogi Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Yogi $yogi)
    {
        $yogi->delete();

        return back()->with('success', 'Delete Yogi Successful');
    }
}
