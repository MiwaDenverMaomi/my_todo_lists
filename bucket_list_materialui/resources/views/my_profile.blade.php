@php
  $name=!empty($user_data['name'])?$user_data['name']:'No name';
@endphp

@extends('layouts.app')

@section('content')
<div class="container-sm">
  @if(!empty($user_data))
 <div class="row mx-auto">
      <div class="col-lg-4 mx-auto">
      <form method="post" action={{route('user.editProfile',['user'=>$user_data['id']])}}>
        @csrf
        @method('patch')

        <div class="mx-auto mb-2 profile-img edit-img">
        @if(!empty($user_data['profile']))
        <img src="{{ asset($user_data['profile']['photo'])}}" class="rounded-circle d-block mx-auto" alt="{{$user_data['name'].'_photo'}}" width="100" height="100" >
        @else
        <img src="xxx" class="img-circle d-block mx-auto" alt="{{$user_data['name'].'_photo'}}"  width="100" height="100">
        @endif
        </div>
        <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" placeholder="No name" value="{{$name}}">
        </div>
        <div class="mb-3">
           <label for="question_1" class="form-label"><strong class="d-block">What is your motto?</strong></label>
           <textarea class="form-control" id="question_1" name="question_1" rows="3">{{!empty($user_data['profile'])?$user_data['profile']['question_1']:
            'No comment.'}}</textarea>
         </div>
         <div class="mb-3">
           <label for="question_2" class="form-label"><strong class="d-block">What is your belief?</strong></label>
           <textarea class="form-control" id="question_2" name="question_2" rows="3">{{!empty($user_data['profile'])?$user_data['profile']['question_2']:
            'No comment.'}}</textarea>
         </div>
          <div class="mb-3">
           <label for="question_3" class="form-label"><strong class="d-block">What would you do if you win $100,000?</strong></label>
           <textarea class="form-control" id="question_3" name="question_3" rows="3">{{!empty($user_data['profile'])?$user_data['profile']['question_3']:
            'No comment.'}}</textarea>
         </div>

       <button class="btn btn-secondary" type="submit" role="button" aria-disabled="false" >Submit</button>
       </form>
       </div>
     @else
    No user data
  @endif
   </div>
   <a class="btn btn-secondary" role="button" aria-disabled="false" href="{{route('bucket-lists.index')}}">Back</a>
</div>
@endsection
