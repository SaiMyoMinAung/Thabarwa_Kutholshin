<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\StateRegion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\StateRegionResource;
use App\Http\Resources\CityResourceCollection;
use App\Http\Resources\CountryResourceCollection;

class Select2Controller extends Controller
{
    public function getAutoCompleteData(Request $request)
    {
        $data =  [
            // [
            //     'name' => 'Some Name',
            //     "logo" => "https://logo.clearbit.com/flymna.com"
            // ]
        ];
        return response()->json($data, 200);
    }

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

    public function getAutoSelectCountry()
    {
        $country = Country::where('name', 'Myanmar')->firstOrFail();

        return response()->json(new CountryResource($country), 200);
    }

    public function getAutoSelectStateRegion()
    {
        $stateRegion = StateRegion::where('name', 'Yangon')->firstOrFail();

        return response()->json(new StateRegionResource($stateRegion), 200);
    }

    public function getAutoSelectCity()
    {
        $city = City::where('name', 'Yangon City')->firstOrFail();

        return response()->json(new CityResource($city), 200);
    }
}
