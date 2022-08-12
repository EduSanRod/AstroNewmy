@extends('template')

@section('head')

<title>{{ Auth::user()->name; }} Profile</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/user/settings.css') }}">
@endsection

@section('section')

<div id="profile-container">
	<h2>{{ Auth::user()->name; }} Profile</h2>

	@isset($message)
	<div class="alert alert-danger" role="alert">
		{!! nl2br(e($message))!!}
	</div>
	@endisset

	<form action="{{ route('user.update') }}" method="post">
		@csrf

		<!-- UserName -->	
		<label for="username">UserName</label>
		<input type="text" id="username" name="username" class="form-input" minlength="4" maxlength="15" placeholder="{{ Auth::user()->name; }}" />

		<!-- Email input -->
		<label for="email">Email</label>
		<input type="email" id="email" name="email" class="form-input" placeholder="{{ Auth::user()->email; }}" />

		<h3>Change Password</h3>
		<!-- Password input -->
		<label for="old_password">Old Password</label>
		<input type="password" id="old_password" name="old_password" class="form-input" minlength="8" />

		<!-- Password input -->
		<label for="new_password">New Password</label>
		<input type="password" id="new_password" name="new_password" class="form-input" minlength="8" />


		<!-- Confirm password input -->
		<label for="confirm_password">Confirm Password</label>
		<input type="password" id="confirm_password" name="confirm_password" class="form-input" onkeyup='check();' />
		<span id='message'></span>

		<input type="submit" class="submit-button" value="Save changes">
	</form>

	<button onclick="deleteAccount()" class="delete-button">Delete account</button>

</div>

@endsection

<script>
	var check = function() {
		if (document.getElementById('new_password').value == document.getElementById('confirm_password').value) {
			document.getElementById('message').style.color = 'green';
			document.getElementById('message').innerHTML = 'matching';
		} else {
			document.getElementById('message').style.color = 'red';
			document.getElementById('message').innerHTML = 'not matching';
		}
	}
</script>

<script>
	function deleteAccount(){
		let confirmation = "Are you sure you want to delete your account?";
		if (confirm(confirmation) == true) {
			window.location.href = "{{ route('user.delete') }}";
		}
	}
</script>