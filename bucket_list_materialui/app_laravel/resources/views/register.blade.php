@extends('layouts.common')

@section('title')
Create your account
@endsection

@section('content')
<div class="container-sm col-md-5 col-lg-4 p-3">
	  <form method="post" action="{{route('register.postRegister')}}">
    <div class="mb-3">
    @if(!empty($register_result))
    <div class="text-danger mb-0">
              {{$register_result}}
		</div>
    @enderror
     @error('email')
    <div class="text-danger mb-0">
              {{$message}}
		</div>
    @enderror
    <div class="form-floating mb-3">
      <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com" value="{{old('email')}}">
      <label for="email">Email address</label>
    </div>

    @error('password')
    <div class="text-danger mb-0">
              {{$message}}
		</div>
    @enderror
    <div class="form-floating mb-3">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="{{old('password')}}">
      <label for="password">Password</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
      <label for="floatingPassword">Re-type your password</label>
    </div>
    </div>
    <button class="btn btn-primary mb-3 mx-auto d-block" type="submit">Create account</button>
  </form>
</div>
@endsection
