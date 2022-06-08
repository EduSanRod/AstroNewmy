@extends('template')

@section('head')

<title>AstroNewmy Login</title>

<link rel="stylesheet" type="text/css" href="{{ asset('css/login/index.css') }}">

@endsection

@section('section')

@isset($message)
<div class="alert alert-danger" role="alert">
	{{ $message }}
</div>
@endisset

<div class="form-container">
	<form action="{{ route('login.authenticate') }}" method="post" class="form">
		@csrf
		@method('POST')
		<!-- Email input -->
		<label for="email" >Email address</label>
		<input type="email" id="email" name="email" class="form-input" placeholder="JohnDoe@gmail.com" />

		<!-- Password input -->
		<label for="password" >Password</label>
		<input type="password" id="password" class="form-input" name="password" />

		<!-- Submit button -->
		<input type="submit" value="Sign in" class="submit-button"></button>

	</form>

	<div class="register-container">
		<p>Not a member? <a href="{{ route('login.create-form') }}">Register</a></p>
	</div>
</div>

@endsection