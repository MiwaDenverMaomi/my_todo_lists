@extends('layouts.common')

@section('content')
<div class="container-sm">
	@if($edit_mode===true)
		@if(!empty($user_data))
 <div class="row mx-auto">
	<div id="preview"></div>
			<div class="col-lg-4 mx-auto">
			<div class="text-center text-danger" id="photo_err"></div>
			<form method="post" action="{{route('user.editProfile',['user'=>$user_data['id']])}}" enctype="multipart/form-data" id="profile_form" onclick="onSubmitProfile()">
				@csrf
				@method('patch')
				@error('photo')
			 <div id="photo_result" class="text-danger">
				 {{$message}}
			 </div>
			 @enderror
				<div class="mx-auto mb-2 round-circle" id="photo_frame" width="100" height="100" >
				<label class="btn" style="display:block;width:100px; height:100px; margin:0 auto 24px; border-radius:50%;";>
					<input type="file" name="photo" accept=".png, .jpeg, .jpg" id="input_photo" onchange="onHandleSelectPhoto('{{$user_data['name']}}')" width="100" height="100" class="round-circle opacity-0" style="position:relative; bottom:24px" >
			 	<img id="photo_preview_image" src="{{!empty($user_data['profile']['photo'])?asset($user_data['profile']['photo']):asset('img/no_image.jpg')}}" class="rounded-circle mx-auto d-block position-pic border-pic" style="position:relative; bottom:37px;right:13px;" alt="{{$user_data['name'].'_photo'}}" width="100" height="100">
				</label>
				</div>
				<div class="mb-3">
				<label for="name" class="form-label">Name</label>
				@error('name')
				<div id="name_result" class="text-danger">
				 {{$message}}
				</div>
				@enderror
				<input type="text" class="form-control" id="name" placeholder="No name" value="{{old('name',!empty($user_data['name'])?$user_data['name']:'No name')}}" name="name">
				</div>
				   <div class="mb-3">
					 <label for="question_1" class="form-label"><strong class="d-block">What is your motto?</strong></label>
					 @error('question_1')
					 <div id="question_1_result" class="text-center text-danger">
						 {{$message}}
					 </div>
					 @enderror
					 <textarea class="form-control" id="question_1" name="question_1" rows="3"  placeholder="No comment" >{{old('question_1',!empty($user_data['profile'])?$user_data['profile']['question_1']:
						'No comment.')}}</textarea>
				 </div>
				 <div class="mb-3">
					 <label for="question_2" class="form-label"><strong class="d-block">What is your belief?</strong></label>
					 @error('question_2')
					 <div id="question_2_result" class="text-center text-danger">
						 {{$message}}
					 </div>
						@enderror
					 <textarea class="form-control" id="question_2" name="question_2" rows="3" placeholder="No comment">{{old('question_2',!empty($user_data['profile'])?$user_data['profile']['question_2']:
						'No comment.')}}</textarea>
				 </div>
					<div class="mb-3">
					 <label for="question_3" class="form-label"><strong class="d-block">What would you do if you win $100,000?</strong></label>
					 @error('question_3')
					 <div id="question_3_result" class="text-center text-danger">
						 {{$message}}
					 </div>
					 @enderror
					 <textarea class="form-control" id="question_3" name="question_3" rows="3" placeholder="No comment">{{old('question_3',!empty($user_data['profile'])?$user_data['profile']['question_3']:
						'No comment.')}}</textarea>
				 </div>
				 <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
					<div class="mx-auto mb-5">
					 <div class="btn-group me-2" role="group" aria-label="First group">
							<button class="btn btn-primary mx-auto d-block" type="submit" role="button" aria-disabled="false" >Submit</button>
					 </div>
					 <div class="btn-group me-2" role="group" aria-label="Second group">
							<a class="btn btn-primary" href="{{route('user.showProfile',['user'=>Auth::id()])}}" role="button">Cancel</a>
					 </div>
					 </div>
				 </div>
			 </form>
			 </div>
		 @else
		No user data
	 @endif

<!-- if edit_flag===false -->
	@else
		@if(!empty($user_data))
 <div class="row ">
			<div class="col-lg-4 mx-auto">
				<div class="mx-auto mb-2">
				<img src="{{ !empty($user_data['profile']['photo'])}}?data:image/png;base64,<?= $user_data['profile']['photo']?>:asset('img/no_image.jpg')}}" class="rounded-circle mx-auto d-block position-pic  border-pic" alt="{{$user_data['name'].'_photo'}}" width="100" height="100" >
				</div>
				<h3 class="fw-normal text-center mb-4">{{!empty($user_data['name'])?$user_data['name']:'No name'}}</h3>
        <div class="text-center mb-3">
					@php
					 $heart_class=$user_data['is_liked_by_auth']===true?'bi bi-heart-fill icon active':'bi bi-heart-fill icon';
					@endphp
				  	<i id="like-id_{{$user_data['id']}}" class="{{$heart_class}}" onclick="onToggleLike({{$user_data['id']}},{{$user_data['is_liked_by_auth']}})"></i><strong id="count_likes_{{$user_data['id']}}">{{count($user_data['likes'])}}</strong>
					@php
					 $star_class=$user_data['is_favorite_by_auth']===true?'bi bi-star-fill favorite-icon active':'bi bi-star-fill favorite-icon';
			  	@endphp

          <i id="favorite-id_{{$user_data['id']}}" class="{{$star_class}}" onclick="onToggleFavorite({{$user_data['id']}},{{$user_data['is_favorite_by_auth']}})"></i>
						<div class="text-center text-danger" id="likes_result_{{$user_data['id']}}">
						</div>
            <div class="text-center text-danger" id="favorites_result_{{$user_data['id']}}">
						</div>
				</div>
				<div class="mb-4">
					 <strong class="text-center  d-block">What is your motto?</strong>
						<p class="text-center">{{!empty($user_data['profile']['question_1'])?
							$user_data['profile']['question_1']:
						'No comment.'}}</p>
						<strong class="text-center d-block">What is your belief?</strong>
						<p class="text-center">{{!empty($user_data['profile']['question_2'])?
							$user_data['profile']['question_2']:
						'No comment.'}}</p>
						<strong class="text-center  d-block">What would you do if you win $100,000?</strong>
						<p class="text-center">{{!empty($user_data['profile']['question_3'])?
							$user_data['profile']['question_3']:
						'No comment.'}}</p>
					</div>
					<div class="mb-3  text-center">
						<a class="btn btn-primary mb-3" href="{{route('user.editProfileMode',['user'=>$user_data['id'],'edit_mode'=>true])}}" role="button">Edit Profile</a>
					</div>
			 </div>
		 @else
		No user data
	@endif
	@endif
	 </div>
</div>
@endsection
