@extends('template')

@section('head')

<title>AstroNewmy Home</title>

<link rel="stylesheet" type="text/css" href="{{ asset('css/home/index.css') }}">

@endsection

@section('section')

<section class="astronewmy-container">
	<article>
		<div>
			<img src="/imagenes/home/pillars_of_creation.jpg" alt="Image of the pillars of creation" title="Image of the pillars of creation">
		</div>

		<div>
			<h2>AstroNewmy</h2>

			<h3>Astronomy for beginners</h3>

			<p>This website if for people that want to start with the hobby of astronomy/astrophotography and want to share with other people their journey. </p>
		</div>
	</article>

</section>

<hr>

<section class="articles-container">

	<h2>Check out the Astronomy Posts!</h2>

	<div>
		@foreach($articles as $article)
		<article class="post-container">
			<a class="post-title" href="{{ route('article.show', ['article'=>$article->article_id]) }}" target="_blank" title="{{ $article->article_description }}">
				<h3><strong>{{ $article->article_title }}</strong></h3>
			</a>

			<a class="post-image" href="{{ route('article.show', ['article'=>$article->article_id]) }}" target="_blank" title="{{ $article->article_description }}">
				<img src="/imagenes/article/standarized/{{ $article->article_image }}" alt="{{ $article->article_description }}">
			</a>
		</article>
		@endforeach
	</div>
</section>

<hr>

<section class="wheretostart-container">
	<div>
		<img src="/imagenes/home/where_to_start.png" alt="Image of where to start" title="Image of where to start">
	</div>
	<div>
		<h2>Want to know where to start with astronomy?</h2>

		<p>If you are just starting out with astronomy, head out to the Where to start section, there you will find advise on buying telescopes, binoculars, smartphone apps, other sources of information about astronomy, etc.</p>

		<a class="button-where-to-start" href="{{ route('wheretostart.index') }}" title="Where to start">Where to start</a>
	</div>
</section>


@endsection