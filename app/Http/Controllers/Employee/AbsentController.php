<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\AbsentService;
use App\Models\Absent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AbsentController extends Controller
{
    private $absentService;

    public function __construct(AbsentService $absentService)
    {
        $this->absentService = $absentService;
    }

    public function index()
    {
        $absents = $this->absentService->getAbsent();
        return view('user.absent.index', compact('absents'));
    }

    public function create()
    {
        return view('user.absent.create');
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
        $absent = Absent::query()->findOrFail($id);
        return view('user.absent.edit', compact('absent'));
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
