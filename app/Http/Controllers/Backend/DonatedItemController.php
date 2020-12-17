<?php

namespace App\Http\Controllers\Backend;

use App\Office;
use App\DonatedItem;
use Illuminate\Http\Request;
use App\Status\KindOfItemStatus;
use App\Status\DonatedItemStatus;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\DonationUpdateFormRequest;
use App\Http\Resources\DonatedItem\DonatedItemResource;
use App\State\Online\Transition\NewToConfirmedTransition;
use App\State\Online\Transition\ConfirmedToCancelledTransition;

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
                0 => 'index',
                1 => 'created_at',
                2 => 'item_unique_id',
                3 => 'about_item',
                4 => 'pickedup_at',
                5 => 'pickedup_info',
                6 => 'status',
                7 => 'kind_of_item',
                8 => 'manage_request'
            );

            $totalData = DonatedItem::count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            $donated_items = DonatedItem::query();

            if (!empty($request->input('search.value'))) {

                $search = $request->input('search.value');

                $donated_items =  $donated_items->where(function ($q) use ($search) {
                    return $q->where('about_item', 'LIKE', "%{$search}%")
                        ->orWhere('item_unique_id', 'LIKE', "%{$search}%")
                        ->orWhere('pickedup_info', 'LIKE', "%{$search}%");
                });


                // add status filter query
                // $status = strtoupper($request->input('search.value'));
                // if (in_array($status, DonatedItemStatus::keys())) {
                //     $search = (string) DonatedItemStatus::values()[$status];
                //     $donated_items = $donated_items->orWhere('status', 'LIKE', "%{$search}%");
                // }

                // add kind of item filter
                // $kind_of_item = strtoupper($request->input('search.value'));
                // if (in_array($kind_of_item, KindOfItemStatus::keys())) {
                //     $search = (string) KindOfItemStatus::values()[$kind_of_item];
                //     $donated_items = $donated_items->orWhere('kind_of_item', 'LIKE', "%{$search}%");
                // }    
            }

            $donated_items->whereHas('offices', function (Builder $query) {
                $query->where('offices.id', auth()->user()->office->id);
            });

            $donated_items = $donated_items->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $donated_items->count();

            $data = array();
            if (!empty($donated_items)) {
                foreach ($donated_items as $key => $donated_item) {
                    $show =  route('donated_items.show', $donated_item->uuid);
                    $manageRequest = route('donated_items.requested_items.index', $donated_item->uuid);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['created_at'] = $donated_item->created_at->format('Y/m/d H:i:s');
                    $nestedData['item_unique_id'] = '<a href="' . $show . '">' . $donated_item->item_unique_id  . '</a>';
                    $nestedData['about_item'] =  $donated_item->about_item;
                    $nestedData['pickedup_at'] = $donated_item->pickedup_at->format('d M Y');
                    $nestedData['pickedup_info'] = substr(strip_tags($donated_item->pickedup_info), 0, 50) . "...";
                    $nestedData['status'] = '<span class="badge badge-success">' . $donated_item->statusName . '</span>';
                    $nestedData['kind_of_item'] = $donated_item->kindOfItemName;
                    $nestedData["manage_request"] = '';
                    if ($donated_item->is_confirmed_by_donor == 1) {
                        $nestedData["manage_request"] .= '<a class="btn btn-info" href="' . route("donated_items.manage", $donated_item->uuid) . '"><i class="fas fa-tools"></i></a> - ';
                    } else {
                        $nestedData["manage_request"] .= 'Need To Confirm Donor';
                    }

                    if ($donated_item->is_complete) {
                        $nestedData["manage_request"] .= '<a href="' . $manageRequest . '" class="btn btn-success"><i class="fas fa-receipt"></i> <span class="badge badge-danger float-right ml-2 mt-1">' . $donated_item->requestedItems->count() . '</span></a>';
                    } else {
                        $nestedData["manage_request"] .= '';
                    }

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
        return back()->with('danger', 'Coming Soon...');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DonatedItem $donatedItem)
    {
        $latestOffice = $donatedItem->offices()->first();

        $offices = Office::orderBy('id', 'desc')->get();

        return view('backend.donated_item.show', compact('donatedItem', 'latestOffice', 'offices'));
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
    public function update(DonationUpdateFormRequest $request, DonatedItem $donatedItem)
    {
        if ($request->hasIsConfirmed()) {
            $t = new NewToConfirmedTransition();
            $donatedItem = $t($donatedItem);
        }

        if ($request->hasIsCancelled()) {
            $t = new ConfirmedToCancelledTransition();
            $donatedItem = $t($donatedItem);
        }

        $donatedItemData = $request->donatedItemData()->all();
        $donatedItem->update($donatedItemData);

        if ($donatedItem->offices()->first()->id != $request->officeId()) {
            $donatedItem->offices()->attach($request->officeId());
        }

        return back()->with('success', 'Donated Item Update Successful.');
    }

    public function manage($uuid)
    {
        $donatedItem = DonatedItem::with(['pickedupVolunteer'])->where('uuid', $uuid)->firstOrFail();

        if ($donatedItem->is_confirmed_by_donor == 0) {
            return back()->with('danger', 'You Must Confirm To Donor')->withErrors(['is_confirmed' => 'Please Check This!']);
        }

        $donatedItem = new DonatedItemResource($donatedItem);

        if ($donatedItem->kind_of_item == (string) KindOfItemStatus::ONLINE()) {
            return view('backend.donated_item.online.manage', compact('donatedItem'));
        }
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
