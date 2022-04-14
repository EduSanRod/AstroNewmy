<!DOCTYPE html>
<html lang="en">
	<head>
		@yield('head')
	</head>
	<body class="container">
		<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
			<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
				<span class="fs-4">AstroNewmy</span>
			</a>
			<ul class="nav nav-pills">
				<li class="nav-item"><a href="#" class="nav-link" aria-current="page">Home</a></li>
				<li class="nav-item"><a href="#" class="nav-link active">Coords Finder</a></li>
				<li class="nav-item"><a href="#" class="nav-link">Articles</a></li>
				<li class="nav-item"><a href="#" class="nav-link">About</a></li>
			</ul>
			
		</header>

		<section>
			@yield('section')
		</section>

		<footer class="py-3 my-4">
			<ul class="nav justify-content-center border-bottom pb-3 mb-3">
				<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
				<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Coords Finder</a></li>
				<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Articles</a></li>
				<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
			</ul>
			<p class="text-center text-muted">© 2022 AstroNewmy</p>
		</footer>


		
	</body>
</html>