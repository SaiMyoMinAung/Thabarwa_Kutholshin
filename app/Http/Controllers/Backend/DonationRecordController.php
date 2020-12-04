<?php

namespace App\Http\Controllers\Backend;

use App\Center;
use App\DonationRecord;
use App\KindOfDonation;
use App\Status\TypeOfMoney;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\DonationRecordStoreRequest;
use App\Http\Requests\DonationRecordUpdateRequest;

class DonationRecordController extends Controller
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
                2 => 'sr_no',
                3 => 'ct_no',
                4 => 'main_donor_name',
                5 => 'donor',
                6 => 'date_of_donation',
                7 => 'donation_cash',
                8 => 'kind_of_donation',
                9 => 'donation_material'
            );

            $totalData = DonationRecord::count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if (empty($request->input('search.value'))) {
                $donation_records = DonationRecord::offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $search = $request->input('search.value');

                $donation_records =  DonationRecord::where('main_donor_name', 'LIKE', "%{$search}%")
                    ->orWhere('donor', 'LIKE', "%{$search}%")
                    ->orWhere('date_of_donation', 'LIKE', "%{$search}%")
                    ->orWhere('donation_cash', 'LIKE', "%{$search}%")
                    ->orWhere('donation_material', 'LIKE', "%{$search}%")
                    ->orWhere('sr_no', 'LIKE', "%{$search}%")
                    ->orWhere('certificate_no', 'LIKE', "%{$search}%")
                    ->orWhereHas('kindOfDonation', function (Builder $query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    });

                $donation_records = $donation_records->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

                $totalFiltered = $donation_records->count();
            }

            $data = array();
            if (!empty($donation_records)) {
                foreach ($donation_records as $key => $donation_record) {
                    $show =  route('donation_records.show', $donation_record->uuid);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['created_at'] = $donation_record->created_at->format('Y/m/d H:i:s');
                    $nestedData['sr_no'] = $donation_record->sr_no;
                    $nestedData['ct_no'] = $donation_record->certificate_no;
                    $nestedData['main_donor_name'] = Str::limit($donation_record->main_donor_name, 15, '...');
                    $nestedData['donor'] = Str::limit($donation_record->donor, 15, '...');
                    $nestedData['date_of_donation'] = $donation_record->date_of_donation;
                    $nestedData['cash'] = ' <span class="badge badge-success">' . TypeOfMoney::advanceSerach($donation_record->type_of_money)["symbol"] . '</span> ' . $donation_record->formatedCash;
                    $nestedData['kind_of_donation'] = $donation_record->kindOfDonation->name;
                    $nestedData['donation_material'] = Str::limit($donation_record->donation_material, 15, '...');
                    $nestedData['options'] = '<a class="btn btn-default text-primary" href="' . route('donation_records.edit', $donation_record->uuid) . '"><i class="fas fa-edit"></i></a> - ';
                    $nestedData['options'] .= '<a class="btn btn-default text-danger" data-toggle="confirmation" data-href="' . route('donation_records.destroy', $donation_record->uuid) . '"><i class="fas fa-trash"></i></a>';
                    $data[] = $nestedData;
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

        return view('backend.donation_record.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $centers = Center::orderBy('id', 'desc')->get();

        $kindOfDonations = KindOfDonation::orderBy('id', 'desc')->get();

        $types = collect(TypeOfMoney::TYPE());

        $edit = false;

        return view('backend.donation_record.create', compact('centers', 'kindOfDonations', 'types', 'edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonationRecordStoreRequest $request)
    {
        $data = $request->donationRecordData()->all();

        DonationRecord::create($data);

        return redirect(route('donation_records.index'))->with('success', 'Create Donation Record Successful.');
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
    public function edit(DonationRecord $donation_record)
    {
        $centers = Center::orderBy('id', 'desc')->get();

        $kindOfDonations = KindOfDonation::orderBy('id', 'desc')->get();

        $types = collect(TypeOfMoney::TYPE());

        $edit = true;

        return view('backend.donation_record.create', compact('centers', 'kindOfDonations', 'types', 'donation_record', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DonationRecordUpdateRequest $request, DonationRecord $donation_record)
    {
        $data = $request->donationRecordData()->all();

        $donation_record->update($data);

        return redirect(route('donation_records.index'))->with('success', 'Donation Record Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonationRecord $donation_record)
    {
        $donation_record->update(['sr_no' => '', 'certificate_no' => '']);

        $donation_record->delete();

        return back()->with('success', 'Delete Donation Record Successful');
    }
}
