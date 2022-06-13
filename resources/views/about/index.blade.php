@extends('template')

@section('head')

<title>AstroNewmy Home</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/about/index.css') }}">

@endsection


@section('section')

<section id="content">
	<article id="information">
		<h2>Title Example</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dictum, risus sit amet aliquam ultrices, neque arcu feugiat urna, sed sollicitudin urna nunc ac tellus. Cras blandit justo sed eleifend mattis. Quisque ac convallis ipsum. Praesent accumsan euismod mi quis vulputate.
			</p>

			<h3>Subtitle Example</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dictum, risus sit amet aliquam ultrices, neque arcu feugiat urna, sed sollicitudin urna nunc ac tellus. Cras blandit justo sed eleifend mattis. Quisque ac convallis ipsum. Praesent accumsan euismod mi quis vulputate.
				</p>
	</article>

	<article id="contact-us-form">
		<h2>Contact Us!</h2>
		<form action="/send_mail" method="post" class="form">
			@csrf
			@method('GET')

			<label for="first-name">First Name</label>
			<input type="text" id="first-name" name="first-name" class="form-input" >

			<label for="last-name">Last Name</label>
			<input type="text" id="last-name" name="last-name" class="form-input" >

			@if (Auth::guest())

			<label for="last-name">Email</label>
			<input type="email" id="email" name="email" class="form-input">

			@else

			<label for="last-name">Email</label>
			<input type="email" id="email" name="email" class="form-input" placeholder="Email" value="{{ Auth::user()->email; }}">

			@endif

			<label for="subject">Subject</label>
			<input type="text" id="subject" name="subject" class="form-input" >

			<label for="comment">Comment</label><br>
			<textarea id="comment" name="comment" rows="7"></textarea>

			<button type="submit" class="submit-button">Send Message</button>

		</form>
	</article>
</section>


@endsection