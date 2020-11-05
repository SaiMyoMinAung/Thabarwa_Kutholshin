<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\StateRegion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResourceCollection;
use App\Http\Resources\CountryResourceCollection;

class Select2Controller extends Controller
{
    public function getCountries(Request $request)
    {
        $countries = Country::where('name', 'like', '%' . $request->q . '%')
            ->where('is_available', 1)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return response()->json(new CountryResourceCollection($countries), 200);
    }

    public function getStateRegions(Request $request)
    {
        $stateRegions = StateRegion::where('name', 'like', '%' . $request->q . '%')
            ->where('is_available', 1)
            ->where('country_id', $request->country_id)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return response()->json(new CountryResourceCollection($stateRegions), 200);
    }

    public function getCities(Request $request)
    {
        $cities = City::where('name', 'like', '%' . $request->q . '%')
            ->where('is_available', 1)
            ->where('state_region_id', $request->state_region_id)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return response()->json(new CityResourceCollection($cities), 200);
    }
}
