<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class send_reply extends Mailable
{
    use Queueable, SerializesModels;
    public $request;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request,$email)
    {
        //
        $this->request = $request;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)->view('email.reply')->subject(trans('lang.contact_us'));
    }
}
