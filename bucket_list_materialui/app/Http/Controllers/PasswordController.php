<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquents\UserRepository;
use App\Repositories\Eloquents\UserTokenRepository;

use App\Http\Requests\ResetPasswordRequest;
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

			Mail::to($sendEmailRequest->input('email'))->send(new UserResetPasswordMail($user,$userToken));
			Log::info(__METHOD__.'...ID:'.$user->id.'email was sent to reset password.');
		}catch(Exception $e){
			Log::error(__METHOD__.'...failed to send email to reset password.');
			\Log::debug($e->getMessage());

			return back()->with(['passwordResetEmail_error'=>'Failed to send email.Please try again later.']);
		}
		session()->put(self::MAIL_SENT_SESSION_KEY,'user_reset_password_send_email');

		return redirect()->route('password_reset.email.send_complete');
	}

	/**

	* @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	*/
	public function sendComplete(){
		if(session()->pull(self::MAIL_SENT_SESSION_KEY)!=='user_reset_password_send_email'){
			return view('result',[
				'is_success'=>false,
				'message'=>'Invalid request...'
			]);
		}
		return view('result',[
			'is_success'=>true,
			'message'=>'Your email was sent!'
		]);
	}
	public function editPassword(Request $request){
		\Log::info('editPassword');
		\Log::debug($request);
		if(!$request->hasValidSignature()){
			abort(403,'This link is expired.Re send email address to reset your password.');
		}
		$resetToken=$request->reset_token;
		try{
			$userToken=$this->userTokenRepository->getUserTokenFromToken($resetToken);
		}catch(Exception $e){
			Log::error(__METHOD__.' Failed to get user token. Error message= '.$e->getMessage());
			return redirect()->route('password_reset.email.form')->with('edit_password_error',__('Access the link attached on your email.'));
		}
		\Log::info('editPassword_ok');
		return view('edit_new_password')
		->with('userToken',$userToken);
	}

	/**
	* Update password
	* @param ResetPasswordRequest $request
	* @return \Illuminate\Http\RedirectResponse
	*/
	public function updatePassword(ResetPasswordRequest $request){
		\Log::info('updatePassword');
		try{
			$userToken=$this->userTokenRepository->getUserTokenFromToken($request->reset_token);
			$this->userRepository->updateUserPassword($request->password,$userToken->user_id);
			\Log::info(__METHOD__.'...ID:'.$userToken->user_id." password was updated.");
		}catch(Exception $e){
			\Log::error(__METHOD__.'...ID:'." failed to update password. Error message:".$e->getMessage());
			return redirect()->route('password_reset.email.form')->with('flash_message',__('Access the link attached on your email.'));

		}
		$request->session()->put(self::UPDATE_PASSWORD_SESSION_KEY,'user_update_password');

		return redirect()->route('password_reset.edit_complete');
	}

	public function edit_complete(){
		if(session()->pull(self::UPDATE_PASSWORD_SESSION_KEY)!=='user_update_password'){
			return redirect()->route('password_reset.email.form')->with('flash_message','Invalid request.');
		}
		return view('result')->with([
			'is_success'=>true,
			'message'=>'Password resetting is completed!']);
	}
}
