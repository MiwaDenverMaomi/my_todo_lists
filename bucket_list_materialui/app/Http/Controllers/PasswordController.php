<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquents\UserRepository;
use App\Repositories\Eloquents\UserTokenRepository;

use App\Http\Requests\SendEmailRequest;
use App\Mail\UserResetPasswordMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

class PasswordController extends Controller
{
    private $userRepository;
    private $userTokenRepository;

    private const MAIL_SENT_SESSION_KEY= 'user_reset_password_mail_sended_action';

    public function __construct(
        UserRepository $userRepository,
        UserTokenRepository $userTokenRepository
    ){
      $this->userRepository=$userRepository;
      $this->userTokenRepository=$userTokenRepository;
    }

    public function getPasswordResetEmailForm(){
        return view('password_reset');
    }

    /**
     * Send Email to reset password
     * @param SendEmailRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postPasswordResetEmail(SendEmailRequest $sendEmailRequest){
        try{
            $user=$this->userRepository->findFromEmail($sendEmailRequest->email);
            $userToken=$this->userTokenRepository->updateOrCreateUserToken($user->id);
            Log::info(__METHOD__.'...ID:'.$user->id.'email is goint to be sent to...');
            Mail::send(new UserResetPasswordMail($user,$userToken));
            Log::info(__METHOD__.'...ID:'.$user->id.'email was sent to reset password.');
        }catch(Exception $e){
            Log::error(__METHOD__.'...failed to send email to reset password.');
            return redirect()->route('password_reset.email.form')->with('flash_message','Failed to send email.Please try again later.');
        }
        session()->put(self::MAIL_SENT_SESSION_KEY,'user_reset_password_send_email');

        return view('result',[
            'is_success'=>true,
            'message'=>'Email was sent! Check your email to find the link to reset password.']);
    }
}
