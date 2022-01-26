<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenerateDetailListController extends Controller
{
    public function forInternalDonatedItem(Request $request)
    {
        $datas = $request->data;
        $uuid = $request->uuid;

        return view('backend.generate_detail_list.for_internal_donated_item', compact('datas', 'uuid'));
    }
    public function forShareInternalDonatedItem(Request $request)
    {
        $datas = $request->data;
        $uuid = $request->uuid;

        return view('backend.generate_detail_list.for_share_internal_donated_item', compact('datas', 'uuid'));
    }
}
