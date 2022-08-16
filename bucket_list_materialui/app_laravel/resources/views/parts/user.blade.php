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
	@endif

</div>
