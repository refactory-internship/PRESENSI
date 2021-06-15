<?php

namespace App\Jobs;

use App\Mail\AttendanceNeedsApproval;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\at;

class EmailAttendanceApprovalRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $parentEmail;
    protected $user;
    protected $attendance;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($parentEmail, $user, $attendance)
    {
        $this->parentEmail = $parentEmail;
        $this->user = $user;
        $this->attendance = $attendance;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new AttendanceNeedsApproval($this->user, $this->attendance);
        Mail::to($this->parentEmail)->send($email);
    }
}
