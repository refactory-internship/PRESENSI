<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\TimeSettingService;
use App\Models\Division;
use App\Models\TimeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TimeSettingController extends Controller
{
    private $index = 'web.admin.time-settings.index';
    private $timeSettingService;

    public function __construct(TimeSettingService $timeSettingService)
    {
        $this->timeSettingService = $timeSettingService;
    }

    public function index()
    {
        $times = Cache::remember('time_setting.all', 60, function () {
            return TimeSetting::all();
        });
        return view('admin.time-setting.index', compact('times'));
    }

    public function create()
    {
        $divisions = Division::query()->pluck('name', 'id');
        return view('admin.time-setting.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $this->timeSettingService->store($request);
        return redirect()->route($this->index)->with('message', 'Time Setting Added!');
    }

    public function edit(TimeSetting $timeSetting)
    {
        $divisions = Division::all();
        return view('admin.time-setting.edit', compact('timeSetting', 'divisions'));
    }

    public function update(Request $request, TimeSetting $timeSetting)
    {
        $this->timeSettingService->update($request, $timeSetting);
        return redirect()->route($this->index)->with('message', 'Time Setting Updated!');
    }

    public function destroy(TimeSetting $timeSetting)
    {
        $timeSetting->delete();
        return redirect()->route($this->index)->with('danger', 'Time Setting Deleted!');
    }
}
