<?php

namespace Database\Seeders;

use App\Enums\ApprovalStatus;
use App\Enums\AttendanceApprover;
use App\Models\Attendance;
use App\Models\Calendar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
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

        $workingDaysOfTheMonth = Calendar::query()
            ->where('description', '=', 'WEEK_DAY')
            ->where('month_name', '=', 'January')
            ->where('year', '=', '2022')
            ->limit(15)
            ->get();

        foreach ($workingDaysOfTheMonth as $key => $workingDay) {
            Attendance::query()->create([
                'user_id' => $employee->id,
                'calendar_id' => $workingDay->id,
                'approvedBy' => AttendanceApprover::PARENT,
                'approverId' => $employee->parent->id,
                'isQRCode' => false,
                'gps_lat' => null,
                'gps_long' => null,
                'task_plan' => json_encode(['dummy task plan seeder #' . ($key + 1)]),
                'clock_in_time' => Carbon::createFromTimeString('08:45:00', 'Asia/Jakarta'),
                'note' => 'dummy attendance note seeder #' . ($key + 1),
                'task_report' => 'dummy task report seeder #' . ($key + 1),
                'clock_out_time' => Carbon::createFromTimeString('17:45:00', 'Asia/Jakarta'),
                'isFinished' => true,
                'approvalStatus' => ApprovalStatus::APPROVED,
                'rejectionNote' => null
            ]);
        }
    }
}
