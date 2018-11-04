$(document).ready(function() {

	$('body').addClass('isLoaded');

	// Nav toggle
	$('.menu-toggle').click(function() {
		$(this).closest('nav').toggleClass('isActive');
	});

	// Contact Form toggle
	$('a[href="#contact-form"]').click(function() {
		$('#contact-form').addClass('isActive');
	});
	// Contact Form toggle
	$('.popup').click(function(e) {
    if(e.target != this) return; // only continue if the target itself has been clicked

    // this section only processes if the .nav > li itself is clicked.
    $('#contact-form').removeClass('isActive');
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


// WP Gravoty Form Interaction addition
$(document).ready(function() {
	if($('.gform_wrapper').length > 0) {
		checkFGActive();
	}
	// setInterval(function() { checkFGActive() }, 500);

	$('.gform_wrapper').click(function() {
		checkFGActive();
	});
});

function checkFGActive() {
	$('.gform_wrapper').each(function() {

		// This is the form
		$form = $(this);

		// Set first page to be active automatically
		// $form.find('.gform_page').first().addClass('isActive');

		// Remove pre-existing classes
		$form.find('.gform_body').find('.gform_page').removeClass('isCompleted isActive isPending');

		// Loop over steps to find active pages
		$form.find('.gf_page_steps').find('.gf_step').each(function(i) {

			// index to child number
			childNumber = i+1;

			// Set completed class if found
			if($(this).hasClass('gf_step_completed')) {
				$form.find('.gform_body').find('.gform_page:nth-child(' + childNumber + ')').addClass('isCompleted');
				// console.log('active: ' + childNumber);
			}
			// Set active class if found
			if($(this).hasClass('gf_step_active')) {
				$form.find('.gform_body').find('.gform_page:nth-child(' + childNumber + ')').addClass('isActive');
				// console.log('active: ' + childNumber);
			}
			// Set pending class if found
			if($(this).hasClass('gf_step_pending')) {
				$form.find('.gform_body').find('.gform_page:nth-child(' + childNumber + ')').addClass('isPending');
				// console.log('pending: ' + childNumber);
			}
		});
	});
}
