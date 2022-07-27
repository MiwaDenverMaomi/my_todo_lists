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
			@if(!empty($result_count))
				<strong>{{$result_count}}</strong> items found.
			@endif
		</div>
		<div class="row g-4 row-cols-1 row-cols-lg-3">
		@if(!empty($bucket_lists))
			@foreach($bucket_lists as $list)
			<div class="card pt-5 pb-3 g-col-4">
				@if(!empty($list['profile']))
				<img src="{{ asset($list['profile']['photo'])}}" class="rounded-circle d-block mx-auto" alt="{{$list['name'].'_photo'}}" width="100" height="100" >
				@else
				<img src="xxx" class="img-circle d-block mx-auto" alt="{{$list['name'].'_photo'}}"  width="100" height="100">
				@endif
				<strong class="text-center d-block mb-3">{{$list['name']}}</strong>
				<div class="text-center mb-3">
					<i class=`bi bi-heart-fill`></i><strong>{{$list['countLikes']}}</strong>
				</div>
				<div class="container">
				<div class="list-group w-auto mb-3">
					@if(!empty($list['bucket_lists']))
						@foreach($list['bucket_lists'] as $item)
						 <label class="list-group-item d-flex gap-3">
							<p @class(['textdecoration-linethrough'=>$item['is_done']])>{{$item['bucket_list_item']}}</p>
						</label>
						@endforeach
					@else
						<div class="text-center">No Bucket List</div>
					@endif
			 </div>
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
			<div>No Todo Lists</div>
		@endif
</div>
@endsection
