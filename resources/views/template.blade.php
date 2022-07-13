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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/template/template.css') }}">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	@yield('head')
</head>

<body>
	<header>
		<a href="/home">
			<img src="/imagenes/iconos/mainLogo.PNG" alt="Main logo website" height="60px">
		</a>

		<ul>
			<li><a href="{{ route('home.display') }}" class="{{ Request::routeIs('home.display') ? 'active-page' : '' }}">Home</a></li>
			<li><a href="{{ route('wheretostart.index') }}" class="{{ Request::routeIs('wheretostart.*') ? 'active-page' : '' }}">Where to Start</a></li>
			<li><a href="{{ route('article.index') }}" class="{{ Request::routeIs('article.*') ? 'active-page' : '' }}">Articles</a></li>
			<li><a href="{{ route('about.display') }}" class="{{ Request::routeIs('about.*') ? 'active-page' : '' }}">About</a></li>
			@if (Auth::guest())
			<li><a href="/login" class="login" aria-current="page">Login</a></li>
			@else
			<div class="dropdown">
				<button class="dropbtn"><a href="{{ route('user.articles') }}" class="user-link"><span class="person-icon material-symbols-outlined">person</span> {{ Auth::user()->name; }}</a></button>
				<div class="dropdown-content">
					<a href="{{ route('user.articles') }}">Profile</a>
					<a href="{{ route('user.setting') }}">Settings</a>
					<a href="{{ route('login.logout') }}">Logout</a>
				</div>
			</div>
			@endif
		</ul>
	</header>

	<section id="main-section">
		@yield('section')
	</section>

	<footer>
		<ul>
			<li><a href="/home">Home</a></li>
			<li><a href="/coordenates_finder_form">Coords Finder</a></li>
			<li><a href="/article">Articles</a></li>
			<li><a href="/about">About</a></li>
		</ul>
		<p>© 2022 AstroNewmy</p>
	</footer>

</body>

</html>