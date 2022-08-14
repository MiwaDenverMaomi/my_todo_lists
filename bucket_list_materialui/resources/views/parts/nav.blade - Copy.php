 <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3 ps-3 pe-3" aria-label="Offcanvas navbar large">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('bucket-lists.index')}}">My Todo Lists</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="offcanvas offcanvas-end text-bg-dark"  data-toggle="collapse"  tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbar2Label">My Todo Lists</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
						<li class="nav-item">
              <div class="btn-group">
	              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Menu</button>
	              <div class="dropdown-menu">
								 @auth
		              <a class="dropdown-item" href="{{route('bucket-lists.show',['user'=>Auth::id()])}}">My Todos</a>
		              <a class="dropdown-item" href="{{route('user.showProfile',['user'=>Auth::id()])}}">Profile</a>
		              <a class="dropdown-item" href="{{route('user.getFavorites',['user'=>Auth::id()])}}">Favorites</a>
		              <a class="dropdown-item" href="{{route('password_reset.email.form')}}">Password Reset</a>
		              <a class="dropdown-item" href="{{route('register.getCancel')}}">Cancel</a>
		              <a class="dropdown-item" href="{{route('login.logout')}}">Logout</a>
								 @endauth
		              <div class="dropdown-divider"></div>
		              <a class="dropdown-item" href="{{route('bucket-lists.index')}}">Top</a>
		              <a class="dropdown-item" href="{{route('general.getAbout')}}">About</a>
									<a class="dropdown-item" href="{{route('general.getContact')}}">Contact</a>
		              <a class="dropdown-item" href="{{route('general.getHelp')}}">Help</a>
								 @guest
								  <a class="dropdown-item" href="{{route('login.getLogin')}}">Login</a>
		             @endguest
	             </div>
	            </div>
	          </li>
          </ul>
          <form class="d-flex mt-3 mt-lg-0" role="search" method="get" action="{{route('bucket-lists.searchKeyword')}}">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword" value="{{!empty($keyword)?$keyword:''}}">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>
  </nav>
