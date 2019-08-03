<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserBanNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new text instance.
     *
     * @return void
     */
    protected $username;
    protected $userMessage;
    protected $action;

    public function __construct($username,$userMessage,$action)
    {
        $this->username =$username;
        $this->action =$action;
        $this->userMessage =$userMessage;
    }

    /**
     * Build the text.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.user-ban')
          ->subject('Dating App Account Notification')
          ->with([
            'username'=>$this->username,
            'action'=>$this->action,
            'userMessage'=>$this->userMessage
          ]);
    }
}
