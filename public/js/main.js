$(function() {

	$(document).on('submit', '.instructor-search', function(e) {
		e.preventDefault();
		location.href = $(this).attr('action') + '/' + $('#search-txt').val();
	});

});