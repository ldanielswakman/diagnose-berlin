$(document).ready(function() {

	$('body').addClass('isLoaded');

	$('.form-section .field--radio label').click(function() {

		$parent = $(this).closest('.form-section');

		if($parent.hasClass('isActive')) {

			setTimeout(function() {
				$parent.removeClass('isActive');
				$parent.next('.form-section').addClass('isActive');
			}, 500);

		}
	});
	
});
