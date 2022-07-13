<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class WelcomeNewUserMail extends Mailable 
{
    use Queueable, SerializesModels;

    public $support_email;
    public $user_email;
    public $subject;
    public $password;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($new_user)
    {
        $this->support_email = env('SUPPORT_EMAIL');

        $this->subject = $new_user['subject'];
        $this->user_email = $new_user['email'];
        $this->password = $new_user['password'];
        $this->name = $new_user['first_name'].' '.$new_user['last_name'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject($this->subject)
                    ->from($this->support_email)
                    ->to($this->user_email)
                    ->view('emails.new-welcome');

    }
}
