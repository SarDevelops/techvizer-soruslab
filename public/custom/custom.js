$(document).on('click', '.check_eye_open', function () {
	$(this).attr('hidden', true);
	$(this).parents('.password_control').find('.check_eye_close').attr('hidden', false);
	$(this).parents('.password_control').find('.form-control').attr('type', 'password');
});

$(document).on('click', '.check_eye_close', function () {
	$(this).attr('hidden', true);
	$(this).parents('.password_control').find('.check_eye_open').attr('hidden', false);
	$(this).parents('.password_control').find('.form-control').attr('type', 'text');
});


