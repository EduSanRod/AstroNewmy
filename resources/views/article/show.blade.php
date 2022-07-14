@extends('template')

@section('head')
<title>AstroNewmy - Article</title>

<link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/article/show.css') }}">

@endsection

@section('section')

<article class="post">
	<article class="post-content">
		<h2>{{ $article->article_title }}</h2>

		<img src="/{{ $article->article_image }}" alt="{{ $article->article_description }}">

		<div class="post-buttons">
			<button type="button" class="button-upvote">
				<span class="material-symbols-outlined">thumb_up</span>
				<span class="vote">123</span>
			</button>

			<button type="button" class="button-comment">
				<span class="material-symbols-outlined">comment</span>
				<span class="vote">123</span>
			</button>

			<button type="button" class="button-downvote">
				<span class="material-symbols-outlined">thumb_down</span>
				<span class="vote">123</span>
			</button>
		</div>



		@if(isset($equipments))
		<article class="equipment">
			<p class="equipment-title">Equipment</p>
			@foreach( $equipments as $equipment )
			<div class="equipment-container">
				<img class="equipment-icon" src="/imagenes/iconos/equipment/{{ $equipment->equipment_type }}.svg" alt="Icon of a {{ $equipment->equipment_type }}">
				<span class="equipment-name">{{ $equipment->equipment_name }}</span>
			</div>
			@endforeach
		</article>
		@endif
	</article>
	<hr>

	@if (!Auth::guest())
	<article class="add-comment-container">
		<form class="form-add-comment" action="{{ route('article.create-comment', $article->article_id) }}">
			<textarea name="comment_text" id="comment_text" rows="4" placeholder="Write a comment..."></textarea>

			<button type="submit" maxlength="255">Comment</button>
		</form>
	</article>
	@endif

	<article class="comments-container">
		@if(!$comments->isEmpty())
		@foreach($comments as $comment)
		<article class="comment">
			<h3 class="comment-author">{{ $comment->comment_author }} </h3>
			<p class="comment-timestamp">{{ $comment->comment_created_at }}</p>
			<p class="comment-text">{{ $comment->comment_comment_text }}</p>
			<div class="comment-buttons">
				<button type="button" class="button-upvote">
					<span class="material-symbols-outlined">thumb_up</span>
					<span class="vote">123</span>
				</button>

				<button type="button" class="button-downvote">
					<span class="material-symbols-outlined">thumb_down</span>
					<span class="vote">123</span>
				</button>
			</div>
		</article>
		@endforeach
		@else
		<p class="empty-comment">This seem kinda empty. Be the first to leave a comment!</p>
		@endif
	</article>
</article>



@endsection