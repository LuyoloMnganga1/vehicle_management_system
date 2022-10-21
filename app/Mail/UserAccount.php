<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAccount extends Mailable
{
    use Queueable, SerializesModels;
public $name,$surname,$id,$token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$surname,$id,$token)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->id = $id;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('User Account Created')->view('email.userAccount');
    }
}
