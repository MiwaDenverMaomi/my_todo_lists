<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function getLogin(){
		return view('login');
	}

	public function postLogin(Request $requset){
		//validation
		$RULES=[
			'email'=>'required|email|max:255',
			'password'=>'required|max:255'
		];
		$validator=Validator::make($request->all(),$RULES,[
			'email.required'=>'Input required.',
			'email.email'=>'Input valid email address.',
			'email.max'=>'Input within 255 letters.',
			'password.required'=>'Input required.',
			'password.max'=>'Input within 255 letters.'
		]);

		if($validator->fails()){
			return back()
			->withErrors($validators)
			->withInput();
		}else{

			$user=User::where('email',$request->email);
			if(empty($user)){
				return back()->with(['error'=>'Email/password is invalid.'])
			}

			if(Hash::check($request->password,$user[0]->password)){
				session([
					'user_id'=>$user[0]->id,
					'email'=>$user[0]->email
				]);
				session()->flash([
					'flash_flag'=>true,
					'flash_message'=>'Logged in'
				]);

				return redirect()->route('bucket-lists.index');
			}else{
                return back()->with('error'=>'Email/password is invalid.');
			}
		}

	}

	public function logout(Request $request){
		session()->forget('email');
		session()->forget('user_id');
		return redirect()->route('bucket-lists.index');
	}
}
