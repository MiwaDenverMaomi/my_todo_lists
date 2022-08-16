<?php

namespace App\Http\Controllers;

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

		/**
     * Validation rules
     */
		private $RULES=[
			'email'=>'required|string|email:filter,dns|max:255',
			'password'=>'required|min:8|max:255'
		];


    /**
     * Gets page "Login"
     * @return Illuminate\View\View
     */
   public function getLogin(){
		return view('login');
	}
    /**
     * Posts the email, apssword to log in.
		 * @param Illuminate\Http\Request $request
		 * @return Illuminate\Http\RedirectResponse|Illuminate\View\View
     */
	public function postLogin(Request $request){
		\Log::debug($request);

		//validation messages
		$validator=Validator::make($request->all(),$this->RULES,[
			'email.required'=>'Input required.',
			'email.email'=>'Input valid email address.',
			'email.string'=>'Input string.',
			'email.max'=>'Input within 255 letters.',
			'password.required'=>'Input required.',
			'password.min'=>'Input 8 - 255 letters.',
			'password.max'=>'Input within 255 letters.'
		]);

		if($validator->fails()){
			return back()
			->withErrors($validator)
			->withInput();

		}else{

			try{
        $remember=$request->rememtber;
        if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')],$remember)){
				\Log::info('Login ok');
				\Log::debug(Auth::id());
				\Log::debug(Auth::user());
				return redirect()->route('bucket-lists.index');

				}else{
				throw new \Exception('Failed to Auth::attempt.');
			}

			}catch(\Exception $e){
				\Log::debug(__METHOD__.':$e:'.$e->getMessage());
				return view('login')->with(['login_result'=>'Email/password is invalid.']);
			}
		}
	}
    /**
     * Log out
		 * @param \Illuminate\Http\Request $request
     * @return Illuminate\Http\RedirectResponse
     */
	public function logout(Request $request){
		Auth::logout();
		return redirect()->route('bucket-lists.index')->with('status','You logged out.');
	}
}
