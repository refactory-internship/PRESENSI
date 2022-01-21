<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\AbsentService;
use App\Http\Services\DateTimeService;
use App\Models\Absent;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AbsentController extends Controller
{
    private $absentService;
    private $dateTimeService;

    public function __construct(AbsentService $absentService, DateTimeService $dateTimeService)
    {
        $this->absentService = $absentService;
        $this->dateTimeService = $dateTimeService;
    }

    public function index()
    {
        $absents = $this->absentService->getAbsent();
        return view('user.absent.index', compact('absents'));
    }

    public function create()
    {
        $today = $this->dateTimeService->getCurrentDate()->toDateString();
        $last = Calendar::query()->orderBy('date', 'DESC')->first();
        $last = $last->date->format('Y-m-d');
        return view('user.absent.create', compact('today', 'last'));
    }

    public function store(Request $request)
    {
        $this->absentService->store($request);
        return redirect()->route('web.employee.absents.index')->with('message', 'Absent Submitted');
    }

    public function show($id)
    {
        $absent = Absent::query()->findOrFail($id);
        return view('user.absent.show', compact('absent'));
    }

    public function edit($id)
    {
        $today = $this->dateTimeService->getCurrentDate()->toDateString();
        $last = Calendar::query()->orderBy('date', 'DESC')->first();
        $last = $last->date->format('Y-m-d');
        $absent = Absent::query()->findOrFail($id);
        return view('user.absent.edit', compact('absent', 'today', 'last'));
    }

    public function update(Request $request, $id)
    {
        $this->absentService->update($request, $id);
        return redirect()->route('web.employee.absents.index')->with('message', 'Absent Updated');
    }

    public function destroy($id)
    {
        Absent::query()->findOrFail($id)->delete();
        return redirect()->route('web.employee.absents.index')->with('danger', 'Absent Deleted');
    }
}
