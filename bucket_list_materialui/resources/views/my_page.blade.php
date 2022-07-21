@extends('layouts.app')

@section('content')
<div class="container-sm">
	@if(!empty($user_data))
 <div class="row mx-auto">
		<div class="col-lg-4 mx-auto">
			<form method="post" action="{{route('bucket-lists.create')}}">
				<div class="mb-3">
					@if ($errors->has('new_todo'))
            <div class="list-unstyled text-center text-danger mb-0">{{$errors->first('new_todo')}}</div>
          @endif
					<label for="todoFormControlInput1" class="form-label"></label>
				 	<input type="text" name="new_todo"class="form-control" id="todoFortontrolInput1" placeholder="Input your todo...">
				</div>
		 <div class="text-center mb-4">
			 <button class="btn btn-primary" type="submit">Submit</button>
		 </div>
		 </form>
 </div>
        <div class="text-center text-danger">
						@if($errors->has("bucket_list"))
					  	{{$errors->first('bucket_list')}}
						@endif
				</div>
				<div class="list-group w-auto">
					@if(!empty($user_data['bucket_lists']))
						@foreach($user_data['bucket_lists'] as $item)
						 <label class="list-group-item d-flex gap-3">
							<form id="todo_form" method="post">
								@csrf
                @method('patch')
								  <input id="check_todo_id" class="form-check-input flex-shrink-0" name="bucket_list" type="checkbox" value="" style="font-size: 1.375em;" onClick="onHandleIsDone({{$item['id']}},'bucket-lists.update-is-done')">
							</form>
							<span class="pt-1 form-checked-content">
							<form id="todo_title_form" method="post">
								@csrf
                @method('patch')
							<p id="todo_display" @class(['textdecoration-linethrough'=>$item['is_done']]) onClick="onHandleEditMode({{$item['id']}})">{{$item['bucket_list_item']}}</p>
              </form>
							</span>
							<div class="text-center mb-4">
						<form method="post" action="{{route('bucket-lists.delete',['bucket_list' => $item['id']])}}">
							@csrf
							@method('delete')
							<button class="btn btn-danger" type="submit">Delete</button>
						</form>
						</div>
						</label>
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
