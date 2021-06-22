<?php

namespace App\Http\Controllers\Backend;

use App\Team;
use App\User;
use App\Yogi;
use App\Admin;
use App\UnexpectedPerson;
use Illuminate\Http\Request;
use App\InternalRequestedItem;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    public function index()
    {
        return view('backend.search.index');
    }

    public function searchInternalRequests(Request $request)
    {
        if ($request->ajax()) {

            $columns = array(
                0 => 'DT_RowIndex',
                1 => 'date',
                2 => 'item_name',
                3 => 'name',
                4 => 'package_qty',
                5 => 'socket_qty',
                6 => 'by_admin'
            );

            $totalData = InternalRequestedItem::count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $order = ($order == 'DT_RowIndex') ? 'created_at' : $order;
            $dir = $request->input('order.0.dir');

            $internal_requests = InternalRequestedItem::query();

            if (!empty($request->input('search.value'))) {

                $search = $request->input('search.value');

                $internal_requests =  $internal_requests->where(function ($q) use ($search) {
                    return $q->where('package_qty', 'LIKE', "%{$search}%")
                        ->orWhere('socket_qty', 'LIKE', "%{$search}%")
                        ->orWhere('date', 'LIKE', "%{$search}%")
                        ->orWhereHasMorph('requestable', ['*'], function (Builder $query) use ($search) {
                            $query->where('name', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('admin', function (Builder $query) use ($search) {
                            $query->where('admins.name', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('internalDonatedItem', function (Builder $query) use ($search) {
                            $query->where('internal_donated_items.name', 'LIKE', "%{$search}%");
                        });
                });
            }

            // start search panes query
            if (!empty($request->searchPanes["date"])) {
                $date =  $request->input('searchPanes.date')[0];
                $internal_requests->where('date', $date);
            }

            if (!empty($request->searchPanes["name"])) {
                $name =  $request->input('searchPanes.name')[0];
                $internal_requests->whereHasMorph('requestable', ['*'], function (Builder $query) use ($name) {
                    $query->where('name', $name);
                });
            }

            if (!empty($request->searchPanes["by_admin"])) {
                $adminName =  $request->input('searchPanes.by_admin')[0];
                $internal_requests->whereHas('admin', function ($query) use ($adminName) {
                    return $query->where('name', $adminName);
                });
            }

            // end search panes query

            // start sorting
            if ($order === 'date') {
                $internal_requests = $internal_requests->orderBy($order, $dir);
            }
            // end sorting

            // Start Search Pane Data
            $searchPanes = [
                'options' => [
                    "date" => [],
                    "name" => [],
                    "by_admin" => [],
                ]
            ];

            // Date Data For Search Pane
            $dates = InternalRequestedItem::distinct('date')->pluck('date');

            foreach ($dates as $key => $date) {

                $dateSearchPaneQuery = InternalRequestedItem::query();

                $searchPanes['options']['date'][$key] = [
                    "label" => $date,
                    "total" => $dateSearchPaneQuery->where('date', $date)->count(),
                    "value" => $date,
                ];
            }

            // Name Data For Search Pane
            $allInternalRequestedItemData = InternalRequestedItem::with('requestable')->get();

            $nameSearchPanes = [];

            foreach ($allInternalRequestedItemData as $key => $each) {
                $nameSearchPanes[$key] = $each->requestable->name;
            }

            $nameSearchPanes = array_unique($nameSearchPanes);

            foreach ($nameSearchPanes as $nameSearchPane) {

                $nameSearchPaneCount = InternalRequestedItem::query();

                if (!empty($request->searchPanes["date"])) {
                    $date =  $request->input('searchPanes.date')[0];
                    $nameSearchPaneCount = InternalRequestedItem::where('date', $date);
                }

                // if (!empty($request->searchPanes["by_admin"])) {
                //     $adminName =  $request->input('searchPanes.by_admin')[0];
                //     $nameSearchPaneCount = InternalRequestedItem::whereHas('admin', function ($query) use ($adminName) {
                //         return $query->where('name', $adminName);
                //     });
                // }

                array_push(
                    $searchPanes['options']['name'],
                    [
                        "label" => $nameSearchPane,
                        "total" =>
                        $nameSearchPaneCount->whereHasMorph('requestable', ['*'], function ($query) use ($nameSearchPane) {
                            $query->where('name', $nameSearchPane);
                        })->count(),
                        "value" => $nameSearchPane,
                    ]
                );
            }

            // Admin Data For Search Pane
            $admins = Admin::whereHas('internalRequestedItems')->get();

            foreach ($admins as $key => $admin) {

                $adminQuery = InternalRequestedItem::whereHas('admin', function ($query) use ($admin) {
                    return $query->where('name', $admin->name);
                });

                if (!empty($request->searchPanes["date"])) {
                    $date =  $request->input('searchPanes.date')[0];
                    $adminQuery = $adminQuery->where('date', $date);
                }

                if (!empty($request->searchPanes["name"])) {
                    $name =  $request->input('searchPanes.name')[0];
                    $adminQuery = $adminQuery->whereHasMorph('requestable', ['*'], function ($query) use ($name) {
                        return $query->where('name', $name);
                    });
                }

                $searchPanes['options']['by_admin'][$key] = [
                    "label" => $admin->name,
                    "total" => $adminQuery->count(),
                    "value" => $admin->name,
                ];
            }
            // End Search Pane Data

            $totalFiltered = $internal_requests->count();

            $internal_requests = $internal_requests->offset($start)
                ->limit($limit)
                ->get();

            $data = array();
            if (!empty($internal_requests)) {
                foreach ($internal_requests as $key => $internal_request) {

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['uuid'] = $internal_request->uuid;
                    $nestedData['date'] = $internal_request->date;
                    $nestedData['item_name'] =  $internal_request->internalDonatedItem->name;
                    $nestedData['name'] = $internal_request->requestable->name;
                    $nestedData['package'] = $internal_request->package_qty;
                    $nestedData['socket'] = $internal_request->socket_qty;
                    $nestedData['by_admin'] = $internal_request->admin->name;

                    $data[] = $nestedData;
                }
            }

            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data,
                "searchPanes" => $searchPanes,
            );

            return $json_data;
        }

        return view('backend.search.internal_request');
    }
}
