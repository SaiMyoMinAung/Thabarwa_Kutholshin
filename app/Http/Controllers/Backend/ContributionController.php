<?php

namespace App\Http\Controllers\Backend;

use App\Contribution;
use App\InternalDonatedItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Status\InternalDonatedItemStatus;
use App\ViewModels\ContributionViewModel;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\ContributionStoreFormRequest;
use App\Http\Requests\ContributionUpdateFormRequest;

class ContributionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $columns = array(
                0 => 'index',
                1 => 'title',
                2 => 'note',
                3 => 'To office',
                4 => 'item',
                5 => 'deliver',
            );

            $totalData = Contribution::count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            $contributions = Contribution::query();

            if (!empty($request->input('search.value'))) {

                $search = $request->input('search.value');

                $contributions =  $contributions->where(function ($q) use ($search) {
                    return $q->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('note', 'LIKE', "%{$search}%");
                });


                // add status filter query
                // $status = strtoupper($request->input('search.value'));
                // if (in_array($status, DonatedItemStatus::keys())) {
                //     $search = (string) DonatedItemStatus::values()[$status];
                //     $donated_items = $donated_items->orWhere('status', 'LIKE', "%{$search}%");
                // }

            }

            $contributions->where('office_id', auth()->user()->office->id);

            $contributions = $contributions->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $contributions->count();

            $data = array();
            if (!empty($contributions)) {
                foreach ($contributions as $key => $contribution) {
                    $show =  route('contributions.show', $contribution->id);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['id'] = $contribution->id;
                    $nestedData['title'] = $contribution->title;
                    // $nestedData['about_item'] =  $donated_item->about_item;
                    // $nestedData['pickedup_at'] = $donated_item->pickedup_at->format('d M Y');
                    $nestedData['note'] = substr(strip_tags($contribution->note), 0, 50) . "...";
                    $nestedData['office'] = $contribution->receiveOffice->name;
                    $nestedData['items'] = '';
                    if ($contribution->internalDonatedItems()->count() > 0) {
                        foreach ($contribution->internalDonatedItems as $item) {
                            $nestedData['items'] .= "<span class='badge badge-success'>$item->item_unique_id</span>";
                        }
                    }
                    $confirmedCount = $contribution->internalDonatedItems()->wherePivot('is_confirmed', 1)->count();
                    $allItemCount = $contribution->internalDonatedItems()->count();
                    $nestedData['volunteer'] = $contribution->volunteer->name;
                    $nestedData['confirmed'] = '';
                    if ($confirmedCount == $allItemCount) {
                        $nestedData['confirmed'] .= "<span class='badge badge-success'>$confirmedCount/$allItemCount</span>";
                    } else {
                        $nestedData['confirmed'] .= "<span class='badge badge-warning'>$confirmedCount/$allItemCount</span>";
                    }
                    $nestedData['options'] = '';
                    if ($confirmedCount != $allItemCount) {
                        $nestedData['options'] .= '<a class="btn btn-default text-primary" data-id="' . $contribution->id . '" data-toggle="editconfirmation" data-href="' . route('contributions.edit', $contribution->id) . '"><i class="fas fa-edit"></i></a> ';
                    }

                    if ($confirmedCount <= 0) {
                        $nestedData['options'] .= ' <a class="btn btn-default text-danger" data-toggle="confirmation" data-href="' . route('contributions.destroy', $contribution->id) . '"><i class="fas fa-trash"></i></a>';
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

        return view('backend.contribution.index');
    }

    public function contributionItemsIndex(Request $request, Contribution $contribution)
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

            $totalData = $contribution->internalDonatedItems()->count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $order = ($order == 'DT_RowIndex') ? 'created_at' : $order;
            $dir = $request->input('order.0.dir');

            $donated_items = $contribution->internalDonatedItems();

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

            $donated_items = $donated_items->offset($start)
                ->limit($limit)
                ->get();

            $totalFiltered = $donated_items->count();

            $data = array();
            if (!empty($donated_items)) {
                foreach ($donated_items as $key => $donated_item) {
                    $show =  route('internal_donated_items.show', $donated_item->uuid);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['uuid'] = $donated_item->uuid;
                    $nestedData['item_unique_id'] = $donated_item->item_unique_id;
                    $nestedData['name'] =  $donated_item->name;
                    $nestedData['qty'] = $donated_item->package_qty . 'p | ' . $donated_item->socket_qty . 's ( per ' . $donated_item->socket_per_package . ' )';
                    $nestedData['item_type'] = $donated_item->itemType->name;
                    $nestedData['status'] = InternalDonatedItemStatus::advanceSearch(($donated_item->status))["label"];
                    $nestedData['option'] = '';
                    if (!$donated_item->pivot->is_confirmed) {
                        $nestedData['option'] .= '<a class="btn btn-default text-primary" data-contributionid="' . $contribution->id . '" data-itemuuid="' . $donated_item->uuid . '" data-toggle="confirmation"><i class="fas fa-check-double"></i></a>-';
                        $nestedData['option'] .= '<a class="btn btn-default text-danger" data-contributionid="' . $contribution->id . '" data-itemuuid="' . $donated_item->uuid . '" data-toggle="removeconfirmation"><i class="fas fa-trash"></i></a>';
                    } else {
                        $nestedData['option'] .= '<span class="badge badge-success">Confirmed</span>';
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
    }

    public function create()
    {
        $viewModel = new ContributionViewModel();

        return view('backend.contribution.create', $viewModel);
    }

    public function store(ContributionStoreFormRequest $request)
    {
        $validated_data = $request->getContributionData()->all();

        $contribution = Contribution::create($validated_data);

        $items_id = $request->getItemsId();

        $contribution->internalDonatedItems()->sync($items_id);

        return redirect(route('contributions.index'))->with('success', 'Contribution Create Successful.');
    }
    public function edit(Contribution $contribution)
    {
        $viewModel = new ContributionViewModel($contribution, true);

        return view('backend.contribution.create', $viewModel);
    }
    public function update(ContributionUpdateFormRequest $request, Contribution $contribution)
    {
        $validated_data = $request->getContributionData()->all();

        $contribution->update($validated_data);

        return redirect(route('contributions.index'))->with('success', 'Contribution Update Successful.');
    }
    public function destroy(Contribution $contribution)
    {
        if (!$contribution->atLeastOneItemConfirmed($contribution)) {
            $contribution->delete();
            return back()->with('success', 'Contribution Delete Successful.');
        } else {
            return back()->with('danger', 'Cannot Delete Because Some Items Are Confirmed.');
        }
    }

    public function contributionItemsConfirm(Contribution $contribution, InternalDonatedItem $internalDonatedItem)
    {
        $contribution->internalDonatedItems()->updateExistingPivot($internalDonatedItem->id, [
            'is_confirmed' => 1
        ]);

        $internalDonatedItem->office_id = $contribution->receive_office_id;
        $internalDonatedItem->save();
    }

    public function contributionItemsRemove(Contribution $contribution, InternalDonatedItem $internalDonatedItem)
    {
        // dd($internalDonatedItem->id);
        // dd($contribution->internalDonatedItems);
        $contribution->internalDonatedItems()->detach($internalDonatedItem->id);
    }

    public function addInternalDonatedItems(Request $request, Contribution $contribution)
    {
        $validated = $request->validate([
            'items_id' => 'required|array',
        ]);

        $contribution->internalDonatedItems()->attach($request->items_id);

        return back()->with('success', 'Add Item Successful');
    }
}
