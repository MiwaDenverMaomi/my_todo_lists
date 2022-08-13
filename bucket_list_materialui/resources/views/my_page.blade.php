@extends('layouts.common')

@section('content')
<div class="container-sm mb-5">
	@if(!empty($user_data))
 <div class="row mx-auto w-50">
		<div class="mx-auto w-70">
			<form method="post" action="{{route('bucket-lists.create')}}">
				<div class="mb-3">
					<div class="list-unstyled text-danger mb-0">
						@error('new_todo'){{$message}}@enderror
						@if(!empty(session('create_error'))){{session('create_error')}}@endif
					</div>
				 	<input type="text" name="new_todo"class="form-control" id="todoFortontrolInput1" placeholder="Input your todo...">
				</div>
		 <div class="text-center mb-5">
			 <button class="btn btn-primary" type="submit">Submit</button>
		 </div>
		 </form>
       </div>
				<div class="list-group">
					<div class="text-center text-danger">
					  @error('is_done'){{$message}}@enderror
						@error('title'){{$message}}@enderror
						@error('delete'){{$message}}@enderror
						@if(!empty(session('update_is_done_error'))){{session('update_is_done_error')}}@endif
						@if(!empty(session('update`_title_error'))){{session('update_title_error')}}@endif
						@if(!empty(session('delete_error'))){{session('delete_error')}}@endif
				  </div>
					@if(!empty($user_data['bucket_lists']))
						@foreach($user_data['bucket_lists'] as $item)
						 <div class="border-bottom mb-3">
							<form id="todo_form" method="post" action="{{route('bucket-lists.update-is-done',$item['id'])}}" style="display:inline;">
								@csrf
								@method('patch')
									<input id="check_todo_id" class="form-check-input flex-shrink-0" name="bucket_list" type="checkbox" value="" style="font-size: 1.375em;" onclick="onHandleIsDone({{$item['id']}})" {{$item['is_done']===true?'checked':''}}>
							</form>
							<span class="pt-1 form-checked-content">
							<form id="todo_title_form" method="post" action="{{route('bucket-lists.update-title',['bucket_list'=>$item['id']])}}" onsubmit="onSubmit()">
								@csrf
								@method('patch')
							<p id="{{'todo_display_'.$item['id']}}" @class(['textdecoration-linethrough'=>$item['is_done']]) onclick="onStartEditMode({{$item['id']}},'{{$item['bucket_list_item']}}','{{$item['is_done']}}')">{{$item['bucket_list_item']}}</p>
							</form>
							</span>
							<div class="text-end mb-3">
						<form method="post" class="" action="{{route('bucket-lists.delete',['bucket_list' => $item['id']])}}">
							@csrf
							@method('delete')
							<button class="btn btn-danger" type="submit">Delete</button>
						</form>
						</div>
						<!-- </label> -->
						</div>
						@endforeach
						@else
						   <div class="text-center mx-auto">No Todos</div>
					  @endif
	    </div>
	 </div>
	 </div>
	 	@else
		  No user data
	  @endif
</div>
@endsection
