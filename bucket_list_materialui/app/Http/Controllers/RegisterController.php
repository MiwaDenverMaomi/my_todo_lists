<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use \Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    protected $RULES=[
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required|max:255',
            're_password'=>'required|confirmed'
        ];

    public function getRegister(){
      \Log::Info('getRegister');
      return view('register');
    }

    public function postRegister(Request $request){
      \Log::info('postRegister');
      $validator=Validator::make($request->all(),$this->RULES,[
        'email.required'=>'Input required.',
        'email.email'=>'Input valid email.',
        'email.max'=>'Input within 255 letters.',
        'email.unique'=>'This email is already used.',
        'passowrd.required'=>'Input required.',
        'password.max'=>'Input within 255 letters.',
        're_password.required'=>'Input required.',
        're_password.confirmed'=>'Confirm your password.'
      ]);
      if($validator->fails()){
        return back()
        ->withErrors($validator)
        ->withInput();
     }else{
        $user=User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>\Hash::make($request->password)
        ]);

        if(!empty($user)){
          return view('result')
          ->with([
            'is_success'=>true,
            'message'=>'Your account was created!']);
        }else{
// 　　　　　 return back()->with(['register_error'=>'Failed to create your account. Please try again later!']);
        }
     }
    }
}
