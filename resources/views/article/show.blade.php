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
					<a href="{{ route('article.report-article', ['articleId'=>$article->article_id]) }}">Report</a>
					@if( Auth::user()->role == 'admin')
					<form action="{{ route('article.destroy', ['article' => $article->article_id]) }}" method="POST">
						@csrf
						@method('DELETE')
						<button type="submit" class="deleteButton">Delete</button>
					</form>
					@endif
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
			@if($comment->comment_comment_text != null)
			<p class="comment-text">{{ $comment->comment_comment_text }}</p>
			@else
			<p class="comment-text"><i>User has deleted the comment.</i></p>
			@endif
			<div class="button-comment-container">
				@if (Auth::check())
				@if ($comment->vote === '1')
				<button type="button" class="button-remove-upvote-comment" data-id="{{ $comment->comment_id }}">
					<img src="/imagenes/iconos/thumb_up-active.svg" alt="Upvote" height="20px" width="20px">
					<span class="border-right vote">{{ $comment->upvotes_count }}</span>
				</button>
				@else
				<button type="button" class="button-upvote-comment" data-id="{{ $comment->comment_id }}">
					<img src="/imagenes/iconos/thumb_up-unactive.svg" alt="Upvote" height="20px" width="20px">
					<span class="border-right vote">{{ $comment->upvotes_count }}</span>
				</button>
				@endif

				@if ($comment->vote === '-1')
				<button type="button" class="button-remove-downvote-comment" data-id="{{ $comment->comment_id }}">
					<img src="/imagenes/iconos/thumb_down-active.svg" alt="Downvote" height="20px" width="20px">
					<span class="border-right vote">{{ $comment->downvotes_count }}</span>
				</button>
				@else
				<button type="button" class="button-downvote-comment" data-id="{{ $comment->comment_id }}">
					<img src="/imagenes/iconos/thumb_down-unactive.svg" alt="Downvote" height="20px" width="20px">
					<span class="border-right vote">{{ $comment->downvotes_count }}</span>
				</button>
				@endif

				@if(Auth::user()->id == $comment->comment_user_id && $comment->comment_comment_text != null)
				<form action="{{ route('article.delete-comment', $comment->comment_id) }}" method="POST" class="form-delete-comment">
					@csrf
					@method('DELETE')
					<button type="submit" class="deleteCommentButton">
						<img src="/imagenes/iconos/delete.svg" alt="Downvote" height="20px" width="20px" title="Delete comment">
					</button>
				</form>
				@endif

				<button type="button" class="reply-comment-button" data-commentId="{{ $comment->comment_id }}" onclick="showFormReplyComment(this)">
					<span>Reply</span>
				</button>
				@else
				<button type="button" onclick="showModal()">
					<img src="/imagenes/iconos/thumb_up-unactive.svg" alt="Upvote" height="20px" width="20px">
					<span class="border-right vote">{{ $comment->upvotes_count }}</span>
				</button>

				<button type="button" onclick="showModal()">
					<img src="/imagenes/iconos/thumb_down-unactive.svg" alt="Downvote" height="20px" width="20px">
					<span class="border-right vote">{{ $comment->downvotes_count }}</span>
				</button>
				@endif

			</div>
			@if($comment->replies != null)
			@forelse($comment->replies as $reply)
			<div class="reply-container">
				<h3 class="comment-author">{{ $reply->comment_author }} </h3>
				<p class="comment-timestamp">{{ $reply->comment_created_at }}</p>
				@if($reply->comment_comment_text != null)
				<p class="comment-text">{{ $reply->comment_comment_text }}</p>
				@else
				<p class="comment-text"><i>User has deleted the comment.</i></p>
				@endif
				<div class="button-comment-container">

					@if (Auth::check())
						@if ($reply->vote === '1')
						<button type="button" class="button-remove-upvote-comment" data-id="{{ $reply->comment_id_reply }}">
							<img src="/imagenes/iconos/thumb_up-active.svg" alt="Upvote" height="20px" width="20px">
							<span class="border-right vote">{{ $reply->upvotes_count }}</span>
						</button>
						@else
						<button type="button" class="button-upvote-comment" data-id="{{ $reply->comment_id_reply }}">
							<img src="/imagenes/iconos/thumb_up-unactive.svg" alt="Upvote" height="20px" width="20px">
							<span class="border-right vote">{{ $reply->upvotes_count }}</span>
						</button>
						@endif

						@if ($reply->vote === '-1')
						<button type="button" class="button-remove-downvote-comment" data-id="{{ $reply->comment_id_reply }}">
							<img src="/imagenes/iconos/thumb_down-active.svg" alt="Downvote" height="20px" width="20px">
							<span class="border-right vote">{{ $reply->downvotes_count }}</span>
						</button>
						@else
						<button type="button" class="button-downvote-comment" data-id="{{ $reply->comment_id_reply }}">
							<img src="/imagenes/iconos/thumb_down-unactive.svg" alt="Downvote" height="20px" width="20px">
							<span class="border-right vote">{{ $reply->downvotes_count }}</span>
						</button>
						@endif

						@if(Auth::user()->id == $reply->comment_user_id_reply && $reply->comment_comment_text != null)
						<form action="{{ route('article.delete-comment', $reply->comment_id_reply) }}" method="POST" class="form-delete-comment">
							@csrf
							@method('DELETE')
							<button type="submit" class="deleteCommentButton">
								<img src="/imagenes/iconos/delete.svg" alt="Downvote" height="20px" width="20px" title="Delete comment">
							</button>
						</form>
						@endif
					@else
						<button type="button" onclick="showModal()">
							<img src="/imagenes/iconos/thumb_up-unactive.svg" alt="Upvote" height="20px" width="20px">
							<span class="border-right vote">{{ $reply->upvotes_count }}</span>
						</button>

						<button type="button" onclick="showModal()">
							<img src="/imagenes/iconos/thumb_down-unactive.svg" alt="Downvote" height="20px" width="20px">
							<span class="border-right vote">{{ $reply->downvotes_count }}</span>
						</button>
					@endif
				</div>
			</div>
			@empty

			@endforelse
			@endif
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
						var changedownvote = $this.next();
						changedownvote.find("img").attr("src", "/imagenes/iconos/thumb_down-unactive.svg");

						//Remove 1 to the upvote count
						let numberUpvotes = parseInt(changedownvote.find("span").text());
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
						var changedownvote = $this.prev();
						changedownvote.find("img").attr("src", "/imagenes/iconos/thumb_up-unactive.svg");

						//Remove 1 to the upvote count
						let numberUpvotes = parseInt(changedownvote.find("span").text());
						numberUpvotes = numberUpvotes - 1;
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

<script>
	function showFormReplyComment(e) {
		var commentId = e.getAttribute('data-commentId');

		var url = '{{ route("article.reply-comment", ":commentId") }}';
		url = url.replace(':commentId', commentId);

		parentDiv = e.parentElement;
		$fragmentFormReply = "<form action='" + url + "' class='form-reply-comment'><textarea name='reply_comment_text' id='reply_comment_text' class='textarea-reply-comment' rows='4' maxlength='255'></textarea><button type='submit' class='submit-reply-comment'>Reply</button></form>";

		$(parentDiv).append($fragmentFormReply);

		e.disabled = true;
	}
</script>

<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).on("click", ".button-upvote-comment", function(e) {

		e.preventDefault();

		var $this = $(this);
		var commentId = $(this).data('id');
		var url = "{{ route('article.like-comment') }}";

		$.ajax({
			url: url,
			method: 'POST',
			data: {
				commentId: commentId
			},
			success: function(response) {
				if (response.success) {
					//Change the src image from the button

					$this.removeClass("button-upvote-comment");
					$this.addClass("button-remove-upvote-comment");

					$this.find("img").attr("src", "/imagenes/iconos/thumb_up-active.svg");

					//Add 1 to the upvote count
					let numberUpvotes = $this.find("span").text();
					numberUpvotes = parseInt(numberUpvotes) + 1;
					$this.find("span").text(numberUpvotes);

					//If there is a downvote change it
					if (response.message == 1) {
						var changedownvote = $this.next();
						changedownvote.find("img").attr("src", "/imagenes/iconos/thumb_down-unactive.svg");

						//Remove 1 to the upvote count
						let numberUpvotes = parseInt(changedownvote.find("span").text());
						numberUpvotes = parseInt(numberUpvotes) - 1;
						changedownvote.find("span").text(parseInt(numberUpvotes));

						changedownvote.addClass("button-downvote-comment");
						changedownvote.removeClass("button-remove-downvote-comment");
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

	$(document).on("click", ".button-downvote-comment", function(e) {

		e.preventDefault();

		var $this = $(this);
		var commentId = $(this).data('id');
		var url = "{{ route('article.dislike-comment') }}";

		$.ajax({
			url: url,
			method: 'POST',
			data: {
				commentId: commentId
			},
			success: function(response) {
				if (response.success) {
					//Change the src image from the button

					$this.removeClass("button-downvote-comment");
					$this.addClass("button-remove-downvote-comment");

					$this.find("img").attr("src", "/imagenes/iconos/thumb_down-active.svg");

					//Add 1 to the downvote count
					let numberDownvote = $this.find("span").text();
					numberDownvote = parseInt(numberDownvote) + 1;
					$this.find("span").text(numberDownvote);

					//If there is a downvote change it
					if (response.message == 1) {
						var changedownvote = $this.prev();
						changedownvote.find("img").attr("src", "/imagenes/iconos/thumb_up-unactive.svg");

						//Remove 1 to the upvote count
						let numberUpvotes = parseInt(changedownvote.find("span").text());
						numberUpvotes = numberUpvotes - 1;
						changedownvote.find("span").text(numberUpvotes);

						changedownvote.addClass("button-upvote-comment");
						changedownvote.removeClass("button-remove-upvote-comment");

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

	$(document).on("click", ".button-remove-upvote-comment", function(e) {

		e.preventDefault();

		var $this = $(this);
		var commentId = $(this).data('id');
		var url = "{{ route('article.remove-vote-comment') }}";

		$.ajax({
			url: url,
			method: 'DELETE',
			data: {
				commentId: commentId
			},
			success: function(response) {
				if (response.success) {
					//Change the src image from the button

					$this.removeClass("button-remove-upvote-comment");
					$this.addClass("button-upvote-comment");

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

	$(document).on("click", ".button-remove-downvote-comment", function(e) {

		e.preventDefault();

		var $this = $(this);
		var commentId = $(this).data('id');
		var url = "{{ route('article.remove-vote-comment') }}";

		$.ajax({
			url: url,
			method: 'DELETE',
			data: {
				commentId: commentId
			},
			success: function(response) {
				if (response.success) {
					//Change the src image from the button

					$this.removeClass("button-remove-downvote-comment");
					$this.addClass("button-downvote-comment");

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