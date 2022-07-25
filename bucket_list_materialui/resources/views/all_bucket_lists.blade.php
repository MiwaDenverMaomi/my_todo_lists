@if (!empty(session('status')))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@extends('layouts.common')

@section('content')
  <div class="container px-4 py-5" id="featured-3">
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
    @if(count($bucket_lists)>0)
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
          @if(count($list['bucket_lists'])>0)
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
      <div>No Bucket Lists</div>
    @endif
</div>
@endsection
