<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\TimeSetting;
use Illuminate\Http\Request;

class TimeSettingController extends Controller
{
    private $index = 'web.admin.time-settings.index';

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
        return redirect()->route($this->index)->with('message', 'Time Setting Added!');
    }

    public function edit(TimeSetting $timeSetting)
    {
        $divisions = Division::all();
        return view('admin.time-setting.edit', compact('timeSetting', 'divisions'));
    }

    public function update(Request $request, TimeSetting $timeSetting)
    {
        $start_time = date('H:i', strtotime($request->start_time));
        $end_time = date('H:i', strtotime($request->end_time));
        $timeSetting->update([
            'division_id' => $request->division,
            'start_time' => $start_time,
            'end_time' => $end_time
        ]);
        return redirect()->route($this->index)->with('message', 'Time Setting Updated!');
    }

    public function destroy(TimeSetting $timeSetting)
    {
        $timeSetting->delete();
        return redirect()->route($this->index)->with('danger', 'Time Setting Deleted!');
    }
}
