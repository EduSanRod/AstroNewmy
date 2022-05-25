@extends('template')

@section('head')

<title>AstroNewmy Home</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/about/index.css') }}" >

@endsection


@section('section')

<section id="content">
	<article id="information">
		<h2 class="jumbotron-heading text-center">Title Example</h1>
		<p class="lead">
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dictum, risus sit amet aliquam ultrices, neque arcu feugiat urna, sed sollicitudin urna nunc ac tellus. Cras blandit justo sed eleifend mattis. Quisque ac convallis ipsum. Praesent accumsan euismod mi quis vulputate. 
		</p>

		<h3 class="jumbotron-heading text-center">Subtitle Example</h1>
		<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dictum, risus sit amet aliquam ultrices, neque arcu feugiat urna, sed sollicitudin urna nunc ac tellus. Cras blandit justo sed eleifend mattis. Quisque ac convallis ipsum. Praesent accumsan euismod mi quis vulputate. 
		</p>
	</article>

	<article id="contact-us-form">
		<h2 class="jumbotron-heading text-center">Contact Us!</h1>
		<form action="/send_mail" method="post">
			@csrf
			@method('GET')
			<div class="form-group">
				<label for="first-name">First Name</label>
				<input type="text" class="form-control" id="first-name" name="first-name" placeholder="First Name">
			</div>

			<div class="form-group">
				<label for="last-name">Last Name</label>
				<input type="text" class="form-control" id="last-name" name="last-name" placeholder="Last Name">
			</div>
			@if (Auth::guest())
			<div class="form-group">
				<label for="last-name">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email">
			</div>
			@else
			<div class="form-group">
				<label for="last-name">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ Auth::user()->email; }}">
			</div>
			@endif
			

			<div class="form-group">
				<label for="subject">Subject</label>
				<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
			</div>

			<div class="form-group">
				<label for="comment">Comment</label><br>
				<textarea id="comment" name="comment" rows="10" style="width: 100%;"></textarea>
			</div>

			<div class="col-auto">
				<button type="submit" class="btn btn-primary mb-2" style="width: 100%;">Send Message</button>
			</div>

		</form>
	</article>
</section>


@endsection