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
				<span class="border-right vote">123</span>
			</button>

			<button type="button" onclick="showModal()">
				<img src="/imagenes/iconos/favourite.svg" alt="Add as favourite" height="25px" width="25px">
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

@endsection