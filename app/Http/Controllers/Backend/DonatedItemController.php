<?php

namespace App\Http\Controllers\Backend;

use App\DonatedItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonatedItemController extends Controller
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
                1 => 'about_item',
                2 => 'pickedup_at',
                3 => 'pickedup_info',
                4 => 'status'
            );

            $totalData = DonatedItem::count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if (empty($request->input('search.value'))) {
                $donated_items = DonatedItem::offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $search = $request->input('search.value');

                $donated_items =  DonatedItem::where('about_item', 'LIKE', "%{$search}%")
                    ->orWhere('pickedup_at', 'LIKE', "%{$search}%")
                    ->orWhere('pickedup_info', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

                $totalFiltered = DonatedItem::where('about_item', 'LIKE', "%{$search}%")
                    ->orWhere('pickedup_at', 'LIKE', "%{$search}%")
                    ->orWhere('pickedup_info', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%")
                    ->count();
            }

            $data = array();
            if (!empty($donated_items)) {
                foreach ($donated_items as $key => $donated_item) {
                    $show =  route('donated_items.show', $donated_item->id);
                    $edit =  route('donated_items.edit', $donated_item->id);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['about_item'] = $donated_item->about_item;
                    $nestedData['pickedup_at'] = $donated_item->pickedup_at->format('d M Y');
                    $nestedData['pickedup_info'] = substr(strip_tags($donated_item->pickedup_info), 0, 50) . "...";
                    $nestedData['status'] = $donated_item->status;
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

        return view('backend.donated_item.index');
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
}
