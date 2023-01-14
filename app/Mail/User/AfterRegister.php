<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterRegister extends Mailable
{
    use Queueable, SerializesModels;

    // Global Variable
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user) // parameter $user akan lempar ke $user di UserController.php
    {
        // lempar ke global variable
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // lempar $user __construct ke frontend nya afterRegister.blade.php
        return $this->subject('Registration on Laracamp')->markdown('emails.user.afterRegister', [
            'user' => $this->user
        ]);
    }
}
