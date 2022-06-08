@extends('template')

@section('head')

<title>AstroNewmy Home</title>

<link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/article/index.css') }}">

@endsection

@section('section')

<section id="content">
	@if (!Auth::guest())
	<div id="button-add-article">
		<a href="{{ route('article.create') }}">
			<span class="material-symbols-outlined">add</span>
		</a>
	</div>
	@endif

	@foreach($articles as $article)
	<article class="article-container">
		<div class="post-continer">
			<a href="{{ route('article.show', ['article'=>$article->article_id]) }}" target="_blank">
				<p>{{ $article->article_title }}</p>
				<img src="{{ $article->article_image }}" alt="{{ $article->article_description }}">
			</a>
		</div>
		<div class="button-continer">
			<button class="button-upvote">
				<span class="material-symbols-outlined">thumb_up</span>
				<span class="border-right vote"><strong>123</strong></span>
			</button>

			<button class="button-comment">
				<span class="material-symbols-outlined">comment</span>
				<span class="border-right vote"><strong>123</strong></span>
			</button>

			<button class="button-downvote">
				<span class="material-symbols-outlined">thumb_down</span>
				<span class="border-right vote"><strong>123</strong></span>
			</button>
		</div>
	</article>
	@endforeach
</section>

@endsection