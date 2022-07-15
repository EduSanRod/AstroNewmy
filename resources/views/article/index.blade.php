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
		@if (Auth::check())
		<div class="button-container">
			<button type="button">
				<span class="material-symbols-outlined">thumb_up</span>
				<span class="border-right vote">123</span>
			</button>

			<button type="button">
				<span class="material-symbols-outlined">thumb_down</span>
				<span class="border-right vote">123</span>
			</button>

			<button type="button">
				<span class="material-symbols-outlined">comment</span>
				<span class="border-right vote">123</span>
			</button>

			<button type="button">
				<span class="material-symbols-outlined">favorite</span>
			</button>

			<div class="dropdown more-options">
				<button class="dropbtn "><span class="material-symbols-outlined">more_horiz</span></button>
				<div class="dropdown-content">
					@if( Auth::user()->id == $article->article_user_id)
					<a href="{{ route('article.edit', ['article'=>$article->article_id]) }}">Update Article</a>
					@endif
					<a href="{{ route('user.setting') }}">Report</a>
				</div>
			</div>
		</div>
		@else
		<div class="button-container">
			<button type="button" class="modal-login">
				<span class="material-symbols-outlined">thumb_up</span>
				<span class="border-right vote">123</span>
			</button>

			<button type="button" class="modal-login">
				<span class="material-symbols-outlined">thumb_down</span>
				<span class="border-right vote">123</span>
			</button>

			<button type="button" class="modal-login">
				<span class="material-symbols-outlined">comment</span>
				<span class="border-right vote">123</span>
			</button>

			<button type="button" class="modal-login">
				<span class="material-symbols-outlined">favorite</span>
			</button>
		</div>
		@endif
	</article>
	@endforeach
</section>

@endsection