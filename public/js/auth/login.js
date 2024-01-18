"use strict";

$(document).ready(function () {
    var form = document.querySelector("#kt_sign_in_form");
    var submit_button = document.querySelector("#kt_sign_in_submit");

    // Validate the form
    var validator = FormValidation.formValidation(form, {
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: "Email address is required",
                    },
                    emailAddress: {
                        message: "The value is not a valid email address",
                    },
                },
            },
            password: {
                validators: {
                    notEmpty: {
                        message: "The password is required",
                    },
                },
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: ".fv-row",
            }),
        },
    });

    // Handle the form submit
    submit_button.addEventListener("click", function (event) {
        // Stop the form submit event
        event.preventDefault();
        // Check form is valid
        validator.validate().then(function (is_form_valid) {
            if (is_form_valid == "Valid") {
                // Show loader on the button
                show_loader();
                $(".submit-btn").prop("disabled", true);

                let method = form.getAttribute("method");
                let url = form.getAttribute("action");
                let data = $(form).serialize();
                let ajax = ajax_call(method, url, data);
                ajax.done(function (response) {
                    console.log(response);
                    if (response["FLAG"]) {
                        // toastr.success(response['MESSAGE'],'Success');
                        window.location.href = response["DATA"]["redirect_url"];
                    } else {
                        // hide_loader();
                        toastr.error(response["MESSAGE"], "Oh snap!");
                    }
                })
                    .fail(function (response) {
                        console.log("sasasa", response);
                    })
                    .always(function (response) {
                        // This will be executed no matter if the request succeeds or fails
                        console.log("Request completed.", response);
                    });
            }
        });
    });
});
