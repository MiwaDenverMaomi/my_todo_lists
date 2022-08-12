<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @include('parts.head')
<body>
  @include('parts.nav')
  @include('parts.user')

	<main class="py-4">
		<h1 class="h3 mb-3 fw-normal mb-5 text-center">@yield('title')</h1>
	 @yield('content')
	 @include('parts.go_to_top_button')
  </main>
  @include('parts.footer')
  @include('parts.scripts')
</body>
</html>
