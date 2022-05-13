@extends('template')

@section('head')

<title>AstroNewmy Login</title>

<style>

</style>

@endsection

@section('section')

@isset($message)
<div class="alert alert-danger" role="alert">
	{{ $message }}
</div>
@endisset

<form action="{{ route('login.authenticate') }}" class="mx-auto m-4" style="width: 500px;">
@csrf
@method('GET')
	<!-- Email input -->
	<div class="form-outline mb-4">
		<label class="form-label" for="form2Example1">Email address</label>
		<input type="email" id="email" name="email" class="form-control" placeholder="JohnDoe@gmail.com"/>
	</div>

	<!-- Password input -->
	<div class="form-outline mb-4">
		<label class="form-label" for="password">Password</label>
		<input type="password" id="password" name="password" class="form-control" placeholder="MyPassword"/>
	</div>

	<!-- Submit button -->
	<input type="submit" class="btn btn-primary btn-block w-50 mb-4 mx-auto" value="Sign in"></button>

</form>

<div class="col text-center py-4">
	<!-- Simple link -->
	<a href="#!">Forgot password?</a>
</div>

<!-- Register buttons -->
<div class="text-center col">
	<p>Not a member? <a href="#!">Register</a></p>
</div>


@endsection