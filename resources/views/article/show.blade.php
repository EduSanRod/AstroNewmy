@extends('template')

@section('head')
<title>AstroNewmy - Article</title>

<link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<style>

	section{
		width: 80%;
	}

	img{
		width: 100%;
	}

	.material-symbols-outlined {
		font-variation-settings:
		'FILL' 1,
		'wght' 200,
		'GRAD' 0,
		'opsz' 48
	}

	.vote{
		font-size:large;
	}


</style>
@endsection

@section('section')
<div class="d-flex flex justify-content-center">
	<section id="content">
		<div class="post-title py-2">
			<h2><strong>{{ $article->article_title }}</strong></h2>
		</div>

		<div class="post-content">
			<img src="/{{ $article->article_image }}" alt="{{ $article->article_description }}">
		</div>
		
		<div class="post-buttons d-flex">
			<button type="button" class="btn btn-success d-flex flex-column m-4 px-4">
				<span class="material-symbols-outlined">thumb_up</span>
				<span class="border-right vote"><strong>123</strong></span>
			</button>
			<button type="button" class="btn btn-danger d-flex flex-column m-4 px-4">
				<span class="material-symbols-outlined">thumb_down</span>
				<span class="border-right vote"><strong>123</strong></span>
			</button>
		</div>
		
	</section>
</div>


@endsection