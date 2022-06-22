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
  <div>To {{$data['name']}}</div>
  <div>
     <p>Thank you for your inqury.</p>
     <p>We will reply in a few days.</p>
  </div>
  <div>
  <div>----message------</div>
    <div>Title:</div>
      {{$data['title']}}
    <div>comment:</div>
      {{$data['comment']}}
  <div>-----------------</div>
  </div>
  <br>
  <p>Best Regards,</p>
  <p>Bucket List</p>
</body>
