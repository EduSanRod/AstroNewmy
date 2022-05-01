<!DOCTYPE html>
<html lang="en">
	<head>
		@yield('head')
	</head>
	<body class="container" style="width:100%;">
		<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
			@yield('header')
		</header>

		<section>
			@yield('section')
		</section>

		<footer class="py-3 my-4">
			<ul class="nav justify-content-center border-bottom pb-3 mb-3">
				<li class="nav-item"><a href="Home" class="nav-link px-2 text-muted">Home</a></li>
				<li class="nav-item"><a href="coordenates_finder_form" class="nav-link px-2 text-muted">Coords Finder</a></li>
				<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Articles</a></li>
				<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
			</ul>
			<p class="text-center text-muted">© 2022 AstroNewmy</p>
		</footer>

	</body>
</html>