@extends('layouts.common')

@section('title')
Cancel
@endsection

@section('content')
<div class="px-4 py-3 my-5 text-center">
      <p class="text-center mb-5">Are you sure you want to delete your account?</p>
       @if(!empty($cancel_result))
      <div class="text-center text-danger mb-0">
              {{$cancel_result}}
			</div>
      @endif
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        {{Form::open(['route'=>['register.cancel','user'=>Auth::id()],'method'=>'delete'])}}
         {{Form::submit('Yes',['class'=>'btn btn-primary'])}}
        {{Form::close()}}
      </div>
  </div>
@endsection
