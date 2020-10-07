<?php

namespace App\Http\Controllers\Backend;

use App\DonatedItem;
use App\StateRegion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\State\AssignDriverTransition;
use App\State\ArriveAtOfficeTransition;
use App\State\NewToConfirmedTransition;
use App\State\ToAssignDriverTransition;
use App\Http\Requests\DTO\ArriveAtOfficeDTO;
use App\State\ConfirmedToCancelledTransition;
use App\Http\Requests\AssignDriverStoreRequest;
use App\Http\Requests\DonationUpdateFormRequest;

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
                    $show =  route('donated_items.show', $donated_item->uuid);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['about_item'] = '<a href="' . $show . '">' . $donated_item->about_item . '</a>';
                    $nestedData['pickedup_at'] = $donated_item->pickedup_at->format('d M Y');
                    $nestedData['pickedup_info'] = substr(strip_tags($donated_item->pickedup_info), 0, 50) . "...";
                    $nestedData['status'] = $donated_item->status;

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
    public function show(DonatedItem $donatedItem)
    {
        $stateRegions = StateRegion::all();

        return view('backend.donated_item.show', compact('donatedItem', 'stateRegions'));
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

    public function manage(DonatedItem $donatedItem)
    {
        if ($donatedItem->is_confirmed == 0) {
            return back()->with('danger', 'You Must Confirm To Donor')->withErrors(['is_confirmed' => 'Please Check This!']);
        }

        return view('backend.donated_item.manage', compact('donatedItem'));
    }

    public function assignDriver(AssignDriverStoreRequest $request, DonatedItem $donatedItem)
    {
        $assignDriverData = $request->assignDriverData()->all();
        $t = new AssignDriverTransition();
        $donatedItem = $t($donatedItem, $assignDriverData);

        $url = route('donated_items.manage', ['donated_item' => $donatedItem->uuid, 'stepper' => $request->getStepper()]);
        return redirect($url)->with('success', 'Assign Driver Successful.');
    }

    public function arriveAtOffice(DonatedItem $donatedItem)
    {
        $arriveAtOfficeData = new ArriveAtOfficeDTO();
        $t = new ArriveAtOfficeTransition();
        $donatedItem = $t($donatedItem, $arriveAtOfficeData->all());

        $url = route('donated_items.manage', ['donated_item' => $donatedItem->uuid, 'stepper' => $request->getStepper()]);
        return redirect($url)->with('success', 'Marking Arrive At Office Is Successful.');
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
