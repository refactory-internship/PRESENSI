<?php

namespace Database\Seeders;

use App\Enums\ApprovalStatus;
use App\Enums\AttendanceApprover;
use App\Models\Absent;
use App\Models\Calendar;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = User::query()
            ->whereHas('role', function ($query) {
                $query->where('name', '=', 'Employee');
            })->first();

        $datesForAbsent = Calendar::query()
            ->doesntHave('attendance')
            ->whereNotIn('id', DB::table('overtimes')->pluck('calendar_id'))
            ->where('description', '=', 'WEEK_DAY')
            ->where('month_name', '=', 'January')
            ->where('year', '=', '2022')
            ->limit(7)
            ->get();

        foreach ($datesForAbsent as $key => $date) {
            Absent::query()->create([
                'user_id' => $employee->id,
                'calendar_id' => $date->id,
                'approvedBy' => AttendanceApprover::PARENT,
                'approverId' => $employee->parent->id,
                'reason' => 'dummy absent reason #' . ($key + 1),
                'date' => $date->date,
                'approvalStatus' => ApprovalStatus::APPROVED,
            ]);
        }
    }
}
