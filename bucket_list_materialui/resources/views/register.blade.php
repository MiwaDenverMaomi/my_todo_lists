@extends('layouts.common')

@section('title')
Create your account
@endsection

@section('content')
<div class="container-sm w-25 p-3">
	  <form method="post" action={{route('register.postRegister')}}>
    <div class="mb-3">
      <div class="text-center text-danger mb-0">
              {{!empty($error)?:''}}
			</div>
    <div class="text-center text-danger mb-0">
              {{$errors->has('email')?$errors->first('email'):''}}
		</div>
    <div class="form-floating mb-3">
      <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com">
      <label for="email">Email address</label>
    </div>
    <div class="text-center text-danger mb-0">
              {{$errors->has('password')?$errors->first('password'):''}}
		</div>
    <div class="form-floating mb-3">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      <label for="password">Password</label>
    </div>
    <div class="text-center text-danger mb-0">
						 {{$errors->has('re_password')?$errors->first('re_password'):''}}
		</div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Confirm password">
      <label for="floatingPassword">Re-type your password</label>
    </div>
    </div>
    <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Create account</button>
  </form>
</div>
@endsection
