<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserPasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new text instance.
     *
     * @return void
     */
    protected $email;
    protected $text;
    protected  $url;

    public function __construct($email,$url,$text)
    {
        $this->email =$email;
        $this->url =$url;
        $this->text =$text;
    }

    /**
     * Build the text.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.password_reset')
          ->subject('Dating App Account password reset')
          ->with([
            'email'=>$this->email,
            'text'=>$this->text,
            'url'=>$this->url
          ]);
    }
}
