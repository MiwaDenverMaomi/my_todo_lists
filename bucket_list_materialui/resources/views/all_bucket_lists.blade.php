@extends('layouts.common')
@if (!empty(session('status')))
		<div class="alert alert-success text-center flash">
				{{ session('status') }}
		</div>
@endif
@section('content')
	<div class="container px-4 " id="featured-3">
		<div class="text-center">
			@if(!empty($keyword))
			 Seach results for "<strong>{{$keyword}}</strong>"
			@endif
		</div>
		<div class="text-center mb-3">
		  <strong>
				@if(isset($result_count))
				{{$result_count}} items found.
			  @endif
			</strong>
		</div>
		<div class="row g-4 row-cols-1 row-cols-lg-3">
		@if(!empty($bucket_lists))
			@foreach($bucket_lists as $list)
			<div class="card pt-3 pb-3 g-col-4">
	 <div class="mb-3">
    <img src="{{!empty($list['profile']['photo'])?asset($list['profile']['photo']):asset('img/no_image.jpg')}}" alt="{{!empty($list['name'])?$list['name']:'No name'}}" width="32" height="32" class="rounded-circle flex-shrink-0">
    <div class="d-flex gap-2 w-100 justify-content-between">
      <div>
        <h6 class="mb-0">{{!empty($list['name'])?$list['name']:'No name'}}</h6>
        <p class="mb-0 opacity-75">{{!empty($list['email'])?$list['email']:'No email'}}</p>
      </div>
      <small class="opacity-50 text-nowrap"></small>
    </div>
   </div>
				<div class="text-center mb-3">
					<i class="fa-solid fa-heart active icon-pink"></i><strong>{{$list['countLikes']}}</strong>
				</div>
				<div class="container">
				<ul class="list-group w-70 mb-3">
					@if(!empty($list['bucket_lists']))
						@foreach($list['bucket_lists'] as $item)
							<li @class(['textdecoration-linethrough'=>$item['is_done']])>{{$item['bucket_list_item']}}</li>
						@endforeach
					@else
						<div class="text-center">No Bucket List</div>
					@endif
       </ul>
			 </div>
				<a href={{route('user.index',['user'=>$list['id']])}} class="icon-link d-inline-flex align-items-center">
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
			<div class="text-center mb-5 w-100">No Todo Lists</div>
		@endif
</div>
@endsection
