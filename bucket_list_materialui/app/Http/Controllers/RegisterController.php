<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;
use \Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    protected $RULES=[
            'email'=>'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',//userテーブルでemailのカラムがidカラムがNULLのものを除き、deleted_atがNULLのものが存在するかを確認するという内容になる。
            'password'=>'required|max:255|confirmed',
        ];

    public function getRegister(){
      \Log::Info('getRegister');
      return view('register');
    }

    public function postRegister(Request $request){
      \Log::info('postRegister');
      \Log::debug($request);
      $validator=Validator::make($request->all(),$this->RULES,[
        'email.required'=>'Input required.',
        'email.string'=>'Input string.',
        'email.email'=>'Input valid email.',
        'email.max'=>'Input within 255 letters.',
        'email.unique'=>'This email is already used.',
        'passowrd.required'=>'Input required.',
        'password.max'=>'Input within 255 letters.',
        'password.confirmed'=>'Confirm your password.'
      ]);
      if($validator->fails()){
        return back()
        ->withErrors($validator)
        ->withInput();
     }else{
        $user=User::create([
        'email'=>$request->email,
        'password'=>\Hash::make($request->password)
        ]);

        if(!empty($user)){
          Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]);
          return view('result')
          ->with([
            'is_success'=>true,
            'message'=>'Your account was created!']);
        }else{
// 　　　　　 return back()->with(['register_error'=>'Failed to create your account. Please try again later!']);
        }
     }
    }

    public function getCancel(){
        return view('cancel');
    }

    public function cancel(User $user){
        \Log::info('cancel');
        $result=$user->delete();
        \Log::debug($result);
        if($result===true){
           return view('result')
           ->with([
            'is_success'=>true,
            'message'=>'You canceled the membership.']);
        }else{
           return back()->with(
            ['cancel_err'=>'You failed to cancel. Please try again later!']);
        }
    }
}
