@extends('layouts.app')

@section('content')
<div class="container-sm w-25 p-3">
	  <form method="post" action={{route('register.postRegister')}}>
    <h1 class="h3 mb-3 fw-normal mb-5">Create your account</h1>
    <div class="mb-3">
      <div class="text-center text-danger mb-0">
							@if (!empty($error))
							      {{$error}}
							@endif
			</div>
    <div class="text-center text-danger mb-0">
							@if ($errors->has('email'))
							  {{$errors->first('email')}}
							@endif
		</div>
    <div class="form-floating mb-3">
      <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com">
      <label for="email">Email address</label>
    </div>
    <div class="text-center text-danger mb-0">
							@if ($errors->has('password'))
							  {{$errors->first('password')}}
							@endif
		</div>
    <div class="form-floating mb-3">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      <label for="password">Password</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Confirm password">
      <label for="floatingPassword">Re-type your password</label>
    </div>
    </div>
    <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Create account</button>
  </form>
  <a class="btn btn-secondary" role="button" aria-disabled="false" href="{{route('bucket-lists.index')}}">Got to Top</a>
	 </div>
</div>
@endsection
