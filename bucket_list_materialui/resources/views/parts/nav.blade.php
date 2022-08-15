<nav class="navbar navbar-expand-lg bg-dark">
	<div class="container-fluid text-white">
		<a class="navbar-brand text-white mb-3" href="{{route('bucket-lists.index')}}">My Todo Lists</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<div class="text-end ms-3 pe-3 d-inline-block">
	@if(session('is_userinfo_hide')!==true)
		@php
		if(Auth::check()){
		 $photo=!empty(Auth::user()->profile->photo)?Auth::user()->profile->photo:asset('img/no_image.jpg');
		 $name=!empty(Auth::user()->name)?Auth::user()->name:'No name';
		}else{
			$photo=asset('img/no_image.jpg');
			 $name='No name';
		}
		@endphp
		<div class="mb-3">
			<div class="text-center mx-auto profile-navbar">
				<div class="text-center">
					<img src="{{$photo}}" alt={{$name}} width="32" height="32" class="rounded-circle flex-shrink-0" style="border:1px solid lightgrey">
				</div>
				<p class="mb-0 ms-3 me-3" style="font-size:0.8rem;">
					Hi,
				 @auth
					 {{!empty(Auth::user()->name)?Auth::user()->name:'No name'}}
				 @endauth
				 @guest
					 Guest
				 @endguest
			 </p>
				<p class="mb-0 ms-3 me-3" style="font-size:0.8rem;">
					@auth
					 {{'('.substr(Auth::user()->email,0,5).'***'.')'}}
					@endauth
				</p>
			</div>
		</div>
	@endif
</div>

			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				@guest
				<li class="nav-item">
					<a class="nav-link active text-white" aria-current="page" href="{{route('bucket-lists.index')}}">Top</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active text-white" aria-current="page" href="{{route('login.getLogin')}}">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active text-white" aria-current="page" href="{{route('general.getAbout')}}">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active text-white" aria-current="page" href="{{route('general.getContact')}}">Contact</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active text-white" aria-current="page" href="{{route('general.getHelp')}}">Help</a>
				</li>
				@endguest
				@auth
				<li class="nav-item">
					<a class="nav-link active text-white" aria-current="page" href="{{route('bucket-lists.show',['user'=>Auth::id()])}}">My Todos</a>
				</li>
				 <li class="nav-item">
					<a class="nav-link active text-white" aria-current="page" href="{{route('user.showProfile',['user'=>Auth::id()])}}">Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active text-white" aria-current="page" href="{{route('user.getFavorites',['user'=>Auth::id()])}}">Favorites</a>
				</li>
				 <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Other
					</a>
			<ul class="dropdown-menu mb-3">
				<li class="dropdown-item">
					<a class="nav-link active" aria-current="page" href="{{route('bucket-lists.index')}}">Top</a>
				</li>
			  <li class="dropdown-item">
					<a class="nav-link active" aria-current="page" href="{{route('password_reset.email.form')}}">Password Reset</a>
				</li>
				<li class="dropdown-item">
					<a class="nav-link active" aria-current="page" href="{{route('general.getAbout')}}">About</a>
				</li>
				<li class="dropdown-item">
					<a class="nav-link active" aria-current="page" href="{{route('general.getContact')}}">Contact</a>
				</li>
				<li class="dropdown-item">
					<a class="nav-link active" aria-current="page" href="{{route('general.getHelp')}}">Help</a>
				</li>
					<li class="dropdown-item">
					<a class="nav-link active" aria-current="page" href="{{route('register.getCancel')}}">Cancel</a>
				</li>
				<li class="dropdown-item">
					<a class="nav-link active" aria-current="page" href="{{route('login.logout')}}">Logout</a>
				</li>
			</ul>
			</li>
				@endauth
			<form class="d-flex ms-3" role="search" method="get" action="{{route('bucket-lists.searchKeyword')}}">
				 <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword" value="{{!empty($keyword)?$keyword:''}}">
				<button class="btn btn-outline-success" type="submit">Search</button>
			</form>
			<div class="text-end ms-3 pe-3 d-inline-block">
	@if(session('is_userinfo_hide')!==true)
		<div class="text-center profile-dropdown">
			@auth
			<a href="{{route('user.showProfile',['user'=>Auth::id()])}}">
		    <img src="{{!empty(Auth::user()->profile->photo)?Auth::user()->profile->photo:asset('img/no_image.jpg')}}" alt="{{!empty(Auth::user()->name)?Auth::user()->name:'No name'}}" width="32" height="32" class="rounded-circle flex-shrink-0 me-3" style="border:1px solid lightgrey;position:absolute;right:0;">
		  </a>
			@endauth
			@guest
		    <img src="{{asset('img/no_image.jpg')}}" alt="No name" width="32" height="32" class="rounded-circle flex-shrink-0 me-3" style="border:1px solid lightgrey;position:absolute;right:0;">
			@endguest
		</div>
	@endif
</div>

		</div>
	</div>
</nav>
