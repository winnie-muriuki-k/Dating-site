<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEmailVerificationNofication extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new text instance.
     *
     * @return void
     */
    protected $username;
    protected  $url;

    public function __construct($username,$url)
    {
        $this->username =$username;
        $this->url =$url;
    }

    /**
     * Build the text.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.email-verify')
          ->subject('Dating App Email Verification')
          ->with([
            'username'=>$this->username,
            'url'=>$this->url
          ]);
    }
}
