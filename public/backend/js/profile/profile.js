"use strict";
$(document).ready(function () {
	// ############### Edit Profile Actions Start ############### //
	var edit_profile_form = document.querySelector('#kt_account_profile_details_form');
	var edit_profile_submit_button = document.querySelector("#kt_account_profile_details_submit");

	// Handle the form submit
	edit_profile_submit_button.addEventListener("click", function (event) {
		// Stop the form submit event
		event.preventDefault();
        
		// Check form is valid
		// edit_profile_validator.validate().then(function (is_form_valid) {
		if ($("#kt_account_profile_details_form ").valid() == true) {
			// Show loader on the button
			show_loader();
			$('.submit-btn').prop('disabled', true);

			let method = edit_profile_form.getAttribute('method');
			let url = edit_profile_form.getAttribute('action');
			let data = new FormData($(edit_profile_form)[0]);
			let ajax = formdata_ajax_call(method, url, data);

			ajax.done(function (response) {
				hide_loader();
				$('.submit-btn').prop('disabled', false);
				if (response['FLAG']) {
					$('#profile_detail_section').html(response['DATA']['view']);
					toastr.success(response['MESSAGE'], 'Success');
					setTimeout(() => {
						window.location.reload()
					}, 3000);
				}
				else {
					toastr.error(response['MESSAGE'], 'Oh snap!');
				}
			});
		}
		// });
	});
	// ############### Edit Profile Actions End ############### //


	// ############### Change password Action start ############### //
	var n = document.getElementById("kt_signin_password");
	var o = document.getElementById("kt_signin_password_edit");
	var r = document.getElementById("kt_signin_password_button");
	var a = document.getElementById("kt_password_cancel");

	function d() {
		n.classList.toggle("d-none"), r.classList.toggle("d-none"), o.classList.toggle("d-none")
	}

	r.querySelector("button").addEventListener("click", (function () {
		d();
	}));
	a.addEventListener("click", (function () {
		d();
		$(change_password_form).find('input:password').val('').removeClass('is-valid');
		$(change_password_form).find('.invalid-feedback').css('display','none');
	}));


	var change_password_form = document.querySelector('#kt_signin_change_password');
	var change_password_submit_button = document.querySelector("#kt_password_submit");

	// Handle the form submit
	change_password_submit_button.addEventListener("click", function (event) {
		// Stop the form submit event

		event.preventDefault();

		// Check form is valid
		if ($("#kt_signin_change_password").valid() == true) {

			// Show loader on the button
			show_loader();
			$('.submit-btn').prop('disabled', true);

			let method = change_password_form.getAttribute('method');
			let url = change_password_form.getAttribute('action');
			let data = new FormData($(change_password_form)[0]);
			let ajax = formdata_ajax_call(method, url, data);

			ajax.done(function (response) {
				hide_loader();
				$('.submit-btn').prop('disabled', false);
				if (response['FLAG']) {
					$('#kt_password_cancel').trigger('click');
					toastr.success(response['MESSAGE'], 'Success');
					$(change_password_form).find('input:password').val('').removeClass('is-valid');
				}
				else {
					toastr.error(response['MESSAGE'], 'Oh snap!');
				}
			});
		}
	});

	$(document).on('click', '.check_eye_open', function () {
		$(this).attr('hidden',true);
		$(this).parents('.password_control').find('.check_eye_close').attr('hidden',false);
		$(this).parents('.password_control').find('.form-control').attr('type','password');
	});

	$(document).on('click', '.check_eye_close', function () {
		$(this).attr('hidden',true);
		$(this).parents('.password_control').find('.check_eye_open').attr('hidden',false);
		$(this).parents('.password_control').find('.form-control').attr('type','text');

	});
});
