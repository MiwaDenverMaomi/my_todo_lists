<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use \Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    protected $RULES=[
            'name'=>'max:50',
            'email'=>'required|email|max:50|unique:users',
            'password'=>'required'
        ];

    public function register(Request $request){
        $validator=Validator::make($request->all(),$this->RULES);
    if($validator->fails()){
        return (response()->json([
            'result'=>$validator->messages(),'errors'=>$validator->errors(), 'status'=>Response::HTTP_UNPROCESSABLE_ENTITY
        ]));
    }

    $user=User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>\Hash::make($request->password)
    ]);

    return $user?response()->json($user,201):json([],501);

    }
}
