<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class CheckPermissionController extends Controller
{
    public function check(Request $request)
    {
        $name = $request->permission;

        $can = auth()->user()->can($name);

        return  response()->json($can, 200);
    }
}
