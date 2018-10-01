$(document).ready(function() {

	$('.form-section .field--radio label').click(function() {

		$parent = $(this).closest('.form-section');

		if($parent.hasClass('isActive')) {

			setTimeout(function() {
				$parent.removeClass('isActive');
				$parent.next('.form-section').addClass('isActive');
			}, 500);

		}
	});

	if($('.partners-grid')) {
		console.log('found!');
	}

});
