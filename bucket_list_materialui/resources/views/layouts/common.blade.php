<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	@include('parts.head')
<body>
	@include('parts.nav')
	<main class="w-70 p-3 mb-5 main">
		<h1 class="h3 mb-3 fw-normal mb-5 text-center">@yield('title')</h1>
	 @yield('content')
	 @include('parts.go_to_top_button')
	</main>
	@if(empty($is_success))
	@include('parts.footer')
	@endif

	@include('parts.scripts')
</body>
</html>
