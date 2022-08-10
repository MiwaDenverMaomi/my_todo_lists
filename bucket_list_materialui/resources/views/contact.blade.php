@extends('layouts.common')

@section('title')
Contact
@endsection

@section('content')
<div class="container-sm w-25 p-3">
	  <form method="post" action="{{route('general.postContact')}}">
    <div class="mb-3">
      <div class="text-center text-danger mb-0">
              {{!empty($error)?:''}}
			</div>
    @error('email')
    <div class="text-danger mb-0">
        {{$message}}
		</div>
    @enderror
    <div class="form-floating mb-3">
      <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com" value="{{old('email')}}">
      <label for="email">Email address</label>
    </div>
    @error('name')
    <div class="text-danger mb-0">
        {{$message}}
		</div>
    @enderror
    <div class="form-floating mb-3">
      <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{old('name')}}">
      <label for="name">Name</label>
    </div>
    @error('title')
    <div class="text-danger mb-0">
        {{$message}}
		</div>
    @enderror
    <div class="form-floating mb-3">
      <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{old('title')}}">
      <label for="title">Title</label>
    </div>
    <div class="mb-3">
      <label for="comment" class="form-label">Comment</label>
    @error('comment')
    <div class="text-danger mb-0">
        {{$message}}
		</div>
    @enderror
      <textarea class="form-control" id="comment" name="comment" rows="3">{{old('comment')}}</textarea>
    </div>
    </div>
    <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Submit</button>
  </form>
</div>
@endsection
