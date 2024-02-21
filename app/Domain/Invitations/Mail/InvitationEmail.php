<?php

namespace DDD\Domain\Invitations\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        // return $this->view('emails.invitation');
        return $this->subject('You\'ve been invited to join the BloomCU team')
            ->view('emails.invitation');
    }
}
