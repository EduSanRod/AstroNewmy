@extends('template')

@section('head')
<title>AstroNewmy - Article</title>

<link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/article/show.css') }}" >

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

		<div class="post-buttons d-flex justify-content-around">
			<button type="button" class="btn btn-success d-flex flex-column m-4 px-4">
				<span class="material-symbols-outlined">thumb_up</span>
				<span class="border-right vote"><strong>123</strong></span>
			</button>

			<button type="button" class="btn btn-dark d-flex flex-column m-4 px-4">
				<span class="material-symbols-outlined">comment</span>
				<span class="border-right vote"><strong>123</strong></span>
			</button>

			<button type="button" class="btn btn-danger d-flex flex-column m-4 px-4">
				<span class="material-symbols-outlined">thumb_down</span>
				<span class="border-right vote"><strong>123</strong></span>
			</button>
		</div>

		@if(isset($equipments))
			<article id="equipment-container" class="">
			<p class="h3"><strong>Equipment</strong></p>
				@foreach( $equipments as $equipment )
					<div>
						<a class="equipment-link link-info" href="{{ $equipment->equipment_link }}" target="_blank"><p class="h4"><strong>{{ $equipment->equipment_name }} - {{ $equipment->equipment_price }}€</strong></p></a>
					</div>
				@endforeach
			</article>
		@endif
		
		@if (!Auth::guest())
			<div class="add-comment-container d-flex mt-4">
				<form id="form-add-comment" action="{{ route('article.create-comment') }}">
					<div class="form-group">
						<textarea class="form-control" name="comment_text" id="comment_text" rows="4" placeholder="Write a comment..."></textarea>
					</div>

					<input type="hidden" name="user_id" value="{{ Auth::user()->id; }}">
					<input type="hidden" name="article_id" value="{{ $article->article_id }}">

					<div class="col-auto ml-auto d-flex justify-content-end">
						<button type="submit" class="btn btn-primary mb-2" maxlength="255">Comment</button>
					</div>
				</form>
			</div>
		@endif
	
		<hr>

		<article class="comments-container">
			@if(!$comments->isEmpty())
				@foreach($comments as $comment)
					<article class="comment border rounded mb-3 px-4">
						<h3 class="inline-block ">{{ $comment->comment_author }} </h3>
						<h5 class="inline-block text-muted ">{{ $comment->comment_created_at }}</h5>
						<h3 class="text-dark "><small class="text-dark">{{ $comment->comment_comment_text }}</small></h3>
						<button type="button" class="btn btn-outline-success btn-sm">
							<span class="material-symbols-outlined">thumb_up</span>
							<span class="border-right vote">{{ $comment->comment_likes }}</span>
						</button>
						<button type="button" class="btn btn-outline-danger btn-sm">
							<span class="material-symbols-outlined">thumb_down</span>
							<span class="border-right vote">{{ $comment->comment_dislikes }}</span>
						</button>
					</article>
				@endforeach
			@else
				<p>This seem kinda empty. Be the first to leave a comment!</p>
			@endif
		</article>
	</section>
</div>


@endsection