<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\DateTimeService;
use App\Http\Services\OvertimeService;
use App\Models\Overtime;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    private $overtimeService;
    private $dateTimeService;

    public function __construct(OvertimeService $overtimeService, DateTimeService $dateTimeService)
    {
        $this->overtimeService = $overtimeService;
        $this->dateTimeService = $dateTimeService;
    }

    public function index()
    {
        $user = auth()->id();
        $overtimes = Overtime::query()->where('user_id', $user)->get();
        return view('user.overtime.index', compact('overtimes'));
    }

    public function create()
    {
        $currentDate = $this->dateTimeService->getCurrentDate();
        $date = $this->dateTimeService->getDateFromDatabase();
        return view('user.overtime.create', compact('date', 'currentDate'));
    }

    public function store(Request $request)
    {
        $this->overtimeService->store($request);
        return redirect()->route('web.employee.overtimes.index')->with('message', 'Overtime Submitted!');
    }

    public function show($id)
    {
        $overtime = Overtime::query()->findOrFail($id);
        return view('user.overtime.show', compact('overtime'));
    }

    public function edit($id)
    {
        $overtime = Overtime::query()->findOrFail($id);
        return view('user.overtime.edit', compact('overtime'));
    }

    public function update(Request $request, $id)
    {
        $this->overtimeService->update($request, $id);
        return redirect()->route('web.employee.overtimes.index')->with('message', 'Overtime Updated!');
    }

    public function destroy($id)
    {
        Overtime::query()->findOrFail($id)->delete();
        return redirect()->route('web.employee.overtimes.index')->with('danger', 'Overtime Deleted!');
    }

    public function updateOvertimeProgress(Request $request, $id)
    {
        $this->overtimeService->updateOvertimeProgress($request, $id);
        return redirect()->route('web.employee.overtimes.index')->with('message', 'Overtime Progress Updated!');
    }
}
