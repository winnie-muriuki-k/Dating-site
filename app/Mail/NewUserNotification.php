<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUserNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new text instance.
     *
     * @return void

    */

    public function __construct()
    {
    }

    /**
     * Build the text.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.new_account')
          ->subject('New Account Registration');
    }
}
