<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->data=$request->only('name','title','email','comment');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        dump('Notice');
        dump($this->data);
        return $this->view('emails.notice')
        ->subject('We have got inquiry.')
        ->with(['data'=>$this->data]);
    }
}
