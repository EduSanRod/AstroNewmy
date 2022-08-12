@extends('template')

@section('head')

<title>AstroNewmy Login</title>

<link rel="stylesheet" type="text/css" href="{{ asset('css/login/create.css') }}">

@endsection

@section('section')

@isset($message)
<div class="alert alert-danger" role="alert">
	{{ $message }}
</div>
@endisset

<div id="alertMessage" role="alert" class="alert">
</div>

<div class="form-container">
	<form action="{{ route('login.create') }}" method="post" class="form" onsubmit="return validateForm()">
		@csrf
		<!-- UserName -->
		<label for="username">User Name</label>
		<input type="text" id="username" name="username" class="form-input" minlength="4" maxlength="15" />


		<!-- Email input -->
		<label for="email">Email address</label>
		<input type="email" id="email" name="email" class="form-input"/>


		<!-- Password input -->
		<label for="password">Password</label>
		<input type="password" id="password" name="password" class="form-input" minlength="8" />


		<!-- Confirm password input -->
		<label for="confirm_password">Confirm Password</label>
		<input type="password" id="confirm_password" name="confirm_password" class="form-input" onkeyup='check();' />
		<span id='message'></span>


		<!-- Submit button -->
		<input type="submit" value="Register" class="submit-button">

	</form>

	<!-- Register buttons -->
	<div class="login-container">
		<p>Already a member? <a href="{{ route('login.index') }}">Login</a></p>
	</div>
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

		if (document.getElementById('username').value.length < 4) {
			alertMessage = alertMessage + " - Username is too short. <br>";
			formStatus = false;
		}

		if (document.getElementById('email').value.length < 3) {
			alertMessage = alertMessage + " - Email is too short. <br>";
			formStatus = false;
		}

		if (document.getElementById('password').value.length < 8) {
			alertMessage = alertMessage + " - Password is too short. <br>";
			formStatus = false;
		}

		if (document.getElementById('password').value != document.getElementById('confirm_password').value) {
			alertMessage = alertMessage + " - Password fields do not match. <br>";
			formStatus = false;
		}

		if (!formStatus) {
			document.getElementById('alertMessage').innerHTML = alertMessage;
			document.getElementById('alertMessage').classList.add("alert-danger");
			document.getElementById('alertMessage').style.display = "block";

		}

		return formStatus;

	}
</script>