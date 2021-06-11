<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AutoApproveAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:approve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for automatically approve attendance when the attendance is not approved until midnight';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $attendance =  Attendance::query()
            ->where('approvalStatus', '=', null)
            ->orWhere('approvalStatus', '=', 1)
            ->get();

        foreach ($attendance as $data) {
            $data->update([
                'approvalStatus' => 2
            ]);
        }
        return 'All Attendance Approved!';
    }
}
