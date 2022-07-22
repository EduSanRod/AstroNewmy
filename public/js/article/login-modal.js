
	// Get the modal
	var modal = document.getElementById('login-modal');
	alert(modal.innerHTML);
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
