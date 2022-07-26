<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

   public function getLogin(){
		return view('login');
	}

	public function postLogin(Request $request){
		\Log::debug($request);
		//validation
		$RULES=[
			'email'=>'required|email|max:255',
			'password'=>'required|max:255'
		];
		$validator=Validator::make($request->all(),$RULES,[
			'email.required'=>'Input required.',
			'email.email'=>'Input valid email address.',
			'email.max'=>'Input within 255 letters.',
			'password.required'=>'Input required.',
			'password.max'=>'Input within 255 letters.'
		]);

		if($validator->fails()){
			return back()
			->withErrors($validators)
			->withInput();
		}else{
            if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')],true)){
				\Log::info('Login ok');
				\Log::debug(Auth::id());
				\Log::debug(Auth::user());
				session()->flash('status','Logged in');

				return redirect()->route('bucket-lists.index');
			}else{
				return back()->with(['error'=>'Email/password is invalid.']);
			}
			// $user=DB::table('users')->where('email',$request->email)->first();
			// \Log::debug($user->email);
			// \Log::debug($user->password);

			// if(empty($user)){

			// 	return back()->with(['error'=>'Email/password is invalid.']);
			// }

			// if(Hash::check($request->password,$user->password)){
			// 	session(['user_id'=>$user->id]);
			// 	session(['email'=>$user->email]);
			// 	session()->flash('status','Logged in');
			// 	\Log::info('Logged in');

			// 	return redirect()->route('bucket-lists.index');
			// }else{
			// 	return back()->with(['error'=>'Email/password is invalid.']);
			// }
		}

	}

	public function logout(Request $request){
		// session()->forget('email');
		// session()->forget('user_id');
		Auth::logout();
		session()->flash('status','Logged out.');
		return redirect()->route('bucket-lists.index');
	}
}
