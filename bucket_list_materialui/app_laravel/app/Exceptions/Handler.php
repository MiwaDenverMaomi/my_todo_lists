<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;
class Handler extends ExceptionHandler
{
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array<int, class-string<Throwable>>
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array<int, string>
	 */
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	/**
	 * Register the exception handling callbacks for the application.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->reportable(function (Throwable $e) {
			//
		});
	}

	// public function render($request,Throwable $e){
	// 	if($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException){
	// 	 return response()->view('errors.error',[
	// 		'title'=>'This Method Not Allowed',
	// 		'message'=>'You are not allowed to use this method. Sorry!'
	// 	]);
	// 	}else if(){}
	// 	return parent::render($request,$exception);
	// }

	//Renders specified template to notice errors.
    // protected function renderHttpException(HttpException $e){
	// 	$status=$e->getStatusCode();
	// 	return response()->view("errors.error",[
	// 		'exception'=>$e,
	// 		'message'=>$e->getMessage(),
	// 		'status_code'=>$status
	// 	],$status,$e->getHeaders());
	// }
	//Set errors other than HTTP errors to HTTP errors to display "Whoops!".
	// protected function prepareResponse($request,Exception $e){
	// 	if(!$this->isHttpException($e)&&!config('app.debug')){
	// 		$e=new HttpException(500,$e->getMessage(),$e);
	// 	}
	// 	 return parent::prepareResponse($request, $e);
	// }
}
