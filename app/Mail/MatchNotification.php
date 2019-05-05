<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MatchNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new text instance.
     *
     * @return void
     */
    protected $initiator;
    protected $recipient;

    public function __construct($initiator=null,$recipient=null)
    {
        $this->initiator =$initiator;
        $this->recipient =$recipient;
    }

    /**
     * Build the text.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.match-notification')
          ->subject('Dating App Notification')
          ->with([
            'initiator'=>$this->initiator,
            'recipient'=>$this->recipient
          ]);
    }
}
