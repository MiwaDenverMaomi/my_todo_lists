<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\UserToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class UserResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $userToken;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param UserToken $userToken
     */
    public function __construct(User $user,
        UserToken $userToken)
    {
        $this->userToken=$userToken;
        $this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tokenParam=['reset_token'=>$this->userToken->token];
        $now=Carbon::now();

        $url=URL::temporarySignedRoute('password_reset.edit',$now->addHours(48),$tokenParam);
        return $this->from(config('MAIL_USERNAME'),config('APP_NAME'));
        ->to($this->user->email)
        ->subject('Reset password')
        ->view('password_reset_mail')
        ->with([
            'user'=>$this->user,
            'url'=>$url,
        ]);
        return $this->view('view.name');
    }
}
