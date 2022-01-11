<?php

namespace Database\Seeders;

use App\Enums\ApprovalStatus;
use App\Enums\AttendanceApprover;
use App\Models\Calendar;
use App\Models\Overtime;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OvertimeSeeder extends Seeder
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

        $weekEndOfTheMonth = Calendar::query()
            ->where('description', '=', 'WEEK_END')
            ->where('month_name', '=', 'January')
            ->where('year', '=', '2022')
            ->first();

        Overtime::query()->create([
            'user_id' => $employee->id,
            'calendar_id' => $weekEndOfTheMonth->id,
            'approvedBy' => AttendanceApprover::PARENT,
            'approverId' => $employee->parent->id,
            'task_plan' => 'dummy task plan seeder #1',
            'start_time' => Carbon::createFromTimeString('19:00:00', 'Asia/Jakarta'),
            'duration' => 3,
            'note' => 'dummy overtime note seeder #1',
            'end_time' => Carbon::createFromTimeString('21:00:00', 'Asia/Jakarta'),
            'task_report' => 'dummy task report seeder #1',
            'isFinished' => true,
            'approvalStatus' => ApprovalStatus::APPROVED,
            'rejectionNote' => null
        ]);
    }
}
