$(document).ready(function() {
	$('.notify').delay(5000).slideUp('slow');
	$('.product-description').on('click', function(e) {
		var product_description = $(this).attr('href');
		$(product_description).toggle();
		e.preventDefault();
		return false;
	});

	$('.modal-product').on('click', function(e) {
		var service_id = $(this).data('service-id');
		var amount = $(this).html();
		var price = "&#8369; " + $(this).data('price');
		var image = $(this).data('product-image');
		var buy_now_link = $('#modal-product-buy-now').attr('href') + '/' + service_id;

		$('#modal-product-image').html('<img src="' + image + '" height="49">');
		$('#modal-product-information').html('<h3>' + amount + ' for only ' + price + ' load</h3>');
		$('#modal-product-buy-now').attr('href', buy_now_link);
		$('#modal-product').modal();
	});
});