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
/**
* Gets page "Contact"
* @return Illuminate\View\View
*/
    public function getContact(){
        return view('contact');
    }
/**
* Posts title ,name, email, comments from user to the app.
* @param App\Http\Requests\ContactRequest $contactRequest
* @return Illuminate\View\View
*/
    public function postContact(ContactRequest $contactRequest){
     \Log::info('postContact');

        Mail::to($contactRequest->input('email'))->send(new Inquiry($contactRequest));
        Mail::to(config('mail.mailers.smtp.username'))->send(new Notice($contactRequest));

        if(count(Mail::failures())>0){
         //if email is sent
             return view('result',[
             'is_success'=>false,
             'message'=>'Sorry, your email was not sent...'
        ]);

        }else{
            //if email is not sent
            return view('result',[
            'is_success'=>true,
            'message'=>'Email was sent! We will reply in a few days.'
             ]);

        }

    }
}
