<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $userId;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userId, $password)
    {
        $this->userId = $userId;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = User::query()->findOrFail($this->userId);
        return $this->markdown('email.welcome')
            ->subject('Welcome to Our Application!')
            ->with([
                'user' => $user,
                'password' => $this->password
            ]);
    }
}
