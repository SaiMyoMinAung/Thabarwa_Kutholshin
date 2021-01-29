<?php

namespace App\Http\Controllers\Backend;

use App\Status\Unit;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    public function getAllUnits()
    {
        $units = collect(Unit::UNIT())->map(function ($item) {
            return [
                'id' => $item['code'],
                'name' => $item['label'] . '(' . $item['symbol'] . ')'
            ];
        });

        $response = [];
        $response["data"] = $units;
        $response['current_page'] = 1;
        $response['prev_page_url'] = "";
        $response['next_page_url'] = "";

        return response()->json($response, 200);
    }
}
