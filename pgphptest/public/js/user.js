$(function(){ 

	$('#comment-section-btn').on('click', function(e) {
		e.preventDefault();

		let elem = $('#comment-section')

		if (elem.hasClass('d-none')) {

			elem.removeClass('d-none')
		} else {

			elem.addClass('d-none')
		}
	})
});