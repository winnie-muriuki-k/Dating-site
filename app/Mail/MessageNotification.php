<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new text instance.
     *
     * @return void
     */
    protected $initiator;
    protected $recipient;

    public function __construct($initiator_username,$recipient_username)
    {
        $this->initiator =$initiator_username;
        $this->recipient =$recipient_username;
    }

    /**
     * Build the text.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.message-notification')
          ->subject('Dating App Message Notification')
          ->with([
            'initiator'=>$this->initiator,
            'recipient'=>$this->recipient
          ]);
    }
}
