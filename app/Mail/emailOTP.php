<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class emailOTP extends Mailable
{
    use Queueable, SerializesModels;
    public $name,$surname, $mesg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$surname, $mesg)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->mesg = $mesg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('OTP verification')->view('email.OTP');
    }
}
