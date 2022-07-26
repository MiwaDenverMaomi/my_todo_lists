@extends('layouts.common')

@section('title')
Login
@endsection

@section('content')
<div class="container-sm w-25 p-3">
	  <form method="post" action={{route('login.postLogin')}}>
    <div class="mb-3">
      <div class="text-center text-danger mb-0">
              {{!empty($error)?$error:''}}
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
    <label>
        <input type="checkbox" name="remember" value="remember-me"> Remember me
    </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Log in</button>
    <a class="d-block mb-3" href="{{route('register.getRegister')}}">Create your account</a>
  </form>
</div>
@endsection
