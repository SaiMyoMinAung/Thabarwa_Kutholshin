<?php

namespace App\Http\Controllers\Backend;

use App\Contribution;
use App\InternalDonatedItem;
use Illuminate\Http\Request;
use App\Status\DonatedItemStatus;
use App\Http\Controllers\Controller;
use App\Status\InternalDonatedItemStatus;
use Illuminate\Database\Eloquent\Builder;

class ReceivedContributionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $columns = array(
                0 => 'index',
                1 => 'title',
                2 => 'note',
                3 => 'office',
                4 => 'item',
                5 => 'volunteer',
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
            }

            $contributions->where('receive_office_id', auth()->user()->office_id);

            $contributions = $contributions->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $contributions->count();

            $data = array();
            if (!empty($contributions)) {
                foreach ($contributions as $key => $contribution) {
                    $show =  route('received_contributions.show', $contribution->id);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['id'] = $contribution->id;
                    $nestedData['title'] = '<a href="' . $show . '">' . $contribution->title  . '</a>';
                    // $nestedData['about_item'] =  $donated_item->about_item;
                    // $nestedData['pickedup_at'] = $donated_item->pickedup_at->format('d M Y');
                    $nestedData['note'] = substr(strip_tags($contribution->note), 0, 50) . "...";
                    $nestedData['office'] = $contribution->office->name;
                    $nestedData['items'] = '';
                    if ($contribution->internalDonatedItems()->count() > 0) {
                        foreach ($contribution->internalDonatedItems as $item) {
                            $nestedData['items'] .= "<span class='badge badge-success'>$item->item_unique_id</span>";
                        }
                    }
                    $acceptedCount = $contribution->internalDonatedItems()->wherePivot('is_accepted', 1)->count();
                    $allItemCount = $contribution->internalDonatedItems()->count();
                    $nestedData['volunteer'] = $contribution->volunteer->name;
                    $nestedData['accepted'] = '';
                    if ($acceptedCount == $allItemCount) {
                        $nestedData['accepted'] .= "<span class='badge badge-success'>$acceptedCount/$allItemCount</span>";
                    } else {
                        $nestedData['accepted'] .= "<span class='badge badge-warning'>$acceptedCount/$allItemCount</span>";
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

        return view('backend.received_contribution.index');
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
                5 => 'status',
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
                    if ($donated_item->pivot->is_confirmed) {
                        $show =  route('internal_donated_items.show', $donated_item->uuid);

                        $nestedData['DT_RowIndex'] = $key + 1;
                        $nestedData['uuid'] = $donated_item->uuid;
                        $nestedData['item_unique_id'] = '<a href="' . $show . '">' . $donated_item->item_unique_id  . '</a>';
                        $nestedData['name'] =  $donated_item->name;
                        $nestedData['qty'] = $donated_item->package_qty . 'p | ' . $donated_item->socket_qty . 's ( per ' . $donated_item->socket_per_package . ' )';
                        $nestedData['item_type'] = $donated_item->itemType->name;
                        $nestedData['status'] = InternalDonatedItemStatus::advanceSearch(($donated_item->status))["label"];
                        $nestedData['option'] = '';

                        if (!$donated_item->pivot->is_accepted) {
                            $nestedData['option'] .= '<a class="btn btn-default text-primary" data-contributionid="' . $contribution->id . '" data-itemuuid="' . $donated_item->uuid . '" data-toggle="acceptconfirmation"><i class="fas fa-file-import"></i></a>';
                        } else {
                            $nestedData['option'] .= '<span class="badge badge-success">Accepted</span>';
                        }

                        $data[] = $nestedData;
                    }
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

    public function contributionItemsAccept(Contribution $contribution, InternalDonatedItem $internalDonatedItem)
    {
        $contribution->internalDonatedItems()->updateExistingPivot($internalDonatedItem->id, [
            'is_accepted' => 1
        ]);

        $internalDonatedItem->save();
    }

    public function show(Contribution $contribution)
    {
        return view('backend.received_contribution.show', compact('contribution'));
    }
}
