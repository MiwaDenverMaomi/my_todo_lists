@extends('layouts.common')

@section('title')
Edit New Password
@endsection

@section('content')
<div class="container-sm col-sm-6 col-md-4 col-lg-3 p-3 mb-5">
	  <form method="post" action="{{route('password_reset.update')}}">
      @csrf
    <div class="mb-3">
      @error('token')
        <div class="text-danger mb-0">
           {{$message}}
		    </div>
      @enderror
      @if(session('flash_message'))
        <div class="text-danger mb-0">
           {{session('flash_message')}}
		    </div>
      @enderror
      @error('password')
        <div class="text-danger mb-0">
           {{$message}}
		    </div>
      @enderror
    <div class="form-floating mb-3">
      <input type="hidden" name="reset_token" value="{{$userToken->token}}">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      <label for="password">Password</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
      <label for="password_confirmation">Re-type your password</label>
    </div>
    </div>
    <button class="btn btn-primary mx-auto d-block" type="submit">Submit</button>
  </form>
</div>
@endsection
