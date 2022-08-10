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
				<div class="mx-auto mb-2 profile-img edit-img" id="photo_frame">
				<label class="btn btn-outline-primary">Choose Photo
					<input type="file" name="photo" accept=".png, .jpeg, .jpg" id="input_photo" onchange="onHandleSelectPhoto('{{$user_data['name']}}')" style="opacity:0;">
       </label>
       @error('photo')
			 <div id="photo_result" class="text-danger">
				 {{$message}}
			 </div>
			 @enderror
			 	<img id="photo_preview_image" src="{{!empty($user_data['profile']['photo'])?asset($user_data['profile']['photo']):asset('img/no_image.jpg')}}" class="rounded-circle d-block mx-auto position-pic" alt="{{$user_data['name'].'_photo'}}" width="100" height="100">
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
					<div class="mx-auto">
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
 <div class="row mx-auto">
			<div class="col-lg-4 mx-auto">
				<div class="mx-auto mb-2">
				<img src="{{ !empty($user_data['profile']['photo'])?asset($user_data['profile']['photo']):asset('img/no_image.jpg')}}" class="rounded-circle d-block mx-auto" alt="{{$user_data['name'].'_photo'}}" width="100" height="100" >
				</div>
				<h3 class="fw-normal text-center">{{!empty($user_data['name'])?$user_data['name']:'No name'}}</h3>
				<div class="text-center">

					<i class="{{$user_data['is_liked_by_auth']===true?'fa-solid fa-heart active icon-pink':'fa-solid fa-heart icon-grey'}}"></i><strong>{{$user_data['countLikes']}}</strong>
				</div>
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
						<div class="mb-3">
						  <a class="btn btn-primary mx-auto d-block" href="{{route('user.editProfileMode',['user'=>$user_data['id'],'edit_mode'=>true])}}" role="button">Edit Profile</a>
						</div>
			 </div>
		 @else
		No user data
	@endif
	@endif
	 </div>
</div>
@endsection
