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