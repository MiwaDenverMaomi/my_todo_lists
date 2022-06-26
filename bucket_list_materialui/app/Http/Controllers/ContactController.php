<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Inquiry;
use Validator;

class ContactController extends Controller
{
    const RULES= ['name' => 'required|string|max:50',
        'title'=> 'reruired|string|max:100',
        'email' => 'required|email|max:255',
        'comment'=> 'required|email|max:1000',
    ];

    public function send(Request $request){
        //validation
        $validator=Validator::make($request->only('name','title','email','comment',self::RULES));

        //fail
        if($validator->fails()){
            return response()->json([
                'result'=>false,
                'errors'=>self::formatErrors($validator->errors())
            ]);
        }
        //success
        Mail::to($request->input('email'))->send(new Inquiry());
        Mail::to($request->config('MAIL_FROM_ADDRESS'))->send(new Notice());
        return response()->json([
            'result'=>'Email was sent!',
            'errors'=>[]
        ]);
    }
}
