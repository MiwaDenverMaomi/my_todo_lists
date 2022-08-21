
@extends('layouts.common')
@section('title')
{{!empty($user_data['name'])?$user_data['name']:'No name'}}'s Todo List
@endsection

@section('content')
<div class="container">
	@if(!empty($user_data))
 <div class="row mx-auto">
			<div class="col-sm-4 mx-auto">
				<div class="text-center">
					<div class="mb-3">
          @auth
						<i id="like-id_{{$user_data['id']}}" class="{{$user_data['is_liked_by_auth']===true?'bi bi-heart-fill icon active':'bi bi-heart-fill icon'}}" onclick="onToggleLike({{$user_data['id']}},{{$user_data['is_liked_by_auth']}})"></i><strong style="font-size:1.5rem;" id="count_likes_{{$user_data['id']}}">{{$user_data['countLikes']}}</strong>
					@endauth
					@guest
					<a class="text-decoration-none" href="{{route('login.getLogin')}}">
					  <i id="like-id_{{$user_data['id']}}" class="bi bi-heart-fill icon-grey"></i><strong style="font-size:1.5rem; text-decoration:none;" id="count_likes_{{$user_data['id']}}">{{$user_data['countLikes']}}</strong>
					</a>
					@endguest
					@auth
					 <i id="favorite-id_{{$user_data['id']}}" class="{{$user_data['is_favorite_by_auth']===true?'bi bi-star-fill favorite-icon active':'bi bi-star-fill favorite-icon'}}" onclick="onToggleFavorite({{$user_data['id']}},{{$user_data['is_favorite_by_auth']}})"></i>
					@endauth
					@guest
					<a class="text-decoration-none" href="{{route('login.getLogin')}}">
					 <i id="favorite-id_{{$user_data['id']}}" class="bi bi-star-fill icon-grey" style="position:relative; bottom:2px;"></i>
					 </a>
					@endguest
					</div>
						<div class="text-center text-danger" id="likes_result_{{$user_data['id']}}">
						</div>
						<div class="text-center text-danger" id="favorites_result_{{$user_data['id']}}">
						</div>
						<div><strong>{{!empty($user_data['bucket_lists'])?count($user_data['bucket_lists']):0}}</strong> todo(s)</div>
				</div>
				<div class="mt-3 mb-5">
				<ul class="list-group">
					@if(!empty($user_data['bucket_lists']))
						@foreach($user_data['bucket_lists'] as $item)
							<span class="pt-1 form-checked-content">
							<li @class(['textdecoration-linethrough'=>$item['is_done']])>{{$item['bucket_list_item']}}</li>
							</span>
						@endforeach
					@else
						<p class="text-center">No Bucket List</p>
					@endif
			 </ul>
			 </div>
			 <h4 class="text-center fw-normal mb-4">About Author</h3>
			 <div class="mx-auto mb-2">
				<img src="{{ !empty($user_data['profile']['photo'])?asset($user_data['profile']['photo']):asset('img/no_image.jpg')}}" class="rounded-circle mx-auto d-block position-pic border-pic" alt="{{$user_data['name'].'_photo'}}" width="100" height="100" >
				</div>
				<strong class="text-center d-block">{{!empty($user_data['name'])?$user_data['name']:'No name'}}</strong>
				<p class="mb-3 opacity-75 text-center">{{!empty($user_data['email'])?$user_data['email']:'No email'}}</p>
				<div class="mt-3 mb-3">
					<div id="description_title" class="fw-normal text-center mb-3 button" onclick="onToggleDescription()">>Describe Myself</div>
					<div id="description" class="description d-none">
					 <strong class="text-center  d-block">1.What is your motto?</strong>
						<p class="text-center">{{!empty($user_data['profile'])?
							$user_data['profile']['question_1']:
						'No comment.'}}</p>
						<strong class="text-center d-block">2.What is your belief?</strong>
						<p class="text-center">{{!empty($user_data['profile'])?
							$user_data['profile']['question_2']:
						'No comment.'}}</p>
						<strong class="text-center  d-block">3.What would you do if you win $100,000?</strong>
						<p class="text-center">{{!empty($user_data['profile'])?
							$user_data['profile']['question_3']:
						'No comment.'}}</p>
					</div>
				</div>
			 </div>
		 @else
		No user data
	@endif
	 </div>
</div>
@endsection
