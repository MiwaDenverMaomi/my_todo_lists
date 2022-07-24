@extends('layouts.app')

@section('content')
<div class="container-sm text-center">
   <h2>{{$is_success===true?'Success!':'Failed...'}}</h2>
   <p class="lead">{{!empty($message)?$message:''}}</p>
	 <a class="btn btn-secondary" role="button" aria-disabled="false" href="{{route('bucket-lists.index')}}">Go to Top</a>
</div>
@endsection
