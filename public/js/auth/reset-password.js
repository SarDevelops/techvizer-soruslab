"use strict";

$(document).ready(function () {
	var form = document.querySelector('#kt_new_password_form');
	var submit_button = document.querySelector("#kt_new_password_submit");

	// Validate the form
    var validator = FormValidation.formValidation(form, {
		fields: {
			email: {
				validators: {
					notEmpty: {
						message: "Email address is required"
					},
					emailAddress: {
						message: "The value is not a valid email address"
					}
				}
			},
			password: {
				validators: {
					notEmpty: {
						message: "The password is required"
					},
					callback: {
						message: "Please enter valid password",
						callback: function(e) {
							if (e.value.length > 0) return s()
						}
					}
				}
			},
			password_confirmation: {
				validators: {
					notEmpty: {
						message: "The password confirmation is required"
					},
					identical: {
						compare: function() {
							return e.querySelector('[name="password"]').value
						},
						message: "The password and its confirm are not the same"
					}
				}
			},
		},
		plugins: {
			trigger: new FormValidation.plugins.Trigger,
			bootstrap: new FormValidation.plugins.Bootstrap5({
				rowSelector: ".fv-row"
			})
		}
	});
	
	// Handle the form submit
	submit_button.addEventListener("click", function(event) {
		// Stop the form submit event
		event.preventDefault();

		// Check form is valid
		validator.validate().then(function (is_form_valid) {
			if (is_form_valid == 'Valid') {
				// Show loader on the button
				show_loader();
				$('.submit-btn').prop('disabled', true);

				let method = form.getAttribute('method');
				let url = form.getAttribute('action');
				let data = $(form).serialize();
				let ajax = ajax_call(method, url, data);

				ajax.done(function (response) {
					hide_loader();
					$('.submit-btn').prop('disabled', false);
					if (response['FLAG']) {
						$(form).trigger('reset');
						validator.resetForm(true);
						// toastr.success(response['MESSAGE'],'Success');
						window.location.href = response['DATA']['redirect_url'];
					}
					else {
						toastr.error(response['MESSAGE'],'Oh snap!');
					}
				});
			}
		});
	});
});