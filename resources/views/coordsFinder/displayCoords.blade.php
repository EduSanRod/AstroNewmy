@extends('template')

@section('head')
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>  
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>  
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>  
	<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">  
	<title>AstroNewmy Coords Finder</title>
@endsection

@section('header')
	<a href="home" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
		<img src="/imagenes/iconos/mainLogo.PNG" alt="Main logo website" height="60px">
	</a>
	<ul class="nav nav-pills">
		<li class="nav-item"><a href="home" class="nav-link " aria-current="page">Home</a></li>
		<li class="nav-item"><a href="coordenates_finder_form" class="nav-link active">Coords Finder</a></li>
		<li class="nav-item"><a href="#" class="nav-link">Articles</a></li>
		<li class="nav-item"><a href="#" class="nav-link">About</a></li>
	</ul>
@endsection

@section('section')
		<div class ='col-sm-6 d-flex justify-content-around'>
			<h3>
				Country
				<span class="text-muted">{{ $country }}</span>
			</h3>
		</div>
		<div class ='col-sm-6 d-flex justify-content-around'>
			<h3>
				City
				<span class="text-muted">{{ $city }}</span>
			</h3>
		</div>

		<div class ='col-sm-4 d-flex justify-content-around'>
			<h3>
				Date
				<span class="text-muted">{{ $datepick }}</span>
			</h3>
		</div>
		<div class ='col-sm-4 d-flex justify-content-around'>
			<h3>
				Start Hour
				<span class="text-muted">{{ $timeStart }}</span>
			</h3>
		</div>
		<div class ='col-sm-4 d-flex justify-content-around'>
			<h3>
				End Hour
				<span class="text-muted">{{ $timeEnd }}</span>
			</h3>
		</div>

		@foreach($celestialObjects as $celestialObject)
			<p>Celestial Object: {{ $celestialObject }}</p>
		@endforeach
	
@endsection

