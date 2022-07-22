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

		<img src="/imagenes/article/original/{{ $article->article_image }}" alt="{{ $article->article_description }}">

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
				<a href="#comments-container" title="Comments">
					<img src="/imagenes/iconos/comment.svg" alt="Comment" height="25px" width="25px">
					<span class="border-right vote">{{ $article->number_comments }}</span>
				</a>
			</button>
			@if ($article->check_favourite)
				<button type="button" class="button-favourite" data-id="{{ $article->article_id }}">
					<!-- <a href="{{ route('article.delete-saved-article', ['articleId'=>$article->article_id]) }}" title="Delete from Favourites Articles"> --><img src="/imagenes/iconos/favourite-active.svg" alt="Add as favourite" height="25px" width="25px">
				</button>
			@else
				<button type="button" class="button-unfavourite" data-id="{{ $article->article_id }}">
					<!-- <a href="{{ route('article.saved-article', ['articleId'=>$article->article_id]) }}" title="Saved as Favourites Articles"> --><img src="/imagenes/iconos/favourite-unactive.svg" alt="Add as favourite" height="25px" width="25px">
				</button>
			@endif

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
			<button type="button" onclick="showModal()">
				<img src="/imagenes/iconos/thumb_up.svg" alt="Upvote" height="25px" width="25px">
				<span class="border-right vote">123</span>
			</button>

			<button type="button" onclick="showModal()">
				<img src="/imagenes/iconos/thumb_down.svg" alt="Downvote" height="25px" width="25px">
				<span class="border-right vote">123</span>
			</button>

			<button type="button" onclick="showModal()">
				<img src="/imagenes/iconos/comment.svg" alt="Comment" height="25px" width="25px">
				<span class="border-right vote">{{ $article->number_comments }}</span>
			</button>

			<button type="button" onclick="showModal()">
				<img src="/imagenes/iconos/favourite-unactive.svg" alt="Add as favourite" height="25px" width="25px">
			</button>
		</div>
		@endif

		@if(isset($equipments))
		<article class="equipment" id="equipment">
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

	<article class="comments-container" id="comments-container">
		@if(!$comments->isEmpty())
		@foreach($comments as $comment)
		<article class="comment">
			<h3 class="comment-author">{{ $comment->comment_author }} </h3>
			<p class="comment-timestamp">{{ $comment->comment_created_at }}</p>
			<p class="comment-text">{{ $comment->comment_comment_text }}</p>
			<div class="button-container">
				<button type="button">
					<span class="material-symbols-outlined">thumb_up</span>
					<span class="border-right vote">123</span>
				</button>

				<button type="button">
					<span class="material-symbols-outlined">thumb_down</span>
					<span class="border-right vote">123</span>
				</button>
			</div>
		</article>
		@endforeach
		@else
		<p class="empty-comment">This seem kinda empty. Be the first to leave a comment!</p>
		@endif
	</article>
</article>

<div id="login-modal" class="modal">
	
	<div class="modal-content">
		<span onclick="hideModal()" class="close" title="Close Modal">×</span>
		<p>To rate a post or save it to favourites you will need to Login first.</p>
		<div>
			<a href="{{ route('login.index') }}" title="Log in">
				Login in
			</a>

			<p>New to the site? <a href="{{ route('login.create-form') }}" title="Register">Register</a></p>
		</div>
	</div>
</div>

<script>
	// Get the modal
	var modal = document.getElementById('login-modal');

	function hideModal(){
		modal.style.display = "none";
	}

	function showModal(){
		modal.style.display = "flex";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>

<script>
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$(document).on("click", ".button-unfavourite" , function(e) {

		e.preventDefault();
		
		var $this = $(this);
		var articleId = $(this).data('id');
		var url = "{{ route('article.saved-article') }}";

		$.ajax({
			url:url,
			method:'POST',
			data:{
				articleId: articleId
			},
			success:function(response){
				if(response.success){
					//Change the src image from the button
					$this.removeClass("button-unfavourite");
					$this.addClass("button-favourite");

					$this.find("img").attr("src", "/imagenes/iconos/favourite-active.svg")
				}else{
					alert("Error")
				}
			},
			error:function(error){
				console.log(error)
			}
		});
	});

	$(document).on("click", ".button-favourite" , function(e) {

		e.preventDefault();

		var $this = $(this);
		var articleId = $(this).data('id');
		var url = "{{ route('article.delete-saved-article') }}";

		$.ajax({
			url:url,
			method:'DELETE',
			data:{
				articleId: articleId
			},
			success:function(response){
				if(response.success){
					//Change the src image from the button
					$this.removeClass("button-favourite");
					$this.addClass("button-unfavourite");

					$this.find("img").attr("src", "/imagenes/iconos/favourite-unactive.svg")
				}else{
					alert("Error")
				}
			},
			error:function(error){
				console.log(error)
			}
		});
	});

</script>



@endsection