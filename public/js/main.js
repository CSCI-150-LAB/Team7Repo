$(function() {

	$('select').selectpicker();

	$(document).on('submit', '.instructor-search', function(e) {
		e.preventDefault();
		location.href = $(this).attr('action') + '/' + $('#search-txt').val();
	});

	function addRatingFieldClasses(parent, score) {
		for (let i = 1; i <= 5; i++) {
			parent[i <= score ? 'addClass' : 'removeClass'](`score-${i}`);
		}
	}

	$(document).on('mouseleave', '.rating-field', function() {
		let parent = $(this),
			score = parent.find('input').val() || 0;

		addRatingFieldClasses(parent, score);
	});

	$(document).on('mouseenter', '.rating-field .fa-star', function() {
		addRatingFieldClasses($(this).parent(), $(this).index());
	});

	$(document).on('click', '.rating-field .fa-star', function() {
		$(this).parent().find('input').val($(this).index());
	});

	$('.rating-field').trigger('mouseleave');

});