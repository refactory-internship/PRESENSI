<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CalendarService;
use App\Models\Calendar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    private $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    public function index()
    {
        $calendars = $this->calendarService->getCurrentDates();
        $years = $this->calendarService->pluckYears();
        $months = $this->calendarService->pluckMonths();
        return view('admin.calendar.index', compact('calendars', 'years', 'months'));
    }

    public function create()
    {
        $first = Calendar::query()->first();
        $last = Calendar::query()->orderBy('date', 'DESC')->first();
        $thisYear = date('Y', strtotime(Carbon::now()));
        $yearInterval = 5;
        return view('admin.calendar.create', compact('first', 'last', 'thisYear', 'yearInterval'));
    }

    public function store(Request $request)
    {
        $calendar = Calendar::query()
            ->where('year', $request->first_range)
            ->orWhere('year', $request->last_range)
            ->distinct()->value('year');

        if ($calendar) {
            return redirect()->back()->with('danger', 'Selected year already exists!');
        }

        $this->calendarService->store($request);
        return redirect()->route('web.admin.calendars.create')->with('message', 'New Calendar Added!');
    }

    public function update(Request $request, $id)
    {
        Calendar::query()->findOrFail($id)->update([
           'status' => $request->status,
           'description' => $request->description
        ]);
        return redirect()->back()->with('message', 'Date Status Updated');
    }

    public function search(Request $request)
    {
        $calendars = $this->calendarService->searchDates($request);
        $years = $this->calendarService->pluckYears();
        $months = $this->calendarService->pluckMonths();
        return view('admin.calendar.index', compact('calendars', 'years', 'months'));
    }
}
