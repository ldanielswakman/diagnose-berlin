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




function toggleComparison($btn) {
	if($btn.length > 0) {
		$section = $btn.closest('section');
		$section.find('.comparison').toggleClass('isHidden');
	} else {
		console.log('no button found...');
	}
}



function togglePackages($btn, $target) {
	if($btn.length > 0 && $target.length > 0) {
		// Change buttons
		$btn.addClass('button--blue').removeClass('button--outline');
		$btn.closest('.button--toggle-group').find('.button').not($btn).addClass('button--outline').removeClass('button--blue');
		// Show/hide package sections
		$('.section--packages').addClass('isHidden');
		$('#'+$target).removeClass('isHidden');
		console.log('#'+$target);
		// Hide comparison tables
		$('.comparison').addClass('isHidden');
	} else {
		console.log('no button or target found...');
	}
}



function toggleTooltip($btn) {
	if($btn.length > 0) {
		$table = $btn.closest('table');
		$table.find('.title').not($btn.closest('.title')).removeClass('isActive');
		$btn.closest('.title').toggleClass('isActive');
	} else {
		console.log('no button found...');
	}
}