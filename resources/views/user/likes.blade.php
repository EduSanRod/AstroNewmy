@extends('template')

@section('head')

<title>{{ Auth::user()->name; }}'s Liked Articles</title>

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
			<a href="{{ route('user.favourites') }}" class="{{ Request::routeIs('user.favourites') ? 'active-page' : '' }}" title="Saved Articles"><span>Favourite</span></a>
		</li>
		<li>
			<a href="{{ route('user.likes') }}" class="{{ Request::routeIs('user.likes') ? 'active-page' : '' }}" title="Liked Articles"><span>Likes</span></a>
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
			@if ($article->vote === '1')
			<button type="button" class="button-remove-upvote" data-id="{{ $article->article_id }}">
				<img src="/imagenes/iconos/thumb_up-active.svg" alt="Upvote" height="25px" width="25px">
				<span class="border-right vote">{{ $article->upvotes_count }}</span>
			</button>
			@else
			<button type="button" class="button-upvote" data-id="{{ $article->article_id }}">
				<img src="/imagenes/iconos/thumb_up-unactive.svg" alt="Upvote" height="25px" width="25px">
				<span class="border-right vote">{{ $article->upvotes_count }}</span>
			</button>
			@endif

			@if ($article->vote === '-1')
			<button type="button" class="button-remove-downvote" data-id="{{ $article->article_id }}">
				<img src="/imagenes/iconos/thumb_down-active.svg" alt="Downvote" height="25px" width="25px">
				<span class="border-right vote">{{ $article->downvotes_count }}</span>
			</button>
			@else
			<button type="button" class="button-downvote" data-id="{{ $article->article_id }}">
				<img src="/imagenes/iconos/thumb_down-unactive.svg" alt="Downvote" height="25px" width="25px">
				<span class="border-right vote">{{ $article->downvotes_count }}</span>
			</button>
			@endif

			<button type="button">
				<img src="/imagenes/iconos/comment.svg" alt="Comment" height="25px" width="25px">
				<span class="border-right vote">{{ $article->number_comments }}</span>
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
				<img src="/imagenes/iconos/thumb_up-unactive.svg" alt="Upvote" height="25px" width="25px">
				<span class="border-right vote">{{ $article->upvotes_count }}</span>
			</button>

			<button type="button" onclick="showModal()">
				<img src="/imagenes/iconos/thumb_down-unactive.svg" alt="Downvote" height="25px" width="25px">
				<span class="border-right vote">{{ $article->downvotes_count }}</span>
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

	<hr>
	@endforeach
</section>

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

	$(document).on("click", ".button-upvote", function(e) {

		e.preventDefault();

		var $this = $(this);
		var articleId = $(this).data('id');
		var url = "{{ route('article.like-article') }}";

		$.ajax({
			url: url,
			method: 'POST',
			data: {
				articleId: articleId
			},
			success: function(response) {
				if (response.success) {
					//Change the src image from the button

					$this.removeClass("button-upvote");
					$this.addClass("button-remove-upvote");

					$this.find("img").attr("src", "/imagenes/iconos/thumb_up-active.svg");

					//Add 1 to the upvote count
					let numberUpvotes = $this.find("span").text();
					numberUpvotes = parseInt(numberUpvotes) + 1;
					$this.find("span").text(numberUpvotes);

					//If there is a downvote change it
					if (response.message == 1) {
						var changedownvote = $(".button-remove-downvote")
						changedownvote.find("img").attr("src", "/imagenes/iconos/thumb_down-unactive.svg");

						//Remove 1 to the upvote count
						let numberUpvotes = changedownvote.find("span").text();
						numberUpvotes = parseInt(numberUpvotes) - 1;
						changedownvote.find("span").text(parseInt(numberUpvotes));

						changedownvote.addClass("button-downvote");
						changedownvote.removeClass("button-remove-downvote");
					}

				} else {
					alert("Error");
				}
			},
			error: function(error) {
				console.log(error)
			}
		});
	});

	$(document).on("click", ".button-downvote", function(e) {

		e.preventDefault();

		var $this = $(this);
		var articleId = $(this).data('id');
		var url = "{{ route('article.dislike-article') }}";

		$.ajax({
			url: url,
			method: 'POST',
			data: {
				articleId: articleId
			},
			success: function(response) {
				if (response.success) {
					//Change the src image from the button

					$this.removeClass("button-downvote");
					$this.addClass("button-remove-downvote");

					$this.find("img").attr("src", "/imagenes/iconos/thumb_down-active.svg");

					//Add 1 to the downvote count
					let numberDownvote = $this.find("span").text();
					numberDownvote = parseInt(numberDownvote) + 1;
					$this.find("span").text(numberDownvote);

					//If there is a downvote change it
					if (response.message == 1) {
						var changedownvote = $(".button-remove-upvote")
						changedownvote.find("img").attr("src", "/imagenes/iconos/thumb_up-unactive.svg");

						//Remove 1 to the upvote count
						let numberUpvotes = changedownvote.find("span").text();
						numberUpvotes = parseInt(numberUpvotes) - 1;
						changedownvote.find("span").text(numberUpvotes);

						changedownvote.addClass("button-upvote");
						changedownvote.removeClass("button-remove-upvote");

					}
				} else {
					alert("Error");
				}
			},
			error: function(error) {
				console.log(error)
			}
		});
	});

	$(document).on("click", ".button-remove-upvote", function(e) {

		e.preventDefault();

		var $this = $(this);
		var articleId = $(this).data('id');
		var url = "{{ route('article.remove-vote-article') }}";

		$.ajax({
			url: url,
			method: 'DELETE',
			data: {
				articleId: articleId
			},
			success: function(response) {
				if (response.success) {
					//Change the src image from the button

					$this.removeClass("button-remove-upvote");
					$this.addClass("button-upvote");

					$this.find("img").attr("src", "/imagenes/iconos/thumb_up-unactive.svg");

					//Remove 1 to the upvote count
					let numberUpvotes = $this.find("span").text();
					numberUpvotes = parseInt(numberUpvotes) - 1;
					$this.find("span").text(numberUpvotes);
				} else {
					alert("Error");
				}
			},
			error: function(error) {
				console.log(error)
			}
		});
	});

	$(document).on("click", ".button-remove-downvote", function(e) {

		e.preventDefault();

		var $this = $(this);
		var articleId = $(this).data('id');
		var url = "{{ route('article.remove-vote-article') }}";

		$.ajax({
			url: url,
			method: 'DELETE',
			data: {
				articleId: articleId
			},
			success: function(response) {
				if (response.success) {
					//Change the src image from the button

					$this.removeClass("button-remove-downvote");
					$this.addClass("button-downvote");

					$this.find("img").attr("src", "/imagenes/iconos/thumb_down-unactive.svg");

					//Remove 1 to the downvote count
					let numberDownvote = $this.find("span").text();
					numberDownvote = parseInt(numberDownvote) - 1;
					$this.find("span").text(numberDownvote);
				} else {
					alert("Error");
				}
			},
			error: function(error) {
				console.log(error)
			}
		});
	});
</script>

@endsection