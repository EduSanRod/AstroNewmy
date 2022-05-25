@extends('template')

@section('head')
<title>AstroNewmy Coords Finder</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/coordsFinder/display.css') }}" >


@endsection

@section('section')
<article>
	<div class='col-sm-6 d-flex justify-content-around'>
		<h3>
			Country
			<span class="text-muted">{{ $country }}</span>
		</h3>
	</div>
	<div class='col-sm-6 d-flex justify-content-around'>
		<h3>
			City
			<span class="text-muted">{{ $city }} ({{ $latitude }}, {{ $longitude }})</span>
		</h3>
	</div>

	<div class='col-sm-4 d-flex justify-content-around'>
		<h3>
			Date
			<span class="text-muted">{{ $datepick }}</span>
		</h3>
	</div>
	<div class='col-sm-4 d-flex justify-content-around'>
		<h3>
			Start Hour
			<span class="text-muted">{{ $timeStart }}</span>
		</h3>
	</div>
	<div class='col-sm-4 d-flex justify-content-around'>
		<h3>
			End Hour
			<span class="text-muted">{{ $timeEnd }}</span>
		</h3>
	</div>
</article>

<article>
	<!--
		@foreach($celestialObjects as $celestialObject)
		<p>Celestial Object: {{ $celestialObject }}</p>
		@endforeach
	-->

	<div class="mt-4">
		<form>
			<input type="range" class="form-range" id="rangeController" min="0" max="100" value="0">
		</form>
	</div>

	<div id="coords-displayer">
		<img id="background-image" src="imagenes/coordDisplayer/background.jpg" alt="Background image of the horizon">
		@foreach($celestialObjects as $celestialObject)
		<img id="{{ $celestialObject }}" class="celestialObjectImages" src="imagenes/celestialobject/{{ $celestialObject }}/main/{{ $celestialObject }}.svg" alt="Image of {{ $celestialObject }}">
		@endforeach
	</div>
	
</article>


@endsection

<script>
	const resultData = {!! json_encode($resultData, JSON_HEX_TAG) !!};
	let rangeController;

	console.log(resultData);

	window.addEventListener('load', function(){
		rangeController = document.getElementById("rangeController");
		let rangeValue = rangeController.value;
		for (let resultDataObject of resultData) {
			setCelestialObjectPosition(rangeValue, resultDataObject);
		}

		rangeController.addEventListener('change', function(){
			let rangeValue = rangeController.value;
			for (let resultDataObject of resultData) {
				setCelestialObjectPosition(rangeValue, resultDataObject);
			}

		});
	});

	

	function setCelestialObjectPosition(rangeValue, resultDataObject){
		//Calculate the position of the svg in the background image with the azimuth and altitude data.
		
		let dataInitialPosition = resultDataObject[0];
		let dataFinalPosition = resultDataObject[1];
		
		//Calculus of the Azimuth (horizontla plane)
		let initialAzimuth = dataInitialPosition['azimuth'] ;
		let finalAzimuth = dataFinalPosition['azimuth'];
		
		let diferentialAzumith = dataFinalPosition['azimuth'] - dataInitialPosition['azimuth'];

		let currentAzimuth = initialAzimuth + (diferentialAzumith * (rangeValue / 100));
		let currentAzimuthPercentage = (currentAzimuth / 360) * 100;

		document.getElementById(resultDataObject[0]['celestialObject']).style.left = parseInt(currentAzimuthPercentage) + "%";

		//Calculus of the Altitude (vertical plane)
		
		let initialAltitude = dataInitialPosition['altitude'];
		let finalAltitude = dataFinalPosition['altitude'];

		let diferentialAltitude = dataFinalPosition['altitude'] - dataInitialPosition['altitude'];

		let currentAltitude = initialAltitude + (diferentialAltitude * (rangeValue / 100));
		let currentAltitudePercentage = (currentAltitude / 90) * 100;

		document.getElementById(resultDataObject[0]['celestialObject']).style.bottom = parseInt(20 + ((currentAltitudePercentage * 80) / 100)) + "%";

		console.log("------------------------------");
		console.log("Name: " + dataInitialPosition['celestialObject']);
		console.log("------------------------------");
		console.log("Initial Altitude: " + initialAltitude);
		console.log("Current altitude: " + currentAltitude);
		console.log("Current altitude (%): " + currentAltitudePercentage);
		console.log("Final Altitude: " + finalAltitude);
		console.log("------");
		console.log("Initial Azimuth: " + initialAzimuth);
		console.log("Current Azimuth: " + currentAzimuth);
		console.log("Current Azimuth (%): " + currentAzimuthPercentage);
		console.log("Final Azimuth: " + finalAzimuth);
		
	}

</script>