@extends('layouts.common')

@section('title')
 Favorites
@endsection

@section('content')
	<div class="container px-4 " id="featured-3">
		<div class="text-center mb-3">
				@if(!empty($favorites_error))
				{{$favorites_error}}
			  @endif
		</div>
		<div class="row g-4 row-cols-1 row-cols-lg-3">
		@if(!empty($favorites))
			@foreach($favorites as $list)
			<div class="card pt-5 pb-3 g-col-4">
				@if(!empty($list['profile']))
				<img src="{{ asset($list['profile']['photo'])}}" class="rounded-circle d-block mx-auto" alt="{{$list['user']['name'].'_photo'}}" width="100" height="100" >
				@else
				<img src="xxx" class="img-circle d-block mx-auto" alt="{{$list['user']['name'].'_photo'}}"  width="100" height="100">
				@endif
				<strong class="text-center d-block mb-3">{{$list['user']['name']}}</strong>
				<div class="text-center mb-3">

					<i id={{$list['user']['id']}} class="{{$list['is_liked_by_auth']===true?`fa-solid fa-heart icon active`:'fa-solid fa-heart icon'}}" onclick="onToggleLike({{$list['user']['id']}},{{$list['is_liked_by_auth']==1?'true':'false'}})"></i><strong>{{count($list['user']['likes'])}}</strong>
				</div>
				<div class="container">
				<div class="list-group w-auto mb-3">
					@if(!empty($list['user']['bucket_lists']))
						@foreach($list['user']['bucket_lists'] as $item)
						 <label class="list-group-item d-flex gap-3">
							<p @class(['textdecoration-linethrough'=>$item['is_done']])>{{$item['bucket_list_item']}}</p>
						</label>
						@endforeach
					@else
						<div class="text-center">No Bucket List</div>
					@endif
			 </div>
			 </div>
				<a href={{route('user.index',['user'=>$list['user']['id']])}} class="icon-link d-inline-flex align-items-center">
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
