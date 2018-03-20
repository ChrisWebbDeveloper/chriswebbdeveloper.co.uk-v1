$(document).ready(function() {

	$('#training_button').mouseenter(function() {
		$(this).animate({'opacity': '1'}, 300);
	});

	$('#training_button').mouseleave(function() {
		$(this).animate({'opacity': '0.9'}, 300);
	});

	$('#training_button').click(function() {
		$(this).effect('highlight', {'color': 'white'}, 300);

		var href = $(this).closest('a').attr('href');
		setTimeout(function() {window.location.href = href}, 600);
		return false;
	});

});
