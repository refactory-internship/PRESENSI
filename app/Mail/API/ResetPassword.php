<?php

namespace App\Mail\API;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $userId;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userId, $token)
    {
        $this->userId = $userId;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = User::query()->findOrFail($this->userId);
        return $this->markdown('email.password.API.reset')
            ->subject('Reset Password Request')
            ->with([
                'user' => $user,
                'token' => $this->token
            ]);
    }
}
