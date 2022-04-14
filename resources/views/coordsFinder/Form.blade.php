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

	<style>
		form > ul {
			list-style-type: none;
		}

		li {
			display: inline-block;
		}

		input[type="checkbox"] {
			display: none;
		}

		li > label {
			border: 1px solid #fff;
			padding: 10px;
			display: block;
			position: relative;
			margin: 10px;
			cursor: pointer;
			text-align: center;
		}

		li > label:before {
			background-color: white;
			color: white;
			content: " ";
			display: block;
			border-radius: 50%;
			border: 1px solid grey;
			position: absolute;
			top: -5px;
			left: -5px;
			width: 25px;
			height: 25px;
			text-align: center;
			line-height: 28px;
			transition-duration: 0.4s;
			transform: scale(0);
		}

		label img {
			height: 100px;
			width: 100px;
			transition-duration: 0.2s;
			transform-origin: 50% 50%;
		}

		:checked + label {
			border-color: #ddd;
		}

		:checked + label:before {
			content: "✓";
			background-color: grey;
			transform: scale(1);
		}

		:checked + label img {
			transform: scale(0.9);
			box-shadow: 0 0 5px #333;
			z-index: -1;
		}

	</style>
	<title>AstroNewmy Coords Finder</title>
@endsection

@section('section')
	<form>
		<div class="row mb-4">
			<div class="col">
				<div class="form-outline">
					<label for="exampleFormControlSelect1">Country</label>
					<select class="form-control" id="countrySelector">
						<option>Select a Country</option>
					</select>
				</div>
			</div>
			<div class="col">
				<div class="form-outline">
					<label for="exampleFormControlSelect1">City</label>
					<select class="form-control" id="citySelector">
						<option>Select a City</option>
					</select>
				</div>
			</div>
		</div>

		<div class ="row mb-4">  
			<div class ='col-sm-6'>  
				<div class ="form-group">  
					<label>Date and Hour to start the observation</label>
					<div class ='input-group date' id='datetimepicker1'>  
						<input type ='text' class="form-control" name="dateTimeStart"/>  
						<span class ="input-group-addon">  
							<span class ="glyphicon glyphicon-calendar"></span>  
						</span>  
					</div>  
				</div>  
			</div>  

			<div class ='col-sm-6'>  
				<div class ="form-group">  
					<label>Hour to end the observation</label>
					<div class = 'input-group date' id='datetimepicker'>  
						<input type = 'text' class="form-control" name="timeEnd"/>  
						<span class = "input-group-addon">  
							<span class = "glyphicon glyphicon-time"></span>  
						</span>  
					</div>  
				</div>  
			</div>  

			<script type = "text/javascript">  
				$(function () {  
					$('#datetimepicker').datetimepicker({  
						format: 'LT',
					});  
				});  
				$(function() {  
					$('#datetimepicker1').datetimepicker();  
				});  
			</script>  
				
		</div>  

		<ul>
			@foreach($celestialObjects as $celestialObject)
				<li>
					<input type="checkbox" id="{{ $celestialObject->celestialobject_name }}" name="{{ $celestialObject->celestialobject_name }}" value="{{ $celestialObject->celestialobject_name }}"/>
					<label for="{{ $celestialObject->celestialobject_name }}">
						<img src="{{ $celestialObject->celestialobject_image }}" alt="{{ $celestialObject->celestialobject_name }}"/>
						<br>
						<span>{{ $celestialObject->celestialobject_name }}</span>
					</label>
				</li>
			@endforeach
		</ul>

		<button type="submit" class="btn btn-primary" onsubmit="formValidation()">Search</button>

	</form>
@endsection



<script defer>

	// On load, charge the data of all the countries.

	let countrySelector;
	let citySelector;
	let activableCards;

	window.addEventListener("load", function(){

		// On load, load the data of all the countries. Api: https://countriesnow.space/api/v0.1/countries/
		countrySelector = document.getElementById("countrySelector");
		citySelector = document.getElementById("citySelector");
		activableCards = document.querySelector(".activable-card");
		loadCountries();

		countrySelector.addEventListener("change", function(){

			//When a country is selected, load the data of the cities of that specific country
			const countrySelector = document.getElementById("countrySelector");
			const countryName = countrySelector.options[countrySelector.selectedIndex].value;
			loadCities(countryName);
		});
	});

	async function loadCountries () {
		// Function to load the country names to the selector
		const response = await fetch('https://countriesnow.space/api/v0.1/countries/positions');
	
		if (response.ok) {
			// For each country, add an option to the select with the country name.
			const data = await response.json();
			const country = data["data"];
			country.forEach(e => {
				// <option value="countryName">countryName</option>
				const option = document.createElement('option');
				option.setAttribute('value', e.name);
				option.setAttribute('id', e.iso2);
				option.innerHTML = e.name;
				countrySelector.append(option);
			});
		} else {
			throw new Error(`${response.status} - ${response.statusText}`);
		}
	}

	async function loadCities (countryName) {
		citySelector.innerHTML = "<option>Select a City</option>";
		// Function to load the city names to the selector based on the country
		const rawResponse = await fetch('https://countriesnow.space/api/v0.1/countries/cities', {
			method: 'POST',
			headers: {
				'Accept': 'application/json',
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({"country": countryName})
		});
		const content = await rawResponse.json();
		const city = content["data"];
		city.forEach(e => {
			// <option value="cityName">cityName</option>
			const option = document.createElement('option');
			option.setAttribute('value', e);
			option.setAttribute('id', e);
			option.innerHTML = e;
			citySelector.append(option);
		});
	}

	function formValidation(){

		//Add to the form the celestial object to check coordenates.
	}
</script>