<?php

namespace App\Http\Controllers\Backend;

use App\Unit;
use App\Http\Controllers\Controller;
use App\Http\Resources\Select2\UnitSelect2ResourceCollection;

class UnitController extends Controller
{
    public function getAllUnits()
    {
        $units = Unit::query();

        $data = $units->orderBy('id', 'desc')->paginate(5);

        return response()->json(new UnitSelect2ResourceCollection($data), 200);
    }
}
