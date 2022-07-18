<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/template/template.css') }}">
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
				<button class="dropbtn"><a href="{{ route('user.articles') }}" class="user-link"><img class="person-icon" src="/imagenes/iconos/person.svg" alt="User icon"> {{ Auth::user()->name; }}</a></button>
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