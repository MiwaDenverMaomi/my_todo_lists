 <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3 ps-3 pe-3 z-index-1" aria-label="Offcanvas navbar large">
	@if (!empty(session('status')))
    <div class="alert alert-success text-center flash z-index-2">
        {{ session('status') }}
    </div>
  @endif
    <div class="container-fluid">
      <a class="navbar-brand" href={{route('bucket-lists.index')}}>My Todo Lists</a>
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
	              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</button>
	              <div class="dropdown-menu">
		              <a class="dropdown-item" href="">My Todos</a>
		              <a class="dropdown-item" href="/user/5/show-profile">Profile</a>
		              <a class="dropdown-item" href="#">Favorites</a>
		              <a class="dropdown-item" href="#">Password Reset</a>
		              <a class="dropdown-item" href="#">Cancel</a>
		              <a class="dropdown-item" href="{{route('login.logout')}}">Logout</a>
		              <div class="dropdown-divider"></div>
		              <a class="dropdown-item" href="{{route('bucket-lists.index')}}">Top</a>
		              <a class="dropdown-item" href="{{route('general.getAbout')}}">About</a>
		              <a class="dropdown-item" href="{{route('general.getHelp')}}">Help</a>
		              <a class="dropdown-item" href="{{route('register.getRegister')}}">Create account</a>
		              <a class="dropdown-item" href="{{route('login.getLogin')}}">Login</a>
	             </div>
	            </div>
	          </li>
          </ul>
          <form class="d-flex mt-3 mt-lg-0" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>
  </nav>
