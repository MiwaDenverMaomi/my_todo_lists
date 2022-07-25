@extends('layouts.common')

@section('title')
How to use this app
@endsection

@section('title')
How to use
@endsection

@section('content')
<div class="container-sm text-center">
   <p class="lead">Step1:Make your todo list from <a href="">my page</a>.</p>
   <p class="lead">Step2:Share your todo list. <a href={{route('bucket-lists.index')}}>my page</a></p>
   <p class="lead">Step3:Good other's todo list.</p>
</div>
@endsection
