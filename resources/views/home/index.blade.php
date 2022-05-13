@extends('template')

@section('head')

<title>AstroNewmy Home</title>

<style>
	.post-container {
		width: 100%;
	}

	.article-container {
		max-width: 33%;
	}

	.article-image {
		max-width: 100%;
		max-height: 100%;
	}

	a,
	a:hover {
		text-decoration: none;
		color: black;
	}

</style>

@endsection

@section('section')

<div class="container">
	<h2 class="d-flex justify-content-center"><strong>{{ $starredCelestialObject }}</strong></h2>
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" style="width:100%;">
			<div class="item active">
				<img src="imagenes/home-carousel/{{ $starredCelestialObject }}/0.jpg" alt="Image of {{ $starredCelestialObject }}" style="width:100%; height:50em;">
			</div>

			<div class="item">
				<img src="imagenes/home-carousel/{{ $starredCelestialObject }}/1.jpg" alt="Image of {{ $starredCelestialObject }}" style="width:100%; height:50em;">
			</div>

			<div class="item">
				<img src="imagenes/home-carousel/{{ $starredCelestialObject }}/2.jpg" alt="Image of {{ $starredCelestialObject }}" style="width:100%; height:50em;">
			</div>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>

<hr>

<div class="post-container">
	<h2 class="d-flex justify-content-center flex"><strong>Last Articles</strong></h2>
	<div class="d-flex flex">
		@foreach($articles as $article)
		<article class="article-container m-3 align-items-center">
			<a href="{{ route('article.show', ['article'=>$article->article_id]) }}" target="_blank">
				<h3 class="article-title d-flex justify-content-center flex "><strong>{{ $article->article_title }}</strong></h3>
				<img class="article-image" src="{{ $article->article_image }}" alt="{{ $article->article_description }}">
			</a>
		</article>
		@endforeach
	</div>
</div>


@endsection