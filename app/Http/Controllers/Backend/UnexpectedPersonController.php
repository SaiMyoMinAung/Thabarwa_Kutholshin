<?php

namespace App\Http\Controllers\Backend;

use App\UnexpectedPerson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Select2\YogiSelect2ResourceCollection;

class UnexpectedPersonController extends Controller
{
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            ['name' => 'required|unique:unexpected_persons'],
            ['name.required' => 'Please Fill Name.']
        )->validate();

        $UnexpectedPerson = UnexpectedPerson::create($request->all());

        return response()->json($UnexpectedPerson, 200);
    }
    public function getAllUnexpectedPersons(Request $request)
    {
        $unexpectedPersons = UnexpectedPerson::where('name', 'like', '%' . $request->q . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return response()->json(new YogiSelect2ResourceCollection($unexpectedPersons), 200);
    }
}
