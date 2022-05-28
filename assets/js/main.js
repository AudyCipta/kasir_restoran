$(document).ready(function() {
	
	// Toggle password
	$('.toggle-password').click(function() {
		if ($(this).children().hasClass('fa-eye'))
			$(this).children().removeClass('fa-eye').addClass('fa-eye-slash');
		else
			$(this).children().removeClass('fa-eye-slash').addClass('fa-eye');
		const input = $($(this).data('target'));
		(input.attr('type') == 'password') ? input.attr('type', 'text') : input.attr('type', 'password');
	});

	// Upload file
	$('.custom-file-input').on('change', function(){
	    const fileName = $(this).val().split('\\').pop();
	    $('.custom-file-label').addClass("selected").html(fileName);
	});

});