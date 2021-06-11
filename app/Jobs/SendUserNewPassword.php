<?php

namespace App\Jobs;

use App\Mail\UserNewPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendUserNewPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $recipient;
    protected $password;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recipient, $password)
    {
        $this->recipient = $recipient;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new UserNewPassword($this->password);
        Mail::to($this->recipient)->send($email);
    }
}
