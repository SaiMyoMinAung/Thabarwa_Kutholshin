<?php

namespace App\Http\Controllers\Backend;

use App\Contribution;
use App\Team;
use App\Yogi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\ShareInternalDonatedItem;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ShareInternalDonatedItemExport;
use App\Http\Requests\ShareInternalDonatedItemStoreFormRequest;
use App\Http\Requests\ShareInternalDonatedItemUpdateFormRequest;
use App\Http\Resources\InternalDonatedItem\ShareInternalDonatedItemResource;
use App\UnexpectedPerson;

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
            $date = $request->date;

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

            $nowDate = $date ?? Carbon::now()->format('Y-m-d');

            $share_internal_requests = $share_internal_requests->with('requestable')->whereDate('date', $nowDate);

            if ($request->export === 'excel') {
                return Excel::download(new ShareInternalDonatedItemExport($share_internal_requests), $nowDate . "-storelist.xlsx");
            }
            //  elseif ($request->export === 'pdf') {
            //     $data = $share_internal_requests->get();
            //     $htmlContent = view('backend.partial_blade.IDI', compact('data', 'nowDate'));
            //     return GeneratePDF::createPdf($htmlContent,  "$nowDate-storelist.pdf");
            // }

            $share_internal_requests = $share_internal_requests->get();

            $groups = $share_internal_requests->groupBy(['date', 'requestable.name', 'requestable_type']);

            $data = [];

            if (!empty($groups)) {

                foreach ($groups as $date => $item) {
                    foreach ($item as $name => $items) {
                        foreach ($items as $type => $records) {
                            $nestedData['date'] = $date;
                            $nestedData['name'] = $name;
                            if (str_contains($type, 'Contribution')) {
                                $nestedData['share_type'] = 'အခြားရိပ်သာသို့';
                            } elseif (str_contains($type, 'Team')) {
                                $nestedData['share_type'] = "အဖွဲ့ အစည်းသို့";
                            } elseif (str_contains($type, 'Yogi')) {
                                $nestedData['share_type'] = 'ယောဂီ သို့';
                            } elseif (str_contains($type, 'Unexpectedperson')) {
                                $nestedData['share_type'] = 'အခြား လူ သို့';
                            }

                            $nestedData['count'] = count($items);

                            $url = route("share_internal_donated_items.create", ["name" => $name, "type" => $type]);
                            if (
                                $nowDate == Carbon::now()->format('Y-m-d')
                                && auth()->user()->can('create-share-internal-donated-items')
                            ) {
                                $button = "<a class='btn btn-primary' href='$url'>စာရင်း ထပ်ထည့်မည်</a>";
                            } else {
                                $button = '-';
                            }
                            $nestedData['give_again'] =  $button;

                            foreach ($records as $key => $record) {
                                $nestedData['id'] = $key + 1;
                                $nestedData['detail_data'][$key]['uuid'] = $record->uuid;
                                $nestedData['detail_data'][$key]['no'] = $key + 1;
                                $nestedData['detail_data'][$key]['item_sub_type_name'] = $record->itemSubType->name;
                                $nestedData['detail_data'][$key]['amount'] = $record->amount_text;
                                $nestedData['detail_data'][$key]['canCreate'] = auth()->user()->can('create-share-internal-donated-item') && $nowDate == Carbon::now()->format('Y-m-d') ? 1 : 0;
                                $nestedData['detail_data'][$key]['canEdit'] = auth()->user()->can('update-share-internal-donated-item') ? 1 : 0;;
                                $nestedData['detail_data'][$key]['canDelete'] = auth()->user()->can('delete-share-internal-donated-item') ? 1 : 0;;
                            }
                            array_push($data, $nestedData);
                            $nestedData = [];
                        }
                    }
                }
            }

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
    public function create(Request $request)
    {
        $shareInternalDonatedItem = [];

        if ($request->uuid) {
            $share = ShareInternalDonatedItem::with('itemSubType')->where('uuid', $request->uuid)->firstOrFail();
            $itemSubType = $share->itemSubType;
            $type = $share->requestable_type;
            $shareInternalDonatedItem['selectedItemSubType'] = [
                'id' => $itemSubType->id,
                'original_name' => $itemSubType->name,
                'name' => $itemSubType->name  . " ( " . $itemSubType->unit->package_unit . " one တွင်" . $itemSubType->unit->loose_unit . $itemSubType->sacket_per_package . " ပါဝင်သည်။ )",
            ];
            $shareInternalDonatedItem['item_sub_type_id'] = $itemSubType->id;
            $shareInternalDonatedItem['selectedRequestableTypeId'] = [
                'id' => $share->requestable->id,
                'name' => $share->requestable->name
            ];
            $shareInternalDonatedItem['requestable_id'] = $share->requestable->id;
        } else {
            $type = $request->type;
        }

        if ($type == 'App\Team') {
            $shareInternalDonatedItem['selectedRequestableType'] = [
                'id' => 'TEAM',
                'name' => 'TEAM',
            ];
            $team = Team::where('name', $request->name)->first();
            if ($team) {
                $shareInternalDonatedItem['selectedRequestableTypeId'] = [
                    'id' => $team->id,
                    'name' => $team->name
                ];
                $shareInternalDonatedItem['requestable_id'] = $team->id;
            }
            $shareInternalDonatedItem['getRequestableTypeIdUrl'] =  route('teams.fetch');
            $shareInternalDonatedItem['showModel'] =  '#teamModel';
            $shareInternalDonatedItem['requestable_type'] =  'TEAM';
        } else if ($type == 'App\Yogi') {
            $shareInternalDonatedItem['selectedRequestableType'] = [
                'id' => 'YOGI',
                'name' => 'YOGI',
            ];
            $shareInternalDonatedItem['getRequestableTypeIdUrl'] =  route('yogis.fetch');
            $shareInternalDonatedItem['showModel'] =  '#yogiModel';
            $shareInternalDonatedItem['requestable_type'] =  'YOGI';
            $yogi = Yogi::where('name', $request->name)->first();
            if ($yogi) {
                $shareInternalDonatedItem['selectedRequestableTypeId'] = [
                    'id' => $yogi->id,
                    'name' => $yogi->name
                ];
                $shareInternalDonatedItem['requestable_id'] = $yogi->id;
            }
        } else if ($type == 'App\UnexpectedPerson') {
            $shareInternalDonatedItem['selectedRequestableType'] = [
                'id' => 'UNEXPECTEDPERSON',
                'name' => 'UNEXPECTEDPERSON',
            ];
            $shareInternalDonatedItem['getRequestableTypeIdUrl'] =  route('unexpected_persons.fetch');
            $shareInternalDonatedItem['showModel'] =  '#unexpectedPersonModel';
            $shareInternalDonatedItem['requestable_type'] =  'UNEXPECTEDPERSON';
            $unexpectedPerson = UnexpectedPerson::where('name', $request->name)->first();
            if ($unexpectedPerson) {
                $shareInternalDonatedItem['selectedRequestableTypeId'] = [
                    'id' => $unexpectedPerson->id,
                    'name' => $unexpectedPerson->name
                ];
                $shareInternalDonatedItem['requestable_id'] = $unexpectedPerson->id;
            }
        } else if ($type == 'App\Contribution') {
            $shareInternalDonatedItem['selectedRequestableType'] = [
                'id' => 'CONTRIBUTION',
                'name' => 'CONTRIBUTION',
            ];
            $shareInternalDonatedItem['getRequestableTypeIdUrl'] =  route('contributions.fetch');
            $shareInternalDonatedItem['showModel'] =  '#contributionModel';
            $shareInternalDonatedItem['requestable_type'] =  'CONTRIBUTION';
            $contribution = Contribution::where('name', $request->name)->first();
            if ($contribution) {
                $shareInternalDonatedItem['selectedRequestableTypeId'] = [
                    'id' => $contribution->id,
                    'name' => $contribution->name
                ];
                $shareInternalDonatedItem['requestable_id'] = $contribution->id;
            }
        }

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
