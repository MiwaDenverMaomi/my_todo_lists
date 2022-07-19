<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $requset){
        //validation
        $RULES=[
            'email'=>'required|email|max:50',
            'password'=>'required|max:50'
        ];
        $validator=Validator::make($request->all(),$RULES);

        if($validator->fails()){
            return response()->json([
                'result'=>false,
                'errors'=>$validator->messages(),'status'=>Response::HTTP_UNPROCESSABLE_ENTITY
            ]);
        }

        //login

        if(Auth::attempt($request->only(['email','password']))){

        }

    }
}
