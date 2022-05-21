@extends('template')

@section('head')

<title>{{ Auth::user()->name; }} Profile</title>

@endsection

@section('section')

<div class="card-body p-4">
	<h2>User Information</h2>
	<hr class="mt-0 mb-4">
	<div class="row pt-1">
		<form class="row pt-1" action="{{ route('user.update') }}" method="post">
		@csrf
			<div class="col-6 mb-3 inline">
				<h3>Username</h3>
				<input type="text" id="username" name="username" class="form-control" minlength="4" maxlength="15" placeholder="{{ Auth::user()->name; }}"/>
			</div>
			<div class="col-6 mb-3 inline">
				<h3>Email</h3>
				<input type="email" id="email" name="email" class="form-control" placeholder="{{ Auth::user()->email; }}"/>
			</div>

			<input type="submit" class="btn btn-primary btn-block m-3 w-25 " value="Save changes">
		</form>

		<a class="btn btn-danger btn-block w-25" href="{{ route('user.delete') }}">Delete account</a>
		
	</div>
</div>

@endsection