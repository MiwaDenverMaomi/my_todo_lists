<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register()
    {
        $RULES=[
            'name'=>'max:50',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ];

        $request=new Request();
        $request->merge([
            'name'=>'',
            'email'=>'xxb@example.com',
            'password'=>'abcdef'
        ]);
        $validator=Validator::make($request->all(),$RULES);
    if($validator->fails()){
        dump('fails');
        dump($validator->errors());
        dump(response()->json(['result'=>false,'errors'=>$validator->errors()]));
    }

    $user=User::create([
        'name'=>\Func::convertEmptyValueToNull($request->name),
        'email'=>$request->email,
        'password'=>\Hash::make($request->password)
    ]);
    dump($user);
    dump($user?'success':'failed');
    return $user?response()->json($user,201):json([],501);
    }
    }
