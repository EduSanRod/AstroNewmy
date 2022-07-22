@extends('template')

@section('head')

<title>AstroNewmy | Articles</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/article/index.css') }}">

@endsection

@section('section')

<section id="content">
	@if (!Auth::guest())
	<div id="button-add-article">
		<a href="{{ route('article.create') }}">
			<img src="/imagenes/iconos/add_box.svg" alt="Add new Article" height="35px" width="35px">
		</a>
	</div>
	@endif

	@foreach($articles as $key=>$article)
	<article class="article-container">
		<div class="post-continer">
			<a href="{{ route('article.show', ['article'=>$article->article_id]) }}" target="_blank">
				<p>{{ $article->article_title }}</p>
				<img src="/imagenes/article/standarized/{{ $article->article_image }}" alt="{{ $article->article_description }}" loading="{{ $key <= 3 ? "eager" : "lazy" }}">
			</a>
		</div>
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
				<a href="{{ route('article.show', ['article'=>$article->article_id]) }}#comments-container" target="_blank">
					<img src="/imagenes/iconos/comment.svg" alt="Comment" height="25px" width="25px">
					<span class="border-right vote">{{ $article->number_comments }}</span>
				</a>
			</button>
			@if ($article->check_favourite)
			<button type="button" class="button-favourite" data-id="{{ $article->article_id }}">
				<img src="/imagenes/iconos/favourite-active.svg" alt="Add as favourite" height="25px" width="25px">
			</button>
			@else
			<button type="button" class="button-unfavourite" data-id="{{ $article->article_id }}">
				<img src="/imagenes/iconos/favourite-unactive.svg" alt="Add as favourite" height="25px" width="25px">
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
	</article>
	@endforeach
</section>

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

	function hideModal() {
		modal.style.display = "none";
	}

	function showModal() {
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

	$(document).on("click", ".button-unfavourite", function(e) {

		e.preventDefault();

		var $this = $(this);
		var articleId = $(this).data('id');
		var url = "{{ route('article.saved-article') }}";

		$.ajax({
			url: url,
			method: 'POST',
			data: {
				articleId: articleId
			},
			success: function(response) {
				if (response.success) {
					//Change the src image from the button
					$this.removeClass("button-unfavourite");
					$this.addClass("button-favourite");

					$this.find("img").attr("src", "/imagenes/iconos/favourite-active.svg")
				} else {
					alert("Error")
				}
			},
			error: function(error) {
				console.log(error)
			}
		});
	});

	$(document).on("click", ".button-favourite", function(e) {

		e.preventDefault();

		var $this = $(this);
		var articleId = $(this).data('id');
		var url = "{{ route('article.delete-saved-article') }}";

		$.ajax({
			url: url,
			method: 'DELETE',
			data: {
				articleId: articleId
			},
			success: function(response) {
				if (response.success) {
					//Change the src image from the button
					$this.removeClass("button-favourite");
					$this.addClass("button-unfavourite");

					$this.find("img").attr("src", "/imagenes/iconos/favourite-unactive.svg")
				} else {
					alert("Error")
				}
			},
			error: function(error) {
				console.log(error)
			}
		});
	});
</script>

@endsection