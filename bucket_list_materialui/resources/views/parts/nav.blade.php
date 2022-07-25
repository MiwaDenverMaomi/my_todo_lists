@section('nav')
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3 ps-3 pe-3">
	<div class="btn-group">
	<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</button>
	<div class="dropdown-menu">
		<a class="dropdown-item" href="">My Todos</a>
		<a class="dropdown-item" href="/user/5/show-profile">Profile</a>
		<a class="dropdown-item" href="#">Favorites</a>
		<a class="dropdown-item" href="#">Password Reset</a>
		<a class="dropdown-item" href="#">Cancel</a>
		<a class="dropdown-item" href="/logout">Logout</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="#">Top</a>
		<a class="dropdown-item" href="#">About</a>
		<a class="dropdown-item" href="#">Help</a>
		<a class="dropdown-item" href="/register">Create account</a>
		<a class="dropdown-item" href="/login">Login</a>
	</div>
	</div>
	 <a class="navbar-brand ms-3" href="#">ToDo App</a>
	 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse justify-content-end" id="navbarNav4">
		<form class="col-12 col-lg-auto mb-3 mb-lg-0" role="search">
		<input type="search" class="form-control" placeholder="Search..." aria-label="Search">
	  </form>
	</div>
</div>
  <div>

  </div>
</nav>
@endsection
