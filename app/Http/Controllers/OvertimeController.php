<?php

namespace App\Http\Controllers;

use App\Http\Services\OvertimeService;
use App\Models\Attendance;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    private $overtimeService;

    public function __construct(OvertimeService $overtimeService)
    {
        $this->overtimeService = $overtimeService;
    }

    public function index()
    {
        $user = auth()->id();
        $attendances = Attendance::query()->where('user_id', $user)->where('isOvertime', true)->get();
        return view('user.overtime.index', compact('attendances'));
    }

    public function show($id)
    {
        $attendance = Attendance::query()->find($id);
        return view('user.overtime.show', compact('attendance'));
    }

    public function edit($id)
    {
        $attendance = Attendance::query()->find($id);
        return view('user.overtime.edit', compact('attendance'));
    }

    public function update(Request $request, $id)
    {
        $this->overtimeService->update($request, $id);
        return redirect()->route('web.employee.overtimes.index')->with('message', 'Overtime Updated!');
    }

    public function destroy($id)
    {
        Attendance::query()->find($id)->delete();
        return redirect()->route('web.employee.overtimes.index')->with('danger', 'Overtime Deleted!');
    }
}
