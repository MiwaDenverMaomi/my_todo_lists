<div class="text-end pe-3">
	@if(session('is_userinfo_hide')!==true)
  	<p class="mb-0">
	   Hi,
	   @auth
     {{!empty(Auth::user()->name)?Auth::user()->name:'No name'}}
	   @endauth
	   @guest
	     Guest
	   @endguest
	  </p>
	  <p class="mb-0">
		 @auth
       {{'('.substr(Auth::user()->email,0,5).'***'.')'}}
		 @endauth
	  </p>
	@endif
</div>