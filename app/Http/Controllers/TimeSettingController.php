<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\TimeSetting;
use Illuminate\Http\Request;

class TimeSettingController extends Controller
{
    public function index()
    {
        $times = TimeSetting::query()->paginate(5);
        return view('admin.time-setting.index', compact('times'));
    }

    public function create()
    {
        $divisions = Division::query()->pluck('name', 'id');
        return view('admin.time-setting.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $start_time = date('H:i', strtotime($request->start_time));
        $end_time = date('H:i', strtotime($request->end_time));
        TimeSetting::query()->create([
            'division_id' => $request->division,
            'start_time' => $start_time,
            'end_time' => $end_time
        ]);

        return redirect()->route('web.admin.time-settings.index')->with('message', 'Time Setting Added!');
    }

    public function show(TimeSetting $timeSetting)
    {
        //
    }

    public function edit(TimeSetting $timeSetting)
    {
        //
    }

    public function update(Request $request, TimeSetting $timeSetting)
    {
        //
    }

    public function destroy(TimeSetting $timeSetting)
    {
        //
    }
}
