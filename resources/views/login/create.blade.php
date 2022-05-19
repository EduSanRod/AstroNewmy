@extends('template')

@section('head')

<title>AstroNewmy Login</title>

<style>

</style>

@endsection

@section('section')

<div id="alertMessage" role="alert" class="alert">

</div>

<form action="{{ route('login.create') }}" method="post" onsubmit="return validateForm()" class="mx-auto m-4" style="width: 500px;">
	@csrf
	<!-- UserName -->
	<div class="form-outline mb-4">
		<label class="form-label" for="username">User Name</label>
		<input type="text" id="username" name="username" class="form-control" minlength="4" maxlength="15" />
	</div>

	<!-- Email input -->
	<div class="form-outline mb-4">
		<label class="form-label" for="form2Example1">Email address</label>
		<input type="email" id="email" name="email" class="form-control" />
	</div>

	<!-- Password input -->
	<div class="form-outline mb-4">
		<label class="form-label" for="password">Password</label>
		<input type="password" id="password" name="password" class="form-control" minlength="8" />
	</div>

	<!-- Confirm password input -->
	<div class="form-outline mb-4">
		<label class="form-label" for="confirm_password">Confirm Password</label>
		<input type="password" id="confirm_password" name="confirm_password" class="form-control" onkeyup='check();' />
		<span class="form-label" id='message'></span>
	</div>

	<!-- Submit button -->
	<input type="submit" class="btn btn-primary btn-block w-50 mb-4 mx-auto" value="Register">

</form>

<!-- Register buttons -->
<div class="text-center col">
	<p>Already a member? <a href="{{ route('login.index') }}">Login</a></p>
</div>
@endsection
<script>
	var check = function() {
		if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
			document.getElementById('message').style.color = 'green';
			document.getElementById('message').innerHTML = 'matching';
		} else {
			document.getElementById('message').style.color = 'red';
			document.getElementById('message').innerHTML = 'not matching';
		}
	}

	function validateForm() {

		let formStatus = true;

		let alertMessage = "<b>Error:</b> <br>";

		if (document.getElementById('username').value.length < 4 ) {
			alertMessage = alertMessage + " - Username is too short. <br>";
			formStatus =  false;
		}

		if (document.getElementById('email').value.length < 3 ) {
			alertMessage = alertMessage + " - Email is too short. <br>";
			formStatus =  false;
		}

		if (document.getElementById('password').value.length < 8 ) {
			alertMessage = alertMessage + " - Password is too short. <br>";
			formStatus =  false;
		}

		if (document.getElementById('password').value != document.getElementById('confirm_password').value) {
			alertMessage = alertMessage + " - Password fields do not match. <br>";
			formStatus =  false;
		}

		if(!formStatus){
			document.getElementById('alertMessage').innerHTML = alertMessage;
			document.getElementById('alertMessage').classList.add("alert-danger");

		}

		return formStatus;

	}

</script>