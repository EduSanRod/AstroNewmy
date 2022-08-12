@extends('template')

@section('head')

<title>AstroNewmy Home</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/about/index.css') }}">

@endsection


@section('section')

<section id="content">
	<article id="information">
		<div>
			<p>The main goal of this Astronewmy is to help people to get into the hobby of astronomy, 
			and let them share their journey with other people.</p>

			<p>For new little astronomers there are recommendations for beginner equipments and a handfull of useful 
			apps that are chosen due to be as light on the pocket as possible. </p>

			<p>And veterans of the astronomy would be able to share their photographs with other people with the possibility 
			of sharing the equipment used for that particular photo aswell.</p>
		</div>
		
		<div>
			<h2>About me</h2>
			<p>Heya! My name is Eduardo, a junior developer from Spain with a passion for web development and, of course, astronomy.</p>

			<p>Being this my first web development project I would like to hear from you if there is some 
			functionality that you feel it's missing, or some ideas that you would like to be introduce.</p>
			
			<p>For this you could use either the Contact us form, or the email <a href="mailto:AstroNewmy@gmail.com">AstroNewmy@gmail.com</a>. </p>
			
			<p>Thank you in advance!</p>
		</div>
		
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