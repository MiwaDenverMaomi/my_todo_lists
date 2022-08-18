<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	@include('parts.head')
<body>
	<div style="display: grid;
  grid-template-rows: auto 1fr auto;
  grid-template-columns: 100%;
  min-height: 100vh;">
	@include('parts.nav')
	<main class="w-70 p-3 mb-5">
		<h1 class="h3 mb-3 fw-normal mb-5 text-center">@yield('title')</h1>
	 @yield('content')
	 @include('parts.go_to_top_button')
	</main>
	@if(empty($is_success))
	@include('parts.footer')
	@endif

	@include('parts.scripts')
	</div>
</body>
</html>
