<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,0" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>  
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>  
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>  
	@yield('head')
</head>

<body class="container" style="width:100%;">
	<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
		<a href="home" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
			<img src="/imagenes/iconos/mainLogo.PNG" alt="Main logo website" height="60px">
		</a>

		<ul class="nav nav-pills pt-4">
			<li class="nav-item"><a href="/home" class="nav-link {{ Request::routeIs('home.display') ? 'active' : '' }}" aria-current="page">Home</a></li>
			<li class="nav-item"><a href="/coordenates_finder_form" class="nav-link {{ Request::routeIs('coords.*') ? 'active' : '' }}" aria-current="page">Coords Finder</a></li>
			<li class="nav-item"><a href="/article" class="nav-link {{ Request::routeIs('article.*') ? 'active' : '' }}" aria-current="page">Articles</a></li>
			<li class=" nav-item"><a href="/about" class="nav-link {{ Request::routeIs('about.*') ? 'active' : '' }}" aria-current="page">About</a></li>
			@if (Auth::guest())
				<li class="active nav-item "><a href="/login" class="nav-link active" aria-current="page">Login</a></li>
			@else
				<div class="dropdown ">
					<button class="btn dropdown-toggle d-flex flex-row align-items-center" type="button" data-toggle="dropdown"><span class="px-2 h5 font-weight-bold">{{ Auth::user()->name; }}</span><span class="material-symbols-outlined ">person</span></button>
					<ul class="dropdown-menu">
						<li><a href="{{ route('user.articles') }}">Profile</a></li>
						<li><a href="{{ route('user.setting') }}">Settings</a></li>
						<li><a href="{{ route('login.logout') }}">Logout</a></li>
					</ul>
				</div>
			@endif
		</ul>
	</header>

	<section>
		@yield('section')
	</section>

	<footer class="py-3 my-4">
		<ul class="nav justify-content-center border-bottom pb-3 mb-3">
			<li class="nav-item"><a href="/home" class="nav-link px-2 text-muted">Home</a></li>
			<li class="nav-item"><a href="/coordenates_finder_form" class="nav-link px-2 text-muted">Coords Finder</a></li>
			<li class="nav-item"><a href="/article" class="nav-link px-2 text-muted">Articles</a></li>
			<li class="nav-item"><a href="/about" class="nav-link px-2 text-muted">About</a></li>
		</ul>
		<p class="text-center text-muted">© 2022 AstroNewmy</p>
	</footer>

</body>

</html>