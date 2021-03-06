<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Jekyll v4.0.1">
	<title>Booking Admin</title>

	<!-- Bootstrap core CSS -->
	<link href="/admin/dist/css/bootstrap.css" rel="stylesheet">
	<link href="/css/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="/css/daterangepicker.min.css" rel="stylesheet">
    <link href="/css/select2.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/sweetalert2.min.css" id="theme-styles">
	<link rel="stylesheet" href="/css/font-awesome.min.css">

	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
	</style>
	<!-- Custom styles for this template -->
	<link href="/admin/dashboard.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/">Boooking Movie</a>
		<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
		<h4 class="text-white">Hi {{ Auth::user()->name }}</h4>
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="{{ route('logout') }}"
				onclick="event.preventDefault();
				document.getElementById('logout-form').submit();">Sign out</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</li>
		</ul>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
				<div class="sidebar-sticky pt-3">
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link {{  Request::path() == 'admin/dashboard' ? 'active' : '' }}" href="/admin/dashboard">
								<span data-feather="home"></span>
								Dashboard <span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{  isset($page ) && $page == 'movies' ? 'active' : '' }}" href="/admin/movies">
								<span data-feather="file"></span>
								Movies
							</a>
						</li>
						{{-- <li class="nav-item">
							<a class="nav-link" href="#">
								<span data-feather="shopping-cart"></span>
								Bookings
							</a>
						</li> --}}
						<li class="nav-item">
							<a class="nav-link {{  isset($page ) && $page == 'shows' ? 'active' : '' }}" href="/admin/shows">
								<span data-feather="file-text"></span>
								Shows
							</a>
						</li>
						 <li class="nav-item">
							<a class="nav-link {{  isset($page ) && $page == 'theatres' ? 'active' : '' }}" href="/admin/theatres">
								<span data-feather="bar-chart-2"></span>
								Theatres
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link {{  isset($page ) && $page == 'locations' ? 'active' : '' }}" href="/admin/locations">
								<span data-feather="layers"></span>
								Locations
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{  isset($page ) && $page == 'users' ? 'active' : '' }}" href="/admin/users">
								<span data-feather="users"></span>
								Users
							</a>
						</li>
					</ul>
				</div>
			</nav>

			@yield('content')
		</div>
	</div>
	<script src="/vendor/jquery/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="/admin/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/admin/dist/js/bootstrap.bundle.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
	<script src="/js/sweetalert2.min.js"></script>
	<script src="/js/moment.min.js"></script>
	<script src="/js/select2.min.js"></script>
	<script src="/js/daterangepicker.js?"></script>
	<script src="/js/dataTables.min.js"></script>
	<script src="/js/dataTables.bootstrap4.min.js"></script>
	<script src="/js/didi.js?v={{date('YmmddHis')}}"></script>
	@yield('javascript')
</body>
</html>
