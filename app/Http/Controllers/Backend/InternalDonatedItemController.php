<?php

namespace App\Http\Controllers\Backend;

use App\InternalDonatedItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Status\InternalDonatedItemStatus;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\InternalDonatedItemStoreFormRequest;
use App\Http\Requests\InternalDonatedItemUpdateFormRequest;
use App\Http\Resources\InternalDonatedItemResourceCollection;
use App\Http\Resources\InternalDonatedItem\InternalDonatedItemResource;

class InternalDonatedItemController extends Controller
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
                1 => 'item_unique_id',
                2 => 'name',
                3 => 'qty',
                4 => 'item_type',
                5 => 'status'
            );

            $totalData = InternalDonatedItem::count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $order = ($order == 'DT_RowIndex') ? 'created_at' : $order;
            $dir = $request->input('order.0.dir');

            $donated_items = InternalDonatedItem::query();

            $donated_items = $donated_items->filterByHistory();


            if (!empty($request->input('search.value'))) {

                $search = $request->input('search.value');

                $donated_items =  $donated_items->where(function ($q) use ($search) {
                    return $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('item_unique_id', 'LIKE', "%{$search}%")
                        ->orWhereHas('itemType', function (Builder $query) use ($search) {
                            $query->where('item_types.name', 'LIKE', "%{$search}%");
                        });
                });
            }

            // sorting
            if ($order === 'qty') {
                $donated_items = $donated_items->orderByRaw("((package_qty * socket_per_package) +  socket_qty) $dir");
            } else if ($order === 'item_type') {
                $donated_items = $donated_items->whereHas('itemType', function (Builder $query) use ($dir) {
                    $query->orderBy('item_types.name', $dir);
                });
            } else if ($order === 'status') {
                $donated_items = $donated_items->orderBy($order, $dir);
            } else {
                $donated_items = $donated_items->orderBy($order, $dir);
            }

            //Filter Query
            $donated_items->filterByOffice();

            $donated_items = $donated_items->offset($start)
                ->limit($limit)
                ->get();

            $totalFiltered = $donated_items->count();

            $data = array();
            if (!empty($donated_items)) {
                foreach ($donated_items as $key => $donated_item) {

                    // if ((!isset($donated_item->getLatestHistory)) || ($donated_item->getLatestHistory->is_confirmed && $donated_item->getLatestHistory->is_accepted)) {
                    $show =  route('internal_donated_items.show', $donated_item->uuid);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['uuid'] = $donated_item->uuid;
                    $nestedData['item_unique_id'] = $donated_item->item_unique_id;
                    $nestedData['name'] =  $donated_item->name;
                    $nestedData['qty'] = $donated_item->package_qty . 'p | ' . $donated_item->socket_qty . 's ( per ' . $donated_item->socket_per_package . ' )';
                    $nestedData['item_type'] = $donated_item->itemType->name;

                    $nestedData['status'] = '<span class="' . InternalDonatedItemStatus::advanceSearch(($donated_item->status))["class"] . '">' . InternalDonatedItemStatus::advanceSearch(($donated_item->status))["label"] . '</span> ';

                    if ($donated_item->is_confirmed) {
                        $nestedData['status'] .= '/ <span class="badge badge-success">Confirmed</span>';
                    } else {
                        $nestedData['status'] .= '/ <span class="badge badge-warning">Unconfirmed</span>';
                    }
                    if (
                        InternalDonatedItemStatus::advanceSearch(($donated_item->status))["label"] != InternalDonatedItemStatus::COMPLETE()
                        &&
                        InternalDonatedItemStatus::advanceSearch(($donated_item->status))["label"] != InternalDonatedItemStatus::LOST()
                    ) {
                        $nestedData['option'] = '<a class="btn btn-default text-primary" data-uuid="' . $donated_item->uuid . '" data-toggle="editconfirmation" data-href="' . route('internal_donated_items.edit', $donated_item->uuid) . '"><i class="fas fa-edit"></i></a> - ';
                        $nestedData['option'] .= '<a class="btn btn-default text-danger" data-toggle="confirmation" data-href="' . route('internal_donated_items.destroy', $donated_item->uuid) . '"><i class="fas fa-trash"></i></a>';
                    } else {
                        $nestedData['option'] = '-';
                    }


                    $data[] = $nestedData;
                    // }
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
        if ($internalDonatedItem->contributions->count() == 0 && $internalDonatedItem->internalRequestedItems->count() == 0) {

            $internalDonatedItem->delete();

            return back()->with('success', 'Internal Donated Item Delete Successful.');
        } else {
            return back()->with('danger', 'Internal Donated Item Cannot Be Delete.');
        }
    }

    public function getInternalDonatedItems(Request $request)
    {
        $internalDonatedItems = auth()->user()->office->internalDonatedItems()
            ->available()
            ->confirmed()
            ->filterByHistory()
            ->filterByOffice()
            ->where('item_unique_id', 'LIKE', "%$request->q%")
            ->paginate(5);

        return response()->json(new InternalDonatedItemResourceCollection($internalDonatedItems), 200);
    }

    public function controlAvailableOrLost(InternalDonatedItem $internalDonatedItem)
    {
        $internalDonatedItemStatus = InternalDonatedItemStatus::advanceSearch($internalDonatedItem->status);

        if ($internalDonatedItemStatus["label"] == 'Available') {
            $status = InternalDonatedItemStatus::advanceSearch('Lost')["code"];
        } else if ($internalDonatedItemStatus["label"] == 'Lost') {
            $status = InternalDonatedItemStatus::advanceSearch('Available')["code"];
        } else if ($internalDonatedItemStatus["label"] == 'Complete') {
            $error = ValidationException::withMessages([
                'cannot_change_status_error' => ['This Item Is Completed.Cannot Change To Other Status.'],
            ]);
            throw $error;
        }

        $internalDonatedItem->update([
            'status' => $status
        ]);

        $internalDonatedItem->fresh();

        return response()->json(new InternalDonatedItemResource($internalDonatedItem), 200);
    }
}
