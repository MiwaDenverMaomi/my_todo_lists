@extends('layouts.common')

@section('title')
Edit New Password
@endsection

@section('content')
<div class="container-sm w-25 p-3">
	  <form method="post" action="{{route('password_reset.update')}}">
      @csrf
    <div class="mb-3">
      <div class="text-center text-danger mb-0">
              {{!empty($error)?:''}}
			</div>
    <div class="form-floating mb-3">
      <input type="hidden" name="reset_token" value="{{$userToken->token}}">
      @error('password')
        <div class="text-center text-danger mb-0">
           {{$message}}
		    </div>
      @enderror
      @error('token')
        <div class="text-center text-danger mb-0">
           {{$message}}
		    </div>
      @enderror
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      <label for="password">Password</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
      <label for="floatingPassword">Re-type your password</label>
    </div>
    </div>
    <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Submit</button>
  </form>
</div>
@endsection
