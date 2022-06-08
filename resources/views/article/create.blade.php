@extends('template')

@section('head')
<title>AstroNewmy - Article</title>

<link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/article/create.css') }}">
@endsection

@section('section')

<div id="alertMessage" role="alert" class="alert">
</div>

<div class="form-container">
	<form action="{{ route('article.store') }}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
		@csrf
		<label for="article_title">Title</label>
		<input type="text" id="article_title" name="article_title" class="form-input" minlength="4" maxlength="25">

		<label for="article_image">Image of the article</label>
		<input type="file" id="article_image" name="article_image" accept="image/*">

		<label for="article_description">Description (optional)</label>
		<textarea id="article_description" name="article_description" rows="5"></textarea>

		<input type="hidden" name="article_user_id" value="{{ Auth::user()->id; }}">

		<button type="button" id="add-equipment-button">Add Equipment</button>

		<div id="equipment-form-container">
		</div>

		<input type="submit" value="Create Article" class="create-article">

	</form>

	<a href="{{ route('article.index') }}" class="back-link">
		Back
	</a>
</div>



@endsection
<script>
	function validateForm() {

		let formStatus = true;

		let alertMessage = "<b>Error:</b> <br>";

		if (document.getElementById('article_title').value.length < 4) {
			alertMessage = alertMessage + " - Title is too short. <br>";
			formStatus = false;
		}

		if (document.getElementById("article_image").files.length == 0) {
			alertMessage = alertMessage + " - Image not uploaded. <br>";
			formStatus = false;
		}

		if (!formStatus) {
			document.getElementById('alertMessage').innerHTML = alertMessage;
			document.getElementById('alertMessage').classList.add("alert-danger");

		}

		return formStatus;

	}

	window.addEventListener("load", function() {
		let equipmentNumber = 1;

		const $buttonAddEquipment = document.getElementById("add-equipment-button");
		const $equipmentFormContainer = document.getElementById("equipment-form-container");

		$buttonAddEquipment.addEventListener("click", function() {
			//When the button of add equipment is pressed, add a new field to the form to add the equipment information.

			//Make so that only 5 equipments can be assigned to a single post.
			if (equipmentNumber <= 5) {
				const fragment = document.createDocumentFragment();

				//Create the container for the equipment inputs
				let divContainerInput = document.createElement("div");
				divContainerInput.id = "div_container_" + equipmentNumber;
				divContainerInput.classList.add("equipment-container");

				//Input for the type of equipment
				let divTypeInput = document.createElement("div");
				divTypeInput.id = "div_equipment_type_" + equipmentNumber;
				divTypeInput.innerHTML = "<label for='equipment_type_" + equipmentNumber + "'>Type of the equipment</label><br><select name='equipment_name_" + equipmentNumber + "' class='equipment-type'><option value='telescope'>Telescope</option><option value='camera'>Camera</option><option value='other'>Other</option></select>";
				divContainerInput.append(divTypeInput);

				//Input for the name of the equipment
				let divNameInput = document.createElement("div");
				divNameInput.id = "div_equipment_name_" + equipmentNumber;
				divNameInput.innerHTML = "<label for='equipment_name_" + equipmentNumber + "'>Name of the equipment</label><br><input type='text' minlength='4' maxlength='25' class='form-input equipment-name' name='equipment_name_" + equipmentNumber + "'>";
				divContainerInput.append(divNameInput);

				//Button to delete the equipment fragment
				let ButtonDeleteInput = document.createElement("button");
				ButtonDeleteInput.type = "button";
				ButtonDeleteInput.id = equipmentNumber;
				ButtonDeleteInput.classList.add("button-delete-equipment");
				ButtonDeleteInput.innerHTML = "Delete";
				ButtonDeleteInput.onclick = function() {
					document.getElementById('div_container_' + this.id).remove();
				}
				divContainerInput.append(ButtonDeleteInput);

				fragment.append(divContainerInput);

				$equipmentFormContainer.append(fragment);

				equipmentNumber++;
			}
		});

	});
</script>