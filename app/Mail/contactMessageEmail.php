<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class contactMessageEmail extends Mailable 
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;
    public $email;
    public $bodyMessage;
    public $contact_us_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message_info)
    {
        $this->name = $message_info['name'];
        $this->subject = $message_info['subject'];
        $this->email = $message_info['email'];
        $this->bodyMessage = $message_info['message'];
        $this->contact_us_email =  env('CONTACT_US_EMAIL');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->subject($this->subject)
                    ->from($this->email)
                    ->to($this->contact_us_email)
                    ->view('emails.contactMessage');
    }
}
