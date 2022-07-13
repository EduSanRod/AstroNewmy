@extends('template')

@section('head')

<title>{{ Auth::user()->name; }} Profile</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/user/settings.css') }}">
@endsection

@section('section')

<div id="profile-container">
	<h2>{{ Auth::user()->name; }} Profile</h2>
	<form action="{{ route('user.update') }}" method="post">
		@csrf

		<h3>Username</h3>
		<input type="text" id="username" name="username" class="form-input" minlength="4" maxlength="15" placeholder="{{ Auth::user()->name; }}" />

		<h3>Email</h3>
		<input type="email" id="email" name="email" class="form-input" placeholder="{{ Auth::user()->email; }}" />

		<input type="submit" class="submit-button" value="Save changes">
	</form>

	<a href="{{ route('user.delete') }}" class="delete-button" title="Delete account">Delete account</a>

</div>

@endsection