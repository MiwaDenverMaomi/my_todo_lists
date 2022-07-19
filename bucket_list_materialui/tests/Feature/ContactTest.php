<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Inquiry;
use App\Mail\Notice;
use Validator;

class ContactTest extends TestCase
{
    protected $RULES=['name' => 'required|string|max:50',
        'title'=> 'required|string|max:100',
        'email' => 'required|email|max:50',
        'comment'=> 'required|max:1000',
    ];

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_send()
    {
        $request=new Request();
        $request->merge(['name'=>'zaza','title'=>'toiawase','email'=>'miwamurata08@gmail.com','comment'=>'test']);
        //validation
        $validator=Validator::make($request->all(),$this->RULES);

        //fail
        if($validator->fails()){
           return (response()->json([
                'result'=>false,
                'errors'=>$validator->errors()
            ]));
        }
        //success
        dump($request->input('email'));
        dump(config('mail.mailers.smtp.username'));
        Mail::to($request->input('email'))->send(new Inquiry($request));

        Mail::to(config('mail.mailers.smtp.username'))->send(new Notice($request));
         return (response()->json([
            'result'=>'Email was sent!',
            'errors'=>[]
        ]));
    }
}
