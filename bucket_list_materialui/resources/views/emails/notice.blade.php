<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<body>
  <div>We have got inqury!</div>
  <div>------------------</div>
    <div>Name:</div>
      {{$data['name']}}
    <div>Email:</div>
      {{$data['email']}}
    <div>Title:</div>
      {{$data['title']}}
    <div>comment:</div>
      {{$data['comment']}}
  <div>-----------------</div>
  </div>
</body>