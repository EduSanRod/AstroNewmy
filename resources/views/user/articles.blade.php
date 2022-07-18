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
	@foreach($articles as $key=>$article)
	<article>
		<a href="{{ route('article.show', ['article'=>$article->article_id]) }}" target="_blank">
			<div>
				<h2>{{ $article->article_title }}</h2>
			</div>
			<div>
			<img src="/imagenes/article/original/{{ $article->article_image }}" alt="{{ $article->article_description }}" loading="{{ $key <= 3 ? "eager" : "lazy" }}">
			</div>
		</a>
		@if (Auth::check())
		<div class="button-container">
			<button type="button">
				<img src="/imagenes/iconos/thumb_up.svg" alt="Upvote" height="25px" width="25px">
				<span class="border-right vote">123</span>
			</button>

			<button type="button">
				<img src="/imagenes/iconos/thumb_down.svg" alt="Downvote" height="25px" width="25px">
				<span class="border-right vote">123</span>
			</button>

			<button type="button">
				<img src="/imagenes/iconos/comment.svg" alt="Comment" height="25px" width="25px">
				<span class="border-right vote">123</span>
			</button>

			<button type="button">
				<img src="/imagenes/iconos/favourite.svg" alt="Add as favourite" height="25px" width="25px">
			</button>

			<div class="dropdown more-options">
				<button class="dropbtn "><img src="/imagenes/iconos/more.svg" alt="More options" height="25px" width="25px"></button>
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
		<button type="button">
				<img src="/imagenes/iconos/thumb_up.svg" alt="Upvote" height="25px" width="25px">
				<span class="border-right vote">123</span>
			</button>

			<button type="button">
				<img src="/imagenes/iconos/thumb_down.svg" alt="Downvote" height="25px" width="25px">
				<span class="border-right vote">123</span>
			</button>

			<button type="button">
				<img src="/imagenes/iconos/comment.svg" alt="Comment" height="25px" width="25px">
				<span class="border-right vote">123</span>
			</button>

			<button type="button">
				<img src="/imagenes/iconos/favourite.svg" alt="Add as favourite" height="25px" width="25px">
			</button>
		</div>
		@endif
	</article>

	<hr>
	@endforeach
</section>

@endsection