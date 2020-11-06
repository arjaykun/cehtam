$(document).ready( function() {

	$('.burger').on('click', function() {
	   	$(this).toggleClass('is-active');
	    $('#navMenu').toggleClass('is-active');
	});

	$('.modal-close').on('click', function() {
		$(".modal").removeClass('is-active');
	});

	$('#cancel').on('click', function(e) {
		e.preventDefault();
		$(".modal").removeClass('is-active');
	});
})

