@extends('layouts.common')

@section('title')
Password Reset
@endsection

@section('content')
<div class="container-sm  col-sm-6 col-md-4 col-lg-3 p-3">
  @if(!empty($edit_password_result))
    <div class="text-danger mb-3">
       {{$edit_password_result}}}
    </div>
  @endif
	  <form method="post" action="{{route('password_reset.email.send')}}">
      @if(session('flash_message'))
      <div class="text-danger mb-3">
              {{session('flash_message')}}
			</div>
      @endif
    <div class="mb-3">
      @error('email')
      <div class="text-danger mb-3">
              {{$errors->first('email')}}
			</div>
      @enderror
    <div class="form-floating mb-3">
      <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com"  value="{{ old('email') }}">
      <label for="email">Email address</label>
    </div>
    <button class="btn btn-primary mb-3 mx-auto d-block" type="submit">Send</button>
  </form>
</div>
@endsection
