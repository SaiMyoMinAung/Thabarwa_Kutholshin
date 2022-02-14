<?php

namespace App\Http\Controllers\Backend;

use App\Admin;
use Carbon\Carbon;
use App\InternalDonatedItem;
use Illuminate\Http\Request;
use App\Services\GeneratePDF;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InternalDonatedItemExport;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\InternalDonatedItemStoreFormRequest;
use App\Http\Requests\InternalDonatedItemUpdateFormRequest;
use App\Http\Resources\InternalDonatedItemResourceCollection;
use App\Http\Resources\InternalDonatedItem\InternalDonatedItemResource;

class InternalDonatedItemController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(InternalDonatedItem::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $date = $request->date;

            $totalData = InternalDonatedItem::count();

            $totalFiltered = $totalData;

            $internal_donated_items = InternalDonatedItem::query();


            // start sorting
            // if ($order === 'qty') {
            //     $internal_donated_items = $internal_donated_items->orderByRaw("((package_qty * socket_per_package) +  socket_qty) $dir");
            // } else if ($order === 'item_type') {
            //     $internal_donated_items = $internal_donated_items->whereHas('itemType', function (Builder $query) use ($dir) {
            //         $query->orderBy('item_types.name', $dir);
            //     });
            // } else if ($order === 'status') {
            //     $internal_donated_items = $internal_donated_items->orderBy($order, $dir);
            // } else {
            //     $internal_donated_items = $internal_donated_items->orderBy($order, $dir);
            // }
            // end sorting

            //Filter Query
            $internal_donated_items->filterByOffice();

            $nowDate = $date ?? Carbon::now()->format('Y-m-d');
            $internal_donated_items = $internal_donated_items->with('almsRound', 'itemSubType', 'itemSubType.unit')
                ->whereDate('date', $nowDate);

            if ($request->export === 'excel') {
                $internal_donated_items = $internal_donated_items->confirmed();
                return Excel::download(new InternalDonatedItemExport($internal_donated_items), $nowDate . "-storelist.xlsx");
            } elseif ($request->export === 'pdf') {
                $data = $internal_donated_items->confirmed()->get();
                $htmlContent = view('backend.partial_blade.IDI', compact('data', 'nowDate'));
                return GeneratePDF::createPdf($htmlContent,  "$nowDate-storelist.pdf");
            }

            $internal_donated_items = $internal_donated_items->get();

            $groups = $internal_donated_items->groupBy(['date', 'almsRound.name']);

            $data = [];

            if (!empty($groups)) {
                foreach ($groups  as $date => $items) {
                    foreach ($items as $alms_round_name => $item) {
                        $nestedData['date'] = $date;
                        $nestedData['alms_round_name'] = $alms_round_name;
                        $nestedData['item_sub_type_count'] = count($item);
                        foreach ($item as $key => $record) {
                            $nestedData['id'] = $key + 1;
                            $nestedData['detail_data'][$key]['uuid'] = $record->uuid;
                            $nestedData['detail_data'][$key]['no'] = $key + 1;
                            $nestedData['detail_data'][$key]['item_sub_type_name'] = $record->itemSubType->name;
                            $nestedData['detail_data'][$key]['per_qty'] = '<span class="badge badge-primary">' . $record->itemSubType->sacket_per_package . '</span>' . $record->itemSubType->unit->loose_unit . ' ပါသည်';
                            $nestedData['detail_data'][$key]['amount'] = '<span class="badge badge-primary">' . $record->package_qty . '</span> ' . $record->itemSubType->unit->package_unit . ' <span class="badge badge-primary">' . $record->sacket_qty . '</span> ' . $record->itemSubType->unit->loose_unit;
                            if ($record->is_confirmed) {
                                $nestedData['detail_data'][$key]['status'] = '<span class="badge badge-success">Confirmed</span>';
                            } else {
                                $nestedData['detail_data'][$key]['status'] = '<span class="badge badge-warning">Unconfirmed</span>';
                            }
                            $nestedData['detail_data'][$key]['canEdit'] = auth()->user()->can('update-internal-donated-items') && $record->is_confirmed == 0 ? 1 : 0;
                            $nestedData['detail_data'][$key]['canDelete'] = auth()->user()->can('delete-internal-donated-items') && $record->is_confirmed == 0 ? 1 : 0;
                        }
                        array_push($data, $nestedData);
                        $nestedData = [];
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

        return view('backend.internal_donated_item.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $internalDonatedItem = null;

        return view('backend.internal_donated_item.create', compact('internalDonatedItem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InternalDonatedItemStoreFormRequest $request)
    {
        $data = $request->internalDonatedItemData()->all();

        if (auth()->user()->cannot('create-and-confirm-internal-donated-items')) {
            $data['is_confirmed'] = 0;
        }

        $internalDonatedItem = InternalDonatedItem::create($data);

        return response()->json(new InternalDonatedItemResource($internalDonatedItem), 200);

        // return redirect(route('internal_donated_items.index'))->with('success', 'Create Item Successful.');
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
    public function edit(InternalDonatedItem $internalDonatedItem)
    {
        $internalDonatedItem = new InternalDonatedItemResource($internalDonatedItem);

        return view('backend.internal_donated_item.create', compact('internalDonatedItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InternalDonatedItemUpdateFormRequest $request, InternalDonatedItem $internalDonatedItem)
    {
        if ($internalDonatedItem->is_confirmed) {
            $error = ValidationException::withMessages([
                'cannot_confirm_error' => ['This Item Is Comfirmed.'],
            ]);
            throw $error;
        }

        $data = $request->internalDonatedItemData()->all();

        if (auth()->user()->cannot('create-and-confirm-internal-donated-items')) {
            $data['is_confirmed'] = 0;
        }

        $internalDonatedItem->update($data);

        return response()->json(new InternalDonatedItemResource($internalDonatedItem), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(InternalDonatedItem $internalDonatedItem)
    {
        if (!$internalDonatedItem->is_confirmed) {

            $internalDonatedItem->delete();

            return back()->with('success', trans('flash-message.internal_donated_item_delete'));
        } else {

            return back()->with('danger', trans('flash-message.internal_donated_item_cannot_delete'));
        }
    }

    public function getInternalDonatedItems(Request $request)
    {
        $internalDonatedItems = auth()->user()->office->internalDonatedItems()
            ->confirmed()
            ->filterByHistory()
            ->filterByOffice()
            ->where('item_unique_id', 'LIKE', "%$request->q%")
            ->paginate(5);

        return response()->json(new InternalDonatedItemResourceCollection($internalDonatedItems), 200);
    }
}
