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
  <div>Password Reset</div>
  <div>------------------</div>
  <p>Thank you for using our app!</p>
  <p>Here is the url to reset your password.</p>
  <p>Access the url below to reset your password within
    48 hours.
  </p>
  <br>
  <a href="{{$url}}">{{$url}}</a>
  <br>
  <br>
  <br>
  <br>
  <p>Please do not reply to this email as this is a send-only address and you may receive an error message.</p>
  <p>
    ------------------------------------------<br>
    {{ config('app.name') }} customer service
    -------------------------------------------
</p>


</body>
