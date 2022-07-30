@extends('layouts.common')

@section('title')
Contact
@endsection

@section('content')
<div class="container-sm w-25 p-3">
	  <form method="post" action={{route('general.postContact')}}>
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
              {{$errors->has('name')?$errors->first('name'):''}}
		</div>
    <div class="form-floating mb-3">
      <input type="text" name="name" class="form-control" id="name" placeholder="Name">
      <label for="name">Name</label>
    </div>
    <div class="text-center text-danger mb-0">
              {{$errors->has('title')?$errors->first('title'):''}}
		</div>
    <div class="form-floating mb-3">
      <input type="text" name="title" class="form-control" id="title" placeholder="Title">
      <label for="title">Title</label>
    </div>
    <div class="text-center text-danger mb-0">
              {{$errors->has('comment')?$errors->first('comment'):''}}
		</div>
    <div class="mb-3">
      <label for="comment" class="form-label">Comment</label>
      <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
    </div>
    </div>
    <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Submit</button>
  </form>
</div>
@endsection
