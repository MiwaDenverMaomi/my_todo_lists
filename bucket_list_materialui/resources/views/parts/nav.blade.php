<nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid text-white">
    <a class="navbar-brand text-white" href="{{route('bucket-lists.index')}}">My Todo Lists</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
				@guest
				<li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="{{route('login.getLogin')}}">Login</a>
        </li>
				<li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="{{route('bucket-lists.index')}}">Top</a>
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
          <a class="nav-link active" aria-current="page" href="{{route('password_reset.email.form')}}">Password Reset</a>
        </li>
				<li class="dropdown-item">
          <a class="nav-link active" aria-current="page" href="{{route('register.getCancel')}}">Cancel</a>
        </li>
				<li class="dropdown-item">
          <a class="nav-link active" aria-current="page" href="{{route('login.logout')}}">Logout</a>
        </li>
				<li class="dropdown-item">
          <a class="nav-link activeOth" aria-current="page" href="{{route('bucket-lists.index')}}">Top</a>
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
          </ul>
        </li>
				@endauth
      <form class="d-flex ms-3" role="search">
         <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword" value="{{!empty($keyword)?$keyword:''}}">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
