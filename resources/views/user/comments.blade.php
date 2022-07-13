@extends('template')

@section('head')

<title>{{ Auth::user()->name; }} Articles</title>

<link rel="stylesheet" type="text/css" href="{{ asset('css/user/articles.css') }}">

@endsection

@section('section')

<nav>
	<ul>
		<li>
			<a href="{{ route('user.articles') }}" class="{{ Request::routeIs('user.articles') ? 'active-page' : '' }}" title="My Articles"><span>Articles</span></a>
		</li>
		<li>
			<a href="{{ route('user.comments') }}" class="{{ Request::routeIs('user.comments') ? 'active-page' : '' }}" title="My Comments"><span>Comments</span></a>
		</li>
		<li>
			<a href="#" class="{{ Request::routeIs('user.saved-articles') ? 'active-page' : '' }}" title="Saved Articles"><span>Saved Articles</span></a>
		</li>
	</ul>

</nav>

<section id="articles-container">
	@foreach($articles as $article)
	<article>
		<a href="{{ route('article.show', ['article'=>$article->article_id]) }}" target="_blank">
			<div>
				<h2>{{ $article->article_title }}</h2>
			</div>
			<div>
				<img src="/{{ $article->article_image }}" alt="{{ $article->article_description }}">
			</div>
		</a>
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
	</article>

	<hr>
	@endforeach
</section>

@endsection