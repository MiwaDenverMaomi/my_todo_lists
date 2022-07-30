<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\Inquiry;
use App\Mail\Notice;
use Validator;

class ContactController extends Controller
{
    protected $RULES= [
        'name' => 'required|string|max:50',
        'title'=> 'reruired|string|max:100',
        'email' => 'required|email|max:255',
        'comment'=> 'required|email|max:1000',
    ];

    public function getContact(){
        return view('contact');
    }

    public function postContact(ContactRequest $contactRequest){
     \Log::info('postContact');
        //if validation success
        Mail::to($contactRequest->input('email'))->send(new Inquiry($contactRequest));
        Mail::to(config('mail.mailers.smtp.username'))->send(new Notice($contactRequest));

        if(count(Mail::failures())>0){
             return view('result',[
             'is_success'=>false,
             'message'=>'Sorry, your email was not sent...'
        ]);
        }else{
              return view('result',[
            'is_success'=>true,
            'message'=>'Email was sent! We will reply in a few days.'
             ]);

        }

    }
}
