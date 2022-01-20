<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CalendarService;
use App\Http\Services\DateTimeService;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CalendarController extends Controller
{
    private $calendarService;
    private $dateTimeService;

    public function __construct(CalendarService $calendarService, DateTimeService $dateTimeService)
    {
        $this->calendarService = $calendarService;
        $this->dateTimeService = $dateTimeService;
    }

    public function index()
    {
        // if (Cache::has('calendars.all')) {
        //     $calendars = Cache::get('calendars.all');
        // } else {
        //     $calendars = Cache::remember('calendars.all', 60, function () {
        //         return $this->calendarService->getCurrentDates();
        //     });
        // }

        $calendars = $this->calendarService->getCurrentDates();
        $years = $this->calendarService->pluckYears();
        $months = $this->calendarService->pluckMonths();
        return view('admin.calendar.index', compact('calendars', 'years', 'months'));
    }

    public function create()
    {
        $first = Calendar::query()->first();
        $last = Calendar::query()->orderBy('date', 'DESC')->first();
        $currentDate = $this->dateTimeService->getCurrentDate();
        $thisYear = date('Y', strtotime($currentDate));
        $yearInterval = 6;
        return view('admin.calendar.create', compact('first', 'last', 'thisYear', 'yearInterval'));
    }

    public function store(Request $request)
    {
        $calendar = Calendar::query()
            ->where('year', $request->first_range)
            ->orWhere('year', $request->last_range)
            ->distinct()->value('year');

        $first_year = $request->first_range;
        $last_year = $request->last_range;

        if ($calendar) {
            return redirect()->back()->with('danger', 'Selected year already exists!');
        }

        $this->calendarService->store($first_year, $last_year);
        Cache::forget('calendars.all');
        return redirect()->route('web.admin.calendars.create')->with('message', 'New Calendar Added!');
    }

    public function update(Request $request, $id)
    {
        Calendar::query()->findOrFail($id)->update([
            'status' => $request->status,
            'description' => $request->description
        ]);
        Cache::forget('calendars.all');
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
