<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Country;
use App\DonatedItem;
use App\StateRegion;
use Illuminate\Http\Request;
use App\Status\KindOfItemStatus;
use App\Http\Controllers\Controller;
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
                0 => 'id',
                1 => 'about_item',
                2 => 'pickedup_at',
                3 => 'pickedup_info',
                4 => 'status',
                5 => 'kind_of_item',
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

                $totalFiltered = DonatedItem::where('about_item', 'LIKE', "%{$search}%")
                    ->orWhere('pickedup_at', 'LIKE', "%{$search}%")
                    ->orWhere('pickedup_info', 'LIKE', "%{$search}%");

                $donated_items =  DonatedItem::where('about_item', 'LIKE', "%{$search}%")
                    ->orWhere('pickedup_at', 'LIKE', "%{$search}%")
                    ->orWhere('pickedup_info', 'LIKE', "%{$search}%");

                // add status filter query
                $status = strtoupper($request->input('search.value'));
                if (in_array($status, DonatedItemStatus::keys())) {
                    $search = (string) DonatedItemStatus::values()[$status];
                    $donated_items = $donated_items->orWhere('status', 'LIKE', "%{$search}%");
                    $totalFiltered = $totalFiltered->orWhere('status', 'LIKE', "%{$search}%");
                }

                // add kind of item filter
                $kind_of_item = strtoupper($request->input('search.value'));
                if (in_array($kind_of_item, KindOfItemStatus::keys())) {
                    $search = (string) KindOfItemStatus::values()[$kind_of_item];
                    $donated_items = $donated_items->orWhere('kind_of_item', 'LIKE', "%{$search}%");
                    $totalFiltered = $totalFiltered->orWhere('kind_of_item', 'LIKE', "%{$search}%");
                }

                $donated_items = $donated_items->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

                $totalFiltered = $totalFiltered->count();
            }

            $data = array();
            if (!empty($donated_items)) {
                foreach ($donated_items as $key => $donated_item) {
                    $show =  route('donated_items.show', $donated_item->uuid);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['about_item'] = '<a href="' . $show . '">' . $donated_item->about_item . '</a>';
                    $nestedData['pickedup_at'] = $donated_item->pickedup_at->format('d M Y');
                    $nestedData['pickedup_info'] = substr(strip_tags($donated_item->pickedup_info), 0, 50) . "...";
                    $nestedData['status'] = $donated_item->statusName;
                    $nestedData['kind_of_item'] = $donated_item->kindOfItemName;

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DonatedItem $donatedItem)
    {
        return view('backend.donated_item.show', compact('donatedItem'));
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
        $userData = $request->userData()->all();
        $donatedItem->donor->update($userData);

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

        return back()->with('success', 'Donated Item Update Successful.');
    }

    public function manage($uuid)
    {
        $donatedItem = DonatedItem::with(['pickedupVolunteer'])->where('uuid', $uuid)->first();

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
