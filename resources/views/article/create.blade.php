@extends('template')

@section('head')
<title>AstroNewmy - Article</title>

<link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

@endsection

@section('section')

<div id="alertMessage" role="alert" class="alert">
</div>

<form action="{{ route('article.store') }}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" class="mx-auto m-4">
	@csrf
	<div class="form-group">
		<label for="article_title">Title</label>
		<input type="text" class="form-control" id="article_title" name="article_title" minlength="4" maxlength="25" placeholder="Title">
	</div>

	<div class="form-group">
		<label for="article_image">Image of the article</label>
		<input type="file" class="form-control-file" id="article_image" name="article_image" accept="image/*">
	</div>

	<div class="form-group">
		<label for="article_description">Description (optional)</label>
		<textarea class="form-control" id="article_description" name="article_description" rows="4"></textarea>
	</div>

	<div class="form-group">
		<label for="article_source">Source link (optional)</label>
		<input type="url" class="form-control" id="article_source" name="article_source">
	</div>

	<input type="hidden" name="article_user_id" value="{{ Auth::user()->id; }}">

	<button type="button" id="add-equipment-button" class="btn btn-success mb-4">Add Equipment</button>
	<div id="equipment-form-container" class="mb-4">

	</div>

	<input type="submit" class="btn btn-primary" value="Create Article">

</form>

<a href="{{ route('article.index') }}" class="btn btn-secondary">
	Back
</a>

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

				let divContainerInput = document.createElement("div");
				divContainerInput.id = "div_container_" + equipmentNumber;
				divContainerInput.classList.add("border");
				divContainerInput.classList.add("p-4");
				divContainerInput.classList.add("mb-4");

				let divNameInput = document.createElement("div");
				divNameInput.id = "div_equipment_name_" + equipmentNumber;
				divNameInput.classList.add("form-group");
				divNameInput.classList.add("p-2");
				divNameInput.innerHTML = "<label for='equipment_name_" + equipmentNumber + "'>Name of the equipment</label><input type='text' minlength='4' maxlength='25' class='form-control' name='equipment_name_" + equipmentNumber + "'>";
				divContainerInput.append(divNameInput);

				let divPriceInput = document.createElement("div");
				divPriceInput.id = "div_equipment_price_" + equipmentNumber;
				divPriceInput.classList.add("form-group");
				divPriceInput.classList.add("p-2");
				divPriceInput.innerHTML = "<label for='equipment_price_" + equipmentNumber + "'>Price of the equipment (optional)</label><input type='number' class='form-control' step='.01' name='equipment_price_" + equipmentNumber + "'>";
				divContainerInput.append(divPriceInput);

				let divLinkInput = document.createElement("div");
				divLinkInput.id = "div_equipment_link_" + equipmentNumber;
				divLinkInput.classList.add("form-group");
				divLinkInput.classList.add("p-2");
				divLinkInput.innerHTML = "<label for='equipment_link_" + equipmentNumber + "'>Link to get more info of the equipment (optional)</label><input type='url' class='form-control' name='equipment_link_" + equipmentNumber + "'>";
				divContainerInput.append(divLinkInput);

				let ButtonDeleteInput = document.createElement("button");
				ButtonDeleteInput.type = "button";
				ButtonDeleteInput.id = equipmentNumber;
				ButtonDeleteInput.classList.add("button-delete-equipment");
				ButtonDeleteInput.classList.add("btn");
				ButtonDeleteInput.classList.add("btn-danger");
				ButtonDeleteInput.innerHTML = "Delete";
				ButtonDeleteInput.onclick = function(){
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