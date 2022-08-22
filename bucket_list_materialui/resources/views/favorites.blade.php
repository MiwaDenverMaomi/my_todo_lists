@extends('layouts.common')

@section('title')
 Favorites
@endsection

@section('content')
	<div class="container px-4 mb-5" id="featured-3">
		<div class="text-center mb-3">
				@if(!empty($favorites_error))
				{{$favorites_error}}
			  @endif
		</div>
		<div class="row g-4 row-cols-md-2 row-cols-lg-3">
		@if(!empty($favorites))
			@foreach($favorites as $list)
			<div class="card pt-3 pb-3  ps-4 pe-4 g-col-4">
	 <div class="mb-3">
    <img src="{{!empty($list['user']['profile']['photo'])?asset($list['user']['profile']['photo']):asset('img/no_image.jpg')}}" alt="{{!empty($list['user']['name'])?$list['user']['name']:'No name'}}" width="32" height="32" class="rounded-circle flex-shrink-0" style="border:1px solid lightgrey">
   @if(!empty($list['user']['profile']['photo']))
				<img src="data:image/png;base64,<?= $list['user']['profile']['photo'] ?>" alt="{{!empty($list['user']['name'])?$list['user']['name']:'No name'}}" width="32" height="32" class="rounded-circle flex-shrink-0" style="border:1px solid lightgrey">
		@else
				<img src="{{asset('img/no_image.jpg')}}" alt="{{!empty($list['user']['name'])?$list['user']['name']:'No name'}}" width="32" height="32" class="rounded-circle flex-shrink-0" style="border:1px solid lightgrey">
	 @endif
    <div class="d-flex gap-2 w-100 justify-content-between">
      <div>
        <h6 class="mb-0">{{!empty($list['user']['name'])?$list['user']['name']:'No name'}}</h6>
        <p class="mb-0 opacity-75">{{!empty($list['user']['email'])?$list['user']['email']:'No email'}}</p>
      </div>
      <small class="opacity-50 text-nowrap"></small>
    </div>
   </div>
				<div class="text-center mb-3">
	        @php
					 $heart_class=$list['is_liked_by_auth']===true?'bi bi-heart-fill icon active':'bi bi-heart-fill icon';
					@endphp
				  	<i id="like-id_{{$list['user']['id']}}" class="{{$heart_class}}" onclick="onToggleLike({{$list['user']['id']}},{{$list['is_liked_by_auth']}})"></i><strong id="count_likes_{{$list['user']['id']}}">{{count($list['user']['likes'])}}</strong>
					@php
					 $star_class=$list['is_favorite_by_auth']===true?'bi bi-star-fill favorite-icon active':'bi bi-star-fill favorite-icon';
			  	@endphp
          <i id="favorite-id_{{$list['user']['id']}}" class="{{$star_class}}" onclick="onToggleFavorite({{$list['user']['id']}},{{$list['is_favorite_by_auth']}})"></i>
						<div class="text-center text-danger" id="likes_result_{{$list['user']['id']}}">
						</div>
            <div class="text-center text-danger" id="favorites_result_{{$list['user']['id']}}">
						</div>
				</div>
				<div class="text-center"><strong>{{!empty($list['bucket_lists'])?count($list['bucket_lists']):0}}</strong> todo(s)</div>
				<div class="container">
				@if(!empty($list['user']['bucket_lists']))
				<ul class="w-70 mb-3 list-content">
						@foreach($list['user']['bucket_lists'] as $item)
							<li @class(['textdecoration-linethrough'=>$item['is_done']])>{{$item['bucket_list_item']}}</li>
						@endforeach
       </ul>
			 @else
					<div class="text-center mb-3">No Bucket List</div>
			 @endif
			 </div>
				<a href="{{route('user.index',['user'=>$list['user']['id']])}}" class="icon-link d-inline-flex align-items-center see-more">
					See more...
					<svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
				</a>
			</div>
			@endforeach
			</div>
		</div>
	</div>
</div>
		@else
			<div class="text-center mb-5 w-100">No Favorites</div>
		@endif
</div>
@endsection
