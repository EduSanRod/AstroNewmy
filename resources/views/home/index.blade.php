@extends('template')

@section('head')
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>  
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>  
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>  
	<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">  
	<title>AstroNewmy Home</title>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection

@section('header')
	<a href="home" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
		<img src="/imagenes/iconos/mainLogo.PNG" alt="Main logo website" height="60px">
	</a>
	<ul class="nav nav-pills">
		<li class="nav-item"><a href="home" class="nav-link active" aria-current="page">Home</a></li>
		<li class="nav-item"><a href="coordenates_finder_form" class="nav-link ">Coords Finder</a></li>
		<li class="nav-item"><a href="#" class="nav-link">Articles</a></li>
		<li class="nav-item"><a href="#" class="nav-link">About</a></li>
	</ul>
@endsection

@section('section')

<div class="container">
	<h2 class="d-flex justify-content-center">{{ $starredCelestialObject }}</h2>
	<div id="myCarousel" class="carousel slide" data-ride="carousel" >
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" style="width:100%;">
			<div class="item active">
				<img src="imagenes/home-carousel/{{ $starredCelestialObject }}/0.jpg" alt="Image of {{ $starredCelestialObject }}" style="width:100%; height:50em;">
			</div>

			<div class="item">
				<img src="imagenes/home-carousel/{{ $starredCelestialObject }}/1.jpg" alt="Image of {{ $starredCelestialObject }}" style="width:100%; height:50em;">
			</div>
			
			<div class="item">
				<img src="imagenes/home-carousel/{{ $starredCelestialObject }}/2.jpg" alt="Image of {{ $starredCelestialObject }}" style="width:100%; height:50em;">
			</div>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a>
  	</div>
</div>

	
@endsection