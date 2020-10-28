$(function() {

	$(document).on('submit', '.instructor-search', function(e) {
		e.preventDefault();
		location.href = $(this).attr('action') + '/' + $('#search-txt').val();
	});

	$('#feedback-form').submit(function(e) {
		e.preventDefault();
	
		let data = {};
		$(e.target).find(':input:not(button)').each(function() {
			data[$(this).attr('name')] = $(this).val();
		});
		
		var classid = $(e.target).data("classid");
	
		$.post(BASEURL + 'Feedback/FeedbackForm/' + classid, data, function(resp) {
			console.log(resp);
		});
	});

});