@extends('template')

@section('head')

<title>AstroNewmy Home</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/wheretostart/index.css') }}">

@endsection

@section('section')

<section class="content">

	<article id="equipment">
		<button class="collapsible">
			<h2>Recommended Equipment</h2>
		</button>
		<section class="content-equipment">
			<h3>Astronomy With The Naked Eye</h3>
			<p>
				Although the first thing that comes to mind while thinking of astronomy is a telescope, it might be not be the best choice while starting this hobby.
				Using the naked eye might not get you the same satisfaction as seeing Saturn for the first time with your telescope,
				but being able to identify planets, stars and constellations with the naked eye could is greatly rewarding too, and it's really helpful to have this knowledge while using a telescope, so it's a win-win situation.
			</p>
			<h4 class="subtitle">What would I be able to see with the naked eye in the night sky?</h4>
			<p>
				Well, the complete list of <span class="bold">Sun</span> and <span class="bold">Moon</span>, the five planets: <span class="bold">Mercury</span>, <span class="bold">Venus</span>, <span class="bold">Mars</span>, <span class="bold">Jupiter</span> and <span class="bold">Saturn</span>, and the <span class="bold">stars</span> and the <span class="bold">constellations</span> they form.
			</p>
			<p>
				<span class="bold">The easiest way to locate</span> or recognize the planets and constellations is to use some <span class="bold">smartphone app</span> that helps you with that. You will be able to find some in the "Useful Tools" section!
			</p>
			<p>
				If you don't have you smartphone with you or want to try to locate them by yourself these are some <span class="bold">tips to help you know what to look for</span>:
			</p>
			<ul>
				<li>
					<p>
						<span class="bold">· Venus:</span> Being the second most brightest object that you will find in the night sky right after the moon, and will likely appear after sunset or before sunrise. So, if you see something really bright just after sunset or before sunrise, it will most likely be Venus.
					</p>
				</li>

				<li>
					<p>
						<span class="bold">· Jupiter:</span> Jupiter is the third most brightest object in the night sky. So, if you see a celestial object that really stands out in the middle of the night, it will probably be Jupiter.
					</p>
				</li>

				<li>
					<p>
						<span class="bold">· Saturn:</span> Saturn is a little bit more tricky than the previous two due to not being so bright, but it is recognizable by it's yellowish color.
					</p>
				</li>

				<li>
					<p>
						<span class="bold">· Mars:</span> Just like Saturn, Mars is not so bright as Venus or Jupiter, but it is easily recognizable by it's red color.
					</p>
				</li>

				<li>
					<p>
						<span class="bold">· Mercury:</span> Now this is a challenge, Mercury is too dim and it's too close to the Sun that it rarely can be seen with the naked eye, being reserve for specific dates where Mercury has it's gratest separation from the Sun.
					</p>
				</li>

				<li>
					<p>
						<span class="bold">· Stars & Constellations:</span> Just like recognizing planets, the easiest way is to use a smartphone app to locate them. Either way there are a lot of books or webs that help you to learn the constellations and be able to locate them in the sky. Here is one of them: <a href="https://www.constellation-guide.com/constellation-list/" target="_blank" title="Constellation guide">Constellation guide</a>.

					</p>
				</li>
			</ul>

			<hr>

			<h3>Binoculars</h3>

			Binoculars are a not only good tools to use while srtating, but are also useful for spotting objects in the sky to then focus the telescope on.

			There are two main specs that binoculars have, their magnification and the objective lens diameter expressed in milimeters. For example a binocular with the specs 7x50 means that it has a magnification power of 7 and the diameter of the lens is 50mm.

			<h4 class="subtitle">Recommended magnification</h4>

			<hr>

			<h3>Telescopes</h3>

		</section>

	</article>

	<article id="aplications">
		<button class="collapsible">
			<h2>Useful Tools</h2>
		</button>
		<section class="content-aplications">
			<section class="aplication">
				<div>
					<h3>Stellarium</h3>
					<p><strong>Category:</strong> Planetarium.</p>
					<p><strong>Cost:</strong> Free with paid Pro Version.</p>
					<p class="description">Stellarium Mobile - Star Map is a planetarium app that shows exactly what you see when you look up at the stars.<br><br>
						Identify stars, constellations, planets, comets, satellites (such as the ISS), and other deep sky objects in real time in the sky above you in just a few seconds, just by pointing the phone at the sky!<br><br>

						This astronomy application has an easy to use and minimalist user interface, that makes it one of the best astronomical applications for adults and children who want to explore the night sky.
					</p>
					<a href="https://play.google.com/store/apps/details?id=com.noctuasoftware.stellarium_free&hl=en&gl=US" target="_blank">
						<button class="buttonLink">Stellarium</button>
					</a>
				</div>

				<div>
					<img src="/imagenes/whereToStart/aplications/stellarium.webp" alt="Image of the stellarium app">
				</div>

			</section>

			<section class="aplication">
				<div>
					<h3>Sky Map</h3>
					<p><strong>Category:</strong> Planetarium.</p>
					<p><strong>Cost:</strong> Free.</p>
					<p class="description">Sky Map is a hand-held planetarium for your Android device. Use it to identify stars, planets, nebulae and more. <br>
						Originally developed as Google Sky Map, it has now been donated and open sourced.
					</p>
					<a href="https://play.google.com/store/apps/details?id=com.google.android.stardroid&hl=en&gl=US" target="_blank">
						<button class="buttonLink">Sky Map</button>
					</a>
				</div>

				<div>
					<img src="/imagenes/whereToStart/aplications/stellarium.webp" alt="Image of the stellarium app">
				</div>

			</section>

			<section class="aplication">
				<div>
					<h3>Timeanddate.com</h3>
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
					<a href="https://www.timeanddate.com/astronomy/night/" target="_blank">
						<button class="buttonLink">Timeanddate</button>
					</a>
				</div>

				<div>
					<img src="/imagenes/whereToStart/aplications/stellarium.webp" alt="Image of the stellarium app">
				</div>
			</section>

			<section class="aplication">
				<div>
					<h3>Clearoutside.com</h3>
					<p><strong>Category:</strong> Weather Forecast.</p>
					<p><strong>Cost:</strong> Free.</p>
					<p class="description">Reliable weather forecasts for astronomers with an emphasis on cloud cover.<br><br>
						Updated hourly. Frequent hourly updates are important because often the clear spell between showers provides excellent seeing and 30-minutes under a clear sky with a grab-&-go telescopes is pure gold!<br><br>
						Also includes regular weather data (wind, rain, frost, temperature, dew point, etc) so perfect for those wanting a detailed weather forecast, without cutesy graphics.
					</p>

					<a href="http://clearoutside.com/forecast/50.7/-3.52" target="_blank">
						<button class="buttonLink">Clearoutside</button>
					</a>
				</div>

				<div>
					<img src="/imagenes/whereToStart/aplications/stellarium.webp" alt="Image of the stellarium app">
				</div>

			</section>

			<section class="aplication">
				<div>
					<h3>Astro Panel</h3>
					<p><strong>Category:</strong> Weather Forecast.</p>
					<p><strong>Cost:</strong> Free.</p>
					<p class="description">This lightweight astronomy app detects your location and uses it to instantly give you a forecast that is highly localized and works worldwide.
					</p>

					<a href="https://play.google.com/store/apps/details?id=Lewis.sevenTimer2&hl=en&gl=US" target="_blank">
						<button class="buttonLink">Astro Panel</button>
					</a>
				</div>

				<div>
					<img src="/imagenes/whereToStart/aplications/stellarium.webp" alt="Image of the stellarium app">
				</div>

			</section>

			<section class="aplication">
				<div>
					<h3>DarkLight</h3>
					<p><strong>Category:</strong> Observing Assistant Apps.</p>
					<p><strong>Cost:</strong> Free.</p>
					<p class="description">DarkLight app allows you to use your phone as a source of light in the dark without your eyes having to adjust for light.<br><br>
						This simple, quick and easy app allows you to analyze the lighting conditions via light sensor, and displays the information on the screen when required.
					</p>
					<a href="https://play.google.com/store/apps/details?id=com.qask.darklight&hl=en&gl=US" target="_blank">
						<button class="buttonLink">DarkLight</button>
					</a>
				</div>

				<div>
					<img src="/imagenes/whereToStart/aplications/stellarium.webp" alt="Image of the stellarium app">
				</div>

			</section>
		</section>
	</article>

	<article id="look-for-groups">
		<button class="collapsible">
			<h2>Join Astronomy Groups!</h2>
		</button>
		<section class="content-look-for-groups">
			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
		</section>
	</article>

	<article id="recommended-info">
		<button class="collapsible">
			<h2>Other Interesting Information</h2>
		</button>
		<section class="content-recommended-info">
			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
		</section>
	</article>

	<section id="contact-us">
		<div class="contact-us-col">
			<img src="/imagenes/whereToStart/new_idea.svg" alt="New idea image">
		</div>

		<div class="contact-us-col">
			<h3>Have we missed something?</h3>

			<p>If you think there is something that should be added to this section, tell us by contacting through the About section.</p>

			<a href="{{ route('about.display') }}">
				<button>Contact Us</button>
			</a>
		</div>
	</section>

</section>


@endsection

<script>
	window.addEventListener("load", function() {
		let coll = document.getElementsByClassName("collapsible");
		let i;

		for (i = 0; i < coll.length; i++) {
			coll[i].addEventListener("click", function() {
				this.classList.toggle("active");
				let content = this.nextElementSibling;
				if (content.style.maxHeight) {
					content.style.maxHeight = null;
				} else {
					content.style.maxHeight = content.scrollHeight + "px";
				}
			});
		}
	});
</script>