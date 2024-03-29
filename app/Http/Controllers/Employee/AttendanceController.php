<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\AttendanceService;
use App\Http\Services\DateTimeService;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class AttendanceController extends Controller
{
    private $attendanceService;
    private $dateTimeService;

    public function __construct(AttendanceService $attendanceService, DateTimeService $dateTimeService)
    {
        $this->attendanceService = $attendanceService;
        $this->dateTimeService = $dateTimeService;
    }

    public function index()
    {
        // $cachedAttendances = Redis::get('attendances.all');
        // if  (isset($cachedAttendances)) {
        //     $attendances = json_decode($cachedAttendances, false);
        // } else {
        //     $attendances = $this->attendanceService->getAttendance();
        //     Redis::set('attendances.all', $attendances);
        // }

        // if (Cache::has('attendance.all')) {
        //     $attendances = Cache::get('attendance.all');
        // } else {
        //     $attendances = Cache::remember('attendance.all', 60, function () {
        //         return $this->attendanceService->getAttendance();
        //     });
        // }

        $attendances = $this->attendanceService->getAttendance();

        return view('user.attendance.index', compact('attendances'));
    }

    public function create()
    {
        //variable to be used on the script section
        $currentDate = $this->dateTimeService->getCurrentDate();
        $date = $this->dateTimeService->getDateFromDatabase();
        return view('user.attendance.create', compact('date', 'currentDate'));
    }

    public function store(Request $request)
    {
        $this->attendanceService->store($request);
        return redirect()->route('web.employee.attendances.index')->with('message', 'Attendance Submitted!');
    }

    public function show($id)
    {
        $attendance = Attendance::query()->findOrFail($id);
        $tasks = json_decode($attendance->task_plan);
        return view('user.attendance.show', compact('attendance', 'tasks'));
    }

    public function edit($id)
    {
        $currentDate = $this->dateTimeService->getCurrentDate();
        $attendance = Attendance::query()->findOrFail($id);
        $tasks = json_decode($attendance->task_plan);

        return view('user.attendance.edit', compact('attendance', 'currentDate', 'tasks'));
    }

    public function update(Request $request, $id)
    {
        $this->attendanceService->update($request, $id);
        return redirect()->route('web.employee.attendances.index')->with('message', 'Attendance Updated!');
    }

    public function destroy($id)
    {
        Attendance::query()->findOrFail($id)->delete();
        // cache()->forget('attendance.all');
        return redirect()->route('web.employee.attendances.index')->with('danger', 'Attendance Deleted!');
    }
}
