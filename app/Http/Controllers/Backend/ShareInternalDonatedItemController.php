<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\ShareInternalDonatedItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShareInternalDonatedItemStoreFormRequest;
use App\Http\Requests\ShareInternalDonatedItemUpdateFormRequest;
use App\Http\Resources\InternalDonatedItem\ShareInternalDonatedItemResource;

class ShareInternalDonatedItemController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ShareInternalDonatedItem::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            // $columns = array(
            //     0 => 'DT_RowIndex',
            //     1 => 'date',
            //     2 => 'item_type_name',
            //     3 => 'item_sub_type_name',
            //     4 => 'sacket_qty',
            //     5 => 'by_admin'
            // );

            $totalData = ShareInternalDonatedItem::count();

            $totalFiltered = $totalData;

            // $limit = $request->input('length');
            // $start = $request->input('start');
            // $order = $columns[$request->input('order.0.column')];
            // $order = ($order == 'DT_RowIndex') ? 'created_at' : $order;
            // $dir = $request->input('order.0.dir');

            $share_internal_requests = ShareInternalDonatedItem::query();

            $share_internal_requests->filterByOffice();

            // if (!empty($request->input('search.value'))) {

            //     $search = $request->input('search.value');

            //     $share_internal_requests =  $share_internal_requests->where(function ($q) use ($search) {
            //         return $q->where('package_qty', 'LIKE', "%{$search}%")
            //             ->orWhere('sacket_qty', 'LIKE', "%{$search}%")
            //             ->orWhere('date', 'LIKE', "%{$search}%")
            //             ->orWhereHasMorph('requestable', ['*'], function (Builder $query) use ($search) {
            //                 $query->where('name', 'LIKE', "%{$search}%");
            //             })
            //             ->orWhereHas('admin', function (Builder $query) use ($search) {
            //                 $query->where('admins.name', 'LIKE', "%{$search}%");
            //             });
            //     });
            // }

            // start sorting
            // if ($order === 'date') {
            //     $share_internal_requests = $share_internal_requests->orderBy($order, $dir);
            // }
            // end sorting

            // $totalFiltered = $share_internal_requests->count();

            // $share_internal_requests = $share_internal_requests->offset($start)
            //     ->limit($limit)
            //     ->get();

            $data = array();

            $nowDate = Carbon::now()->format('Y-m-d');
            $share_internal_requests = $share_internal_requests->with('requestable')->whereDate('date', $nowDate)->get();

            $groups = $share_internal_requests->groupBy(['date', 'requestable.name']);

            $data = [];

            if (!empty($groups)) {

                foreach ($groups as $date => $item) {
                    $nestedData['date'] = $date;

                    foreach ($item as $name => $items) {
                        $nestedData['name'] = $name;
                        $nestedData['count'] = count($items);
                        foreach ($items as $key => $record) {
                            $nestedData['id'] = $key + 1;
                            $nestedData['detail_data'][$key]['uuid'] = $record->uuid;
                            $nestedData['detail_data'][$key]['no'] = $key + 1;
                            $nestedData['detail_data'][$key]['item_sub_type_name'] = $record->itemSubType->name;
                            $nestedData['detail_data'][$key]['amount'] = $record->amount_text;
                            $nestedData['detail_data'][$key]['canEdit'] = auth()->user()->can('update-share-internal-donated-item') ? 1 : 0;;
                            $nestedData['detail_data'][$key]['canDelete'] = auth()->user()->can('delete-share-internal-donated-item') ? 1 : 0;;
                        }
                    }
                    array_push($data, $nestedData);
                    $nestedData = [];
                }
            }
            // dd($data);

            // dd($share_internal_requests);

            // if (!empty($share_internal_requests)) {
            //     foreach ($share_internal_requests as $key => $share_internal_request) {
            //         $editLink = route('share_internal_donated_items.edit', $share_internal_request->uuid);
            //         $nestedData['DT_RowIndex'] = $key + 1;
            //         $nestedData['uuid'] = $share_internal_request->uuid;
            //         $nestedData['date'] = "<a href='$editLink'>$share_internal_request->date</a>";
            //         $nestedData['item_type'] =  $share_internal_request->itemType->name;
            //         $nestedData['item_sub_type'] =  $share_internal_request->itemSubType->name;
            //         $nestedData['sacket'] = $share_internal_request->sacket_qty;
            //         $nestedData['by_admin'] = $share_internal_request->admin->name;
            //         $nestedData['option'] = '<a class="btn btn-default text-primary" data-uuid="' . $share_internal_request->uuid . '" data-toggle="editconfirmation" data-href="' . route('share_internal_donated_items.edit', $share_internal_request->uuid) . '"><i class="fas fa-edit"></i></a> - ';
            //         $nestedData['option'] .= '<a class="btn btn-default text-danger" data-toggle="confirmation" data-href="' . route('share_internal_donated_items.destroy', $share_internal_request->uuid) . '"><i class="fas fa-trash"></i></a>';
            //         $data[] = $nestedData;
            //     }
            // }

            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data,
            );

            return $json_data;
        }

        return view('backend.share_intenal_donated_item.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shareInternalDonatedItem = null;

        return view('backend.share_intenal_donated_item.create', compact('shareInternalDonatedItem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShareInternalDonatedItemStoreFormRequest $request)
    {
        $data = $request->shareInternalDonatedItemData()->all();

        $shareInternalDonatedItem = ShareInternalDonatedItem::create($data);

        $shareInternalDonatedItem = ShareInternalDonatedItem::find($shareInternalDonatedItem->id);

        return response()->json(new ShareInternalDonatedItemResource($shareInternalDonatedItem), 200);
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
    public function edit(ShareInternalDonatedItem $shareInternalDonatedItem)
    {
        $shareInternalDonatedItem = new ShareInternalDonatedItemResource($shareInternalDonatedItem);

        return view('backend.share_intenal_donated_item.create', compact('shareInternalDonatedItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShareInternalDonatedItemUpdateFormRequest $request, ShareInternalDonatedItem $shareInternalDonatedItem)
    {
        $data = $request->shareInternalDonatedItemData()->all();

        $shareInternalDonatedItem->update($data);

        $shareInternalDonatedItem = ShareInternalDonatedItem::find($shareInternalDonatedItem->id);

        return response()->json(new ShareInternalDonatedItemResource($shareInternalDonatedItem), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShareInternalDonatedItem $shareInternalDonatedItem)
    {
        $shareInternalDonatedItem->delete();

        return back()->with('success', trans('flash-message.share_internal_donated_item_delete'));
    }
}
