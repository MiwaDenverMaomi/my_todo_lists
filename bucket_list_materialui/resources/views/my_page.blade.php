@extends('layouts.app')

@section('content')
<div class="container-sm">
	@if(!empty($user_data))
 <div class="row mx-auto">
		<div class="col-lg-4 mx-auto">
			<form method="post" action="{{route('bucket-lists.create')}}">
				<div class="mb-3">
					<label for="todoFormControlInput1" class="form-label"></label>
				 	<input type="text" name="new_todo"class="form-control" id="todoFortontrolInput1" placeholder="Input your todo...">
				</div>
		 <div class="text-center mb-4">
			 <button class="btn btn-primary" type="submit">Submit</button>
		 </div>
		 </form>
 </div>
				<div class="list-group w-auto">
					@if(!empty($user_data['bucket_lists']))
						@foreach($user_data['bucket_lists'] as $item)
						<form method="get" action="{{route('bucket-lists.delete',['bucket_list' => $item['id']])}}">
						 <label class="list-group-item d-flex gap-3">
							<input class="form-check-input flex-shrink-0" type="checkbox" value="" style="font-size: 1.375em;">
							<span class="pt-1 form-checked-content">
							<p @class(['textdecoration-linethrough'=>$item['is_done']])>{{$item['bucket_list_item']}}</p>
							</span>
							<div class="text-center mb-4">
							<button class="btn btn-danger" type="submit">Delete</button>
						</div>
						</label>
          </form>
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
	 <a class="btn btn-secondary" role="button" aria-disabled="false" href="{{route('bucket-lists.index')}}">Back</a>
</div>
@endsection
