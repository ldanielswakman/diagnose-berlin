$(document).ready(function() {

	$('body').addClass('isLoaded');

	// Form advance interaction (mockup only, since form is implemented via WP Plugin)
	$('.form-section .field--radio label').click(function() {

		$parent = $(this).closest('.form-section');

		if($parent.hasClass('isActive')) {

			setTimeout(function() {
				$parent.removeClass('isActive');
				$parent.next('.form-section').addClass('isActive');
			}, 500);

		}
	});

	// Nav toggle
	$('.menu-toggle').click(function() {
		$(this).closest('nav').toggleClass('isActive');
	});
	
});
