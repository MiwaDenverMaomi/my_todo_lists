@extends('layouts.app')

@section('content')
<div class="container-sm">
	@if(!empty($user_data))
 <div class="row mx-auto">
		<div class="col-lg-4 mx-auto">
			<form method="post" action="{{route('bucket-lists.create')}}">
				<div class="mb-3">
					<div class="list-unstyled text-center text-danger mb-0">
							@if ($errors->has('new_todo'))
							  {{$errors->first('new_todo')}}
							@elseif(!empty(session('create_error')))
							  {{session('create_error')}}
					    @endif
					</div>
					<label for="todoFormControlInput1" class="form-label"></label>
				 	<input type="text" name="new_todo"class="form-control" id="todoFortontrolInput1" placeholder="Input your todo...">
				</div>
		 <div class="text-center mb-4">
			 <button class="btn btn-primary" type="submit">Submit</button>
		 </div>
		 </form>
 </div>
				<div class="text-center text-danger">
				</div>
				<div class="list-group w-auto">
					@if(!empty($user_data['bucket_lists']))
						@foreach($user_data['bucket_lists'] as $item)
						 <!-- <label class="list-group-item d-flex gap-3"> -->
							<div class="text-center text-danger">
								@if($errors->has("is_done"))
									{{$errors->first("is_done")}}
									@elseif(!empty(session('update_is_done_error')))
									{{session('update_is_done_error')}}
								@endif
							</div>
							<form id="todo_form" method="post" action={{route('bucket-lists.update-is-done',$item['id'])}}>
								@csrf
								@method('patch')
									<input id="check_todo_id" class="form-check-input flex-shrink-0" name="bucket_list" type="checkbox" value="" style="font-size: 1.375em;" onclick="onHandleIsDone({{$item['id']}})">
							</form>
							<span class="pt-1 form-checked-content">
								<div class="text-center text-danger">
								@if($errors->has("title"))
								 {{$errors->first("title")}}
								 @elseif(!empty(session('update_title_error')))
								 {{session('update_title_error')}}
								@endif
                </div>
								@if($errors->has("delete"))
								 {{$errors->first(delete)}}
								@elseif(!empty(session('delete_error')))
								 {{session('delete_error')}}
								@endif
							<form id="todo_title_form" method="post" action={{route('bucket-lists.update-title',['bucket_list'=>$item['id']])}} onsubmit="onSubmitTitle(${todo_id},'${prev_title}','${is_done}')">
								@csrf
								@method('patch')
							<p id={{"todo_display_".$item['id']}} @class(['textdecoration-linethrough'=>$item['is_done']]) onclick="onStartEditMode({{$item['id']}},'{{$item['bucket_list_item']}}','{{$item['is_done']}}')">{{$item['bucket_list_item']}}</p>
							</form>
							</span>
							<div class="text-center mb-4">
						<form method="post" action="{{route('bucket-lists.delete',['bucket_list' => $item['id']])}}">
							@csrf
							@method('delete')
							<button class="btn btn-danger" type="submit">Delete</button>
						</form>
						</div>
						<!-- </label> -->
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
