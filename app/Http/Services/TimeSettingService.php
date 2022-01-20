<?php


namespace App\Http\Services;


use App\Models\TimeSetting;
use Illuminate\Http\Request;

class TimeSettingService
{
    public function store(Request $request)
    {
        $start_time = date('H:i', strtotime($request->start_time));
        $end_time = date('H:i', strtotime($request->end_time));
        return TimeSetting::query()->create([
            'division_id' => $request->division,
            'start_time' => $start_time,
            'end_time' => $end_time
        ]);
    }

    public function update(Request $request, TimeSetting $timeSetting)
    {
        $start_time = date('H:i', strtotime($request->start_time));
        $end_time = date('H:i', strtotime($request->end_time));

        // cache()->forget('time_setting.all');

        return $timeSetting->update([
            'division_id' => $request->division,
            'start_time' => $start_time,
            'end_time' => $end_time
        ]);
    }
}
