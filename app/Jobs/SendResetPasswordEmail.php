<?php

namespace App\Jobs;

use App\Mail\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendResetPasswordEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $recipient;
    protected $userId;
    protected $token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recipient, $userId, $token)
    {
        $this->recipient = $recipient;
        $this->userId = $userId;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new ResetPassword($this->userId, $this->token);
        Mail::to($this->recipient)->send($email);
    }
}
