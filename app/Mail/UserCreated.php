<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $birthdate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $birthdate)
    {
        $this->name = $name;
        $this->email = $email;
        $this->birthdate = $birthdate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.created')
        ->subject('🎊 Your account has been created successfully! 🎊');
    }
}
