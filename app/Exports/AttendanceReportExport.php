<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceReportExport implements FromView
{
    private Request $request;
    private int $id;

    public function __construct(Request $request, int $id)
    {
        $this->request = $request;
        $this->id = $id;
    }

    public function view(): View
    {
        $user = User::query()->findOrFail($this->id);
        $data = DB::table('attendance_master')
            ->where('user_id', $user->id)
            ->where('month', $this->request->month)
            ->where('year', $this->request->year)
            ->get();
        $month = \DateTime::createFromFormat('!m', $this->request->month)->format('F');

        return view('admin.report.attendance.export', compact('user', 'data', 'month'));
    }
}
