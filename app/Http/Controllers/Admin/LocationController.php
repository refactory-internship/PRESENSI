<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class LocationController extends Controller
{
    public function getCities($id)
    {
        $cities = City::query()->where('province_id', $id)->pluck('name', 'id');
        return response()->json($cities);
    }

    public function getDistricts($id)
    {
        $districts = District::query()->where('city_id', $id)->pluck('name', 'id');
        return response()->json($districts);
    }

    public function getVillages($id)
    {
        $villages = Village::query()->where('district_id', $id)->pluck('name', 'id');
        return response()->json($villages);
    }
}
