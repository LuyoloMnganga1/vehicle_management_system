<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notifyuser extends Mailable
{
    use Queueable, SerializesModels;
    public $admin,$super,$user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin,$super,$user)
    {
        $this->admin = $admin;
        $this->super = $super;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Leave Application Feedback')->view('email.notifyuser');
    }
}
