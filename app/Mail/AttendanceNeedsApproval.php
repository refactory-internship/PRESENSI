<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AttendanceNeedsApproval extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $attendance;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $attendance)
    {
        $this->user = $user;
        $this->attendance = $attendance;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.attendance.attendance-approval')
            ->subject('Attendance Approval Request')
            ->with([
                'user' => $this->user,
                'attendance' => $this->attendance
            ]);
    }
}
