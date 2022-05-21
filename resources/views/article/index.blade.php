@extends('template')

@section('head')

<title>AstroNewmy Home</title>

<link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<style>

	a, a:hover{
		text-decoration: none;
		color: black;
	}

	article{
		width: 60%;
	}

	img{
		width: 100%;
	}

	.material-symbols-outlined {
		font-variation-settings:
		'FILL' 1,
		'wght' 700,
		'GRAD' 0,
		'opsz' 48
	}

	.vote{
		font-size:large;
	}

	#button-add-article{
		position: fixed;
		top: 3%;
		right: 5%;
	}


</style>
@endsection

@section('section')

<section id="content" class="d-flex justify-content-center flex-nowrap flex-column align-items-center">
	@if (!Auth::guest())
		<div id="button-add-article">
			<a href="{{ route('article.create') }}" class="btn btn-dark d-flex justify-content-center align-items-center">
				<span class="material-symbols-outlined">add</span>
			</a>
		</div>
	@endif

	@foreach($articles as $article)
		<article class="border-bottom py-5">
			<a href="{{ route('article.show', ['article'=>$article->article_id]) }}" target="_blank">
				<div class="post-title py-2">
					<h2><strong>{{ $article->article_title }}</strong></h2>
				</div>
				<div class="post-content">
					<img src="{{ $article->article_image }}" alt="{{ $article->article_description }}">
				</div>
			</a>
			<div class="d-flex justify-content-around post-buttons py-3">
				<button type="button" class="btn btn-success px-5">
					<span class="material-symbols-outlined">thumb_up</span>
					<span class="border-right vote"><strong>123</strong></span>
				</button>
				
				<button type="button" class="btn btn-dark px-5">
					<span class="material-symbols-outlined">comment</span>
					<span class="border-right vote"><strong>123</strong></span>
				</button>

				<button type="button" class="btn btn-danger px-5">
					<span class="material-symbols-outlined">thumb_down</span>
					<span class="border-right vote"><strong>123</strong></span>
				</button>
			</div>
		</article>
	@endforeach
</section>

@endsection