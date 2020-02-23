$(document).ready(function() {

	$('body').addClass('isLoaded');

	// Nav toggle
	$('.menu-toggle').click(function() {
		$(this).closest('nav').toggleClass('isActive');
	});

	// Contact Form toggle
	$('a[href*="#contact-form"]').click(function() {
		target = $(this).attr('href');
		$(target).addClass('isActive');
	});
	// Contact Form toggle
	$('.popup').click(function(e) {
    if(e.target != this) return; // only continue if the target itself has been clicked

    // this section only processes if the .nav > li itself is clicked.
    $('.popup').removeClass('isActive');
	});
	// Contact Form toggle
	$('.popup .popup__close').click(function(e) {
		e.preventDefault();
    $('.popup').removeClass('isActive');
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
		$btn.addClass('isActive');
		$btn.closest('.button--toggle-group').find('.button').not($btn).removeClass('isActive');

		// Show/hide package sections
		$('.col--grouped').addClass('isHidden');
		$('.col--'+$target).removeClass('isHidden');
	} else {
		console.log('no button or target found...');
	}
}




function toggleTooltip($btn) {
	if($btn.length > 0) {

		$table = $btn.closest('table');

		if ($table.length > 0) {
			$table.find('.title').not($btn.closest('.title')).removeClass('isActive');
			$btn.closest('.title').toggleClass('isActive');
		} else {
			$grid = $btn.closest('.partners-grid');
			if(!$btn.closest('.partner').hasClass('isActive')) {
				$grid.find('.partner').removeClass('isActive');
				$btn.closest('.partner').addClass('isActive');
			} else {
				$grid.find('.partner').removeClass('isActive');
			}
		}
	} else {
		console.log('no button found...');
	}
}




function toggleMemberDescription($btn) {
	if($btn.length > 0) {
		// Change buttons
		$btn.closest('.member').toggleClass('isActive');
	} else {
		console.log('no button found...');
	}
}



// Dialog Interactions
function openDialog(target) {
	if($('.dialog-wrapper#'+target).length > 0) {
		$('body').addClass('dialogIsActive');
		$('.dialog-wrapper#'+target).addClass('isActive');
	} else {
		console.log('no target found...');
	}
}
function closeDialog() {
	$('body').removeClass('dialogIsActive');
	$('.dialog-wrapper').removeClass('isActive');
}




// WP Gravity Form Interaction addition
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




// Cituro Widget Interaction
$(document).ready(function() {
	$('.cituroButton, [href*="cituro.com"]').click(function(e) {

		e.preventDefault();
		target = this.href;

		options = {};
		if(target.includes('https://app.cituro.com/booking/diagnoseberlin?presetService=')) {
			serviceID = target.replace('https://app.cituro.com/booking/diagnoseberlin?presetService=', '');
			options = { 'presetService': serviceID };
		}

		cituroWidget.show(options);
		
	});
});
