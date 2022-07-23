@extends('layouts.app')

@section('content')
<div class="container-sm">
  @if(!empty($user_data))
 <div class="row mx-auto">
      <div class="col-lg-4 mx-auto">
        <div class="mx-auto mb-2 profile-img edit-img">
        @if(!empty($user_data['profile']))
        <img src="{{ asset($user_data['profile']['photo'])}}" class="rounded-circle d-block mx-auto" alt="{{$user_data['name'].'_photo'}}" width="100" height="100" >
        @else
        <img src="xxx" class="img-circle d-block mx-auto" alt="{{$user_data['name'].'_photo'}}"  width="100" height="100">
        @endif
        </div>
        <h3 class="fw-normal text-center">{{$user_data['name']}}</h3>
        <div class="text-center">
          <i class=`bi bi-heart-fill`></i><strong>{{$user_data['countLikes']}}</strong>
        </div>
           <strong class="text-center  d-block">What is your motto?</strong>
            <p class="text-center">{{!empty($user_data['profile'])?
              $user_data['profile']['question_1']:
            'No comment.'}}</p>
            <strong class="text-center d-block">What is your belief?</strong>
            <p class="text-center">{{!empty($user_data['profile'])?
              $user_data['profile']['question_2']:
            'No comment.'}}</p>
            <strong class="text-center  d-block">What would you do if you win $100,000?</strong>
            <p class="text-center">{{!empty($user_data['profile'])?
              $user_data['profile']['question_3']:
            'No comment.'}}</p>
       <button class="btn btn-secondary" type="submit" role="button" aria-disabled="false" href={{route('user.editProfile',['user'=>$user_data['id']])}}>Submit</button>
       </div>
     @else
    No user data
  @endif
   </div>
   <a class="btn btn-secondary" role="button" aria-disabled="false" href="{{route('bucket-lists.index')}}">Back</a>
</div>
@endsection
