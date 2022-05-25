@extends('template')

@section('head')

<title>{{ Auth::user()->name; }} Articles</title>

<link rel="stylesheet" type="text/css" href="{{ asset('css/user/articles.css') }}" >

@endsection

@section('section')

<nav class="navbar navbar-expand-lg navbar-light ">
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav w-100 mx-auto">
			<li class="nav-item active w-50 bg-dark bg-gradient ">
				<a class="nav-link w-full d-flex justify-content-center" href="{{ route('user.articles') }}"><span class="h4 text-white">Articles</span></a>
			</li>
			<li class="nav-item w-50 bg-light bg-gradient">
				<a class="nav-link w-full d-flex justify-content-center" href="{{ route('user.comments') }}"><span class="h4">Comments</span></a>
			</li>
		</ul>
	</div>
</nav>

<section id="articles-container" class="d-flex justify-content-center flex-nowrap flex-column align-items-center">
	@foreach($articles as $article)
	<article class="border-bottom py-5">
		<a href="{{ route('article.show', ['article'=>$article->article_id]) }}" target="_blank">
			<div class="post-title py-2">
				<h2><strong>{{ $article->article_title }}</strong></h2>
			</div>
			<div class="post-content">
				<img src="/{{ $article->article_image }}" alt="{{ $article->article_description }}">
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