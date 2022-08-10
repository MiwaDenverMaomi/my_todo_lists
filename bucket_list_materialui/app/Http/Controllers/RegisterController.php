<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;
use \Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    private $RULES=[
            'email'=>'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',//userテーブルでemailのカラムがidカラムがNULLのものを除き、deleted_atがNULLのものが存在するかを確認するという内容になる。
            'password'=>'required|min:8|max:255|confirmed',
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
        'password.required'=>'Input required.',
        'password.max'=>'Input within 255 letters.',
        'password.min'=>'Input 8 - 255 letters.',
        'password.confirmed'=>'Passwords are not matched.'
      ]);
      if($validator->fails()){
        return back()
        ->withErrors($validator)
        ->withInput();
     }else{
      try{
       $user=User::create([
        'email'=>$request->email,
        'password'=>\Hash::make($request->password)
        ]);

        if(!empty($user)){
          Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]);
          session()->flash('is_userinfo_hide',true);
          return view('result')
          ->with([
            'is_success'=>true,
            'message'=>'Your account was created!']);
        }else{
          throw new \Exception('$user is empty!');
        }
      }catch(\Exception $e){
        \Log::debug(__METHOD__.':$e:'.$e->getMessage());
         return view('register')
        ->with(['register_result'=>'Failed to create your account. Please try again later!']);
      }
     }
    }

    public function getCancel(){
        return view('cancel');
    }

    public function cancel(User $user){
        \Log::info('cancel');
        $model=User::where('id','=',Auth::id())->first();
        $this->authorize('checkUser',$model);
        $result=$user->delete();
        \Log::debug($result);

        if($result===true){
            session()->flash('is_userinfo_hide',true);
           return view('result')
           ->with([
            'is_success'=>true,
            'message'=>'Thank you for using our app!']);
        }else{
           return view('cancel')->with(
            ['cancel_result'=>'You failed to cancel. Please try again later!']);
        }
    }
}
