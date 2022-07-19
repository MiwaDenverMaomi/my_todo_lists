@extends('layouts.app')

@section('content')
<div class="container">
  <div class="container px-4 py-5" id="featured-3">
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
    @if(count($bucket_lists)>0)
      @foreach($bucket_lists as $list)
      <div class="feature col">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
          <svg class="bi" width="1em" height="1em"><use xlink:href="#collection"/></svg>
        </div>
        <div>{{$list['name']}}</div>
        <ul class="list-group list-group-flush">
          @if(count($list['bucket_lists'])>0)
            @foreach($list['bucket_lists'] as $item)
              <li class="list-group-item">{{$item['bucket_list_item']}}</li>
            @endforeach
          @else
            <div>No Bucket List</div>
          @endif
       </ul>
        <a href={{route('user.index',['user'=>$list['id']])}} class="icon-link d-inline-flex align-items-center">
          See more...
          <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
        </a>
      </div>

      @endforeach
        </div>
  </div>
    @else
      <div>No Bucket Lists</div>
    @endif
</div>
@endsection
