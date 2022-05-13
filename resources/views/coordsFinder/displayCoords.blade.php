@extends('template')

@section('head')
	<title>AstroNewmy Coords Finder</title>
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
				<span class="text-muted">{{ $city }} ({{ $latitude }}, {{ $longitude }})</span>
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

