@extends('layouts.common')

@section('title')
Password Reset
@endsection

@section('content')
<div class="container-sm w-25 p-3">
	  <form method="post" action={{route('register.postRegister')}}>
    <div class="mb-3">
      @error('email')
      <div class="text-center text-danger mb-0">
              {{$messages->first()}}
			</div>
      @enderror
    <div class="text-center text-danger mb-0">
              {{$errors->has('email')?$errors->first('email'):''}}
		</div>
    <div class="form-floating mb-3">
      <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com"  value="{{ old('email') }}">
      <label for="email">Email address</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Send</button>
  </form>
</div>
@endsection
