@extends('layouts.common')
@section('content')
	<div class="container px-4 mb-5" id="featured-3">
		<div class="text-center">
			@if(!empty($keyword))
			 Seach results for "<strong>{{$keyword}}</strong>"
			@endif
		</div>
		<div class="text-center mb-3">
			@if(isset($search_result))
			<strong>
				{{$search_result}}
			</strong>
			@endif
			@if(isset($result_count))
		  <strong>
				{{$result_count}} items found.
			</strong>
			@endif
		</div>
		<div class="row g-4  row-cols-md-2 row-cols-lg-3">
		@if(!empty($bucket_lists))
			@foreach($bucket_lists as $list)
			<div class="card pt-3 pb-3  ps-4 pe-4 g-col-4">
	 <div class="mb-3">
    <img src="{{!empty($list['profile']['photo'])?asset($list['profile']['photo']):asset('img/no_image.jpg')}}" alt="{{!empty($list['name'])?$list['name']:'No name'}}" width="32" height="32" class="rounded-circle flex-shrink-0" style="border:1px solid lightgrey">
    <div class="d-flex gap-2 w-100 justify-content-between">
      <div>
        <h6 class="mb-0">{{!empty($list['name'])?$list['name']:'No name'}}</h6>
        <p class="mb-0 opacity-75">{{!empty($list['email'])?$list['email']:'No email'}}</p>
      </div>
      <small class="opacity-50 text-nowrap"></small>
    </div>
   </div>
				<div class="text-center mb-3">
					 @php
					 $heart_class=$list['is_liked_by_auth']===true?'bi bi-heart-fill icon active':'bi bi-heart-fill icon';
					@endphp
				  	<i id="like-id_{{$list['id']}}" class="{{$heart_class}}" onclick="onToggleLike({{$list['id']}},{{$list['is_liked_by_auth']}})"></i><strong id="count_likes_{{$list['id']}}">{{count($list['likes'])}}</strong>
					@php
					 $star_class=$list['is_favorite_by_auth']===true?'bi bi-star-fill favorite-icon active':'bi bi-star-fill favorite-icon';
			  	@endphp
          <i id="favorite-id_{{$list['id']}}" class="{{$star_class}}" onclick="onToggleFavorite({{$list['id']}},{{$list['is_favorite_by_auth']}})"></i>
						<div class="text-center text-danger" id="likes_result_{{$list['id']}}">
						</div>
            <div class="text-center text-danger" id="favorites_result_{{$list['id']}}">
						</div>
				</div>
				<div class="text-center"><strong>{{!empty($list['bucket_lists'])?count($list['bucket_lists']):0}}</strong> todo(s)</div>
				<div class="container">
				@if(!empty($list['bucket_lists']))
				<ul class="w-70 mb-3 list-content">
						@foreach($list['bucket_lists'] as $item)
							<li @class(['textdecoration-linethrough'=>$item['is_done']])>{{$item['bucket_list_item']}}</li>
						@endforeach
       </ul>
			    @else
						<div class="text-center">No Bucket List</div>
					@endif
			 </div>
				<a href="{{route('user.index',['user'=>$list['id']])}}" class="icon-link d-inline-flex align-items-center see-more">
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
			<div class="text-center mb-5 w-100">No Lists</div>
		@endif
</div>
@endsection
