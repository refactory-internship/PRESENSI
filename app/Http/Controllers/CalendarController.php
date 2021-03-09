<?php

namespace App\Http\Controllers;

use App\Http\Services\CalendarService;
use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    private $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    public function create()
    {
        $first = Calendar::query()->first();
        $last = Calendar::query()->orderBy('date', 'DESC')->first();
        return view('admin.calendar.create', compact('first', 'last'));
    }

    public function store(Request $request)
    {
        $this->calendarService->store($request->first_range, $request->last_range);
        return redirect()->route('web.calendars.create')->with('message', 'New Calendar Added!');
    }
}
