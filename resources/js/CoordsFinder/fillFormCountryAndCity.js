$countrySelector = document.querySelector("#countrySelector");
$citySelector = document.querySelector("#citySelector");

// On load, charge the data of all the countries.

window.addEventListener("load", function(){

	// On load, load the data of all the countries. Api: https://api.teleport.org/api/countries/

	loadCountries();
});

$countrySelector.addEventListener("change", function(){

	//When a country is selected, load the data of the cities of that specific country

	const countryName = selectorUsuarios.options[selectorUsuarios.selectedIndex].value;
	loadCities(countryName);
});

async function loadCountries () {
	// Function to load the country names to the selector
	const response = await fetch('https://api.teleport.org/api/countries/');
  
	if (response.ok) {
		// For each country, add an option to the selecto with the country name.
		const country = await response.json();
		country.forEach(e => {
			// <option value="countryName">countryName</option>
			const option = document.createElement('option');
			option.setAttribute('value', e.name);
			option.setAttribute('id', e.name);
			option.innerHTML = e.name;

			$countrySelector.append(option);
		});
	} else {
	  	throw new Error(`${response.status} - ${response.statusText}`);
	}
}
