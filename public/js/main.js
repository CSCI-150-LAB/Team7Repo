// @ts-nocheck
$(function() {

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

	$(document).on('change', '.has-img-preview', function() {
		let target = $($(this).data('target')),
			input = this;

		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
				target.attr('src', e.target.result);
			};
			
			reader.readAsDataURL(input.files[0]);
		}
		else {
			target.attr('src', target.data('src'));
		}
	});

	$(document).on('click', '.btn-reset-file-input', function() {
		$($(this).data('target')).val(null).trigger('change');
	});

});