@extends('layouts.common')

@section('content')
<div class="container-sm text-center">
   <h2>{{$is_success===true?'Success!':'Failed...'}}</h2>
   <p class="lead">{{!empty($message)?$message:''}}</p>
</div>
@endsection
