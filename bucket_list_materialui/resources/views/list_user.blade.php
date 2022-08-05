
@extends('layouts.common')

@section('content')
<div class="container-sm">
  @if(!empty($user_data))
 <div class="row mx-auto">
      <div class="col-lg-4 mx-auto">
        <div class="mx-auto mb-2">
        @if(!empty($user_data['profile']))
        <img src="{{ asset($user_data['profile']['photo'])}}" class="rounded-circle d-block mx-auto" alt="{{$user_data['name'].'_photo'}}" width="100" height="100" >
        @else
        <img src="xxx" class="img-circle d-block mx-auto" alt="{{$user_data['name'].'_photo'}}"  width="100" height="100">
        @endif
        </div>
        <h3 class="fw-normal text-center">{{$user_data['name']}}</h3>
        @php
					 $heart_class=$user_data['is_liked_by_auth']===true?'fa-solid fa-heart icon active':'fa-solid fa-heart icon';
				@endphp
        <div class="text-center">
          <i id="like-id_{{$user_data['id']}}" class="{{$heart_class}}" onclick="onToggleLike({{$user_data['id']}},{{$user_data['is_liked_by_auth']}})"></i><strong id="count_likes_{{$user_data['id']}}">{{$user_data['countLikes']}}</strong>
        @php
					 $star_class=$user_data['is_favorite_by_auth']===true?'fa-solid fa-heart icon active':'fa-solid fa-heart icon';
				@endphp
          <i id="favorite-id_{{$user_data['id']}}" class="{{$star_class}}" onclick="onToggleFavorite({{$user_data['id']}},{{$user_data['is_liked_by_auth']}})"></i>
						<div class="text-center text-warging" id="likes_result_{{$user_data['id']}}">
						</div>
            <div class="text-center text-warging" id="favorites_result_{{$user_data['id']}}">
						</div>
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
        <p class="text-center"><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
        <div class="list-group w-auto">
          @if(!empty($user_data['bucket_lists']))
            @foreach($user_data['bucket_lists'] as $item)
             <label class="list-group-item d-flex gap-3">
              <input class="form-check-input flex-shrink-0" type="checkbox" value="" style="font-size: 1.375em;">
              <span class="pt-1 form-checked-content">
              <p @class(['textdecoration-linethrough'=>$item['is_done']])>{{$item['bucket_list_item']}}</p>
              </span>
            </label>
            @endforeach
          @else
            <div class="text-center">No Bucket List</div>
          @endif
       </div>
       </div>
     @else
    No user data
  @endif
   </div>
</div>
@endsection
