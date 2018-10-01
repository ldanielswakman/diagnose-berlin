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

});


scrollevents = 'ready scroll resize scrollstart scrollstop';
$(document).on(scrollevents, function() { drawPartners(); });

function drawPartners() {
	if($('.partners-grid').length > 0) {

		$grid = $('.partners-grid').first();
		$items = $grid.find('.box');

	  var partners_canvas = document.getElementById('partners_canvas');
	  var context = partners_canvas.getContext('2d');

	  context.clearRect(0, 0, partners_canvas.width, partners_canvas.height);

		$prevX = 0;
		$prevY = 0;
		console.log('container',$('#partners_canvas').offset().left, $('#partners_canvas').offset().top);

		$items.each(function() {
			$pointX = $(this).offset().left - $('#partners_canvas').offset().left + $(this).outerWidth()/2;
			$pointY = $(this).offset().top - $('#partners_canvas').offset().top + $(this).outerHeight()/2;

			$prevX = $pointX;
			$prevY = $pointY;

		  context.moveTo($('#partners_canvas').outerWidth()/2 - 20, $('#partners_canvas').outerHeight()/2 + 30);
		  context.lineTo($pointX, $pointY);

			console.log($pointX, $pointY);
		});
		context.strokeStyle = "#E7EDEF";
		context.lineWidth = 5;
		context.stroke();
	}
}
