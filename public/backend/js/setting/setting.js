"use strict";


$(document).on("click",'#kt_account_cache_btn',function(event){
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: adminUrl + '/settings/cache_clear',
        cache: false,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (formData, jqForm, options) {
            show_loader();
            $('#kt_account_cache_btn').attr('data-kt-indicator', 'on');
            $('#kt_account_cache_btn').attr('disabled', 'disabled');
        },
        complete: function () {
            hide_loader();
            $('#kt_account_cache_btn').removeAttr('data-kt-indicator');
            $('#kt_account_cache_btn').removeAttr('disabled');
        },
        success: function (response) {

            if (response.status == true) {
                toast_message('success',response.msg,'',0,'',0,response.redirect_url);
            } else {
                toast_message('error',response.msg,'',0,'',0,response.redirect_url);
            }
        },
        error: function (response) {
            toast_message('error',response.msg,'',0,'',0,response.redirect_url);
        }
    });
});

/**
 * Set value for project mode switch
 */
$('#production_mode').change(function() {
    $(this).val('0');
    if(this.checked) {
    $(this).prop("checked");
    $(this).val('1');
    }
});

let $project_mode_setting_form = $("#project_mode_setting_form").validate({
    errorElement: "div",
    errorClass: 'validation-error-label invalid-feedback',
    successClass: 'validation-valid-label',
    validClass: "validation-valid-label",
    focusInvalid: true,
    ignore: "input[type=hidden]",
    rules: {
        ip_address: {
            required: function(element){
                return $("#production_mode").val() == "1";
            }
        },
    },
    messages: {
        ip_address: {
            required: "IP address is required",
        },
    },
    invalidHandler: function (e, t) {
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    success: function(label) {
        label.addClass("validation-valid-label").text("")
    },
    errorPlacement: function(error, element) {
            error.insertAfter(element);
    },
    submitHandler: function (e) {
        $(e).ajaxSubmit({
            url: $('#project_mode_setting_form').attr('action'),
            dataType:'json',
            type: 'POST',
            clearForm: false,
            beforeSubmit: function (formData, jqForm, options) {
                $('#kt_account_general_settings_submit').attr('data-kt-indicator', 'on');
                $('#kt_account_general_settings_submit').attr('disabled', 'disabled');
            },
            complete: function () {
                $('#kt_account_general_settings_submit').removeAttr('data-kt-indicator');
                $('#kt_account_general_settings_submit').removeAttr('disabled');
            },
            error: function ( error ) {
                let $error = error.responseJSON.errors;
                $project_mode_setting_form.showErrors($error);
            },
            success: function (data) {
                if (data.status == true) {
                    toast_message('success',data.msg,'',0,'',0,data.redirect_url);
                } else {
                    toast_message('error',data.msg,'',0,'',0,data.redirect_url);
                }
            }
        });
    }
});


let $general_settings_form = $("#general_settings_form").validate({
    errorElement: "div",
    errorClass: 'validation-error-label invalid-feedback',
    successClass: 'validation-valid-label',
    validClass: "validation-valid-label",
    focusInvalid: true,
    ignore: "input[type=hidden]",
    rules: {
        site_logo: {
            required: function(){
                return $('#site_logo_exist').val() == 0 ? true : false;
            },
        },
        site_name: {
            required: true,
        },
        site_email: {
            required: true,
        },
        site_contact: {
            required: true,
        },
        site_address: {
            required: true,
        },
        admin_name: {
            required: true,
        },
        admin_email: {
            required: true,
        },
        admin_contact: {
            required: true,
        },

    },
    messages: {
        site_logo: {
            required: "Site logo is required",
        },

        site_name: {
            required: "Site name is required",
        },
        site_email: {
            required: "Site email is required",
        },
        site_contact: {
            required: "Site contact is required",
        },
        site_address: {
            required: "Site address is required",
        },
        admin_name: {
            required: "Admin name is required",
        },
        admin_email: {
            required: "Admin email is required",
        },
        admin_contact: {
            required: "Admin contact is required",
        },
    },
    invalidHandler: function (e, t) {
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    success: function(label) {
        label.addClass("validation-valid-label").text("")
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "site_logo" ){
            error.appendTo('#site_logo-error');
        }else{
            error.insertAfter(element);
        }
    },
    submitHandler: function (e) {
        $(e).ajaxSubmit({
            url: $('#general_settings_form').attr('action'),
            dataType:'json',
            type: 'POST',
            clearForm: false,
            beforeSubmit: function (formData, jqForm, options) {
                $('#kt_account_general_settings_submit').attr('data-kt-indicator', 'on');
                $('#kt_account_general_settings_submit').attr('disabled', 'disabled');
            },
            complete: function () {
                $('#kt_account_general_settings_submit').removeAttr('data-kt-indicator');
                $('#kt_account_general_settings_submit').removeAttr('disabled');
            },
            error: function ( error ) {
                let $error = error.responseJSON.errors;
                $general_settings_form.showErrors($error);
				toast_message('error',error.responseJSON.MESSAGE);
				setTimeout(() => {
					// window.location.reload();
				}, 1000);
            },
            success: function (data) {
                if (data.status == true) {
                    toast_message('success',data.msg,'',0,'',0,data.redirect_url);
					setTimeout(() => {
						window.location.reload();
					}, 1000);
                } else {
                    toast_message('error',data.msg,'',0,'',0,data.redirect_url);
                }
            }
        });
    }
});


let $email_settings_form = $("#email_settings_form").validate({
    errorElement: "div",
    errorClass: 'validation-error-label invalid-feedback',
    successClass: 'validation-valid-label',
    validClass: "validation-valid-label",
    focusInvalid: true,
    ignore: "input[type=hidden]",
    invalidHandler: function (e, t) {
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    success: function(label) {
        label.addClass("validation-valid-label").text("")
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "smtp_encryption" ){
            error.appendTo('#smtp_encryption-error');
        }else{
            error.insertAfter(element);
        }
    },
    rules: {
        smtp_host: {
            required: true,
        },
        smtp_port: {
            required: true,
        },
        smtp_encryption: {
            required: true,
        },
        smtp_user: {
            required: true,
        },
        smtp_password: {
            required: true,
        },
        from_name: {
            required: true,
        },
        reply_to_email: {
            required: true,
        },
        email_signature: {
            required: true,
        },
        email_header: {
            required: true,
        },
        email_footer: {
            required: true,
        },
    },
    messages: {
        smtp_host: {
            required: "SMTP host is required",
        },

        smtp_port: {
            required: "SMTP port is required",
        },
        smtp_encryption: {
            required: "SMTP encryption is required",
        },
        smtp_user: {
            required: "SMTP user is required",
        },
        smtp_password: {
            required: "SMTP password is required",
        },
        from_name: {
            required: "From name is required",
        },
        reply_to_email: {
            required: "Reply to email is required",
        },
        email_signature: {
            required: "Email signature is required",
        },
        email_header: {
            required: "Email header is required",
        },
        email_footer: {
            required: "Email footer is required",
        },
    },
    submitHandler: function (e) {
        $(e).ajaxSubmit({
            url: $('#email_settings_form').attr('action'),
            dataType:'json',
            type: 'POST',
            clearForm: false,
            beforeSubmit: function (formData, jqForm, options) {
                $('#kt_account_email_settings_submit').attr('data-kt-indicator', 'on');
                $('#kt_account_email_settings_submit').attr('disabled', 'disabled');
            },
            complete: function () {
                $('#kt_account_email_settings_submit').removeAttr('data-kt-indicator');
                $('#kt_account_email_settings_submit').removeAttr('disabled');
            },
            error: function ( error ) {
                let $error = error.responseJSON.errors;
                $email_settings_form.showErrors($error);
            },

            success: function (data) {
                if (data.status == true) {
                    toast_message('success',data.msg,'',0,'',0,data.redirect_url);
                } else {
                    toast_message('error',data.msg,'',0,'',0,data.redirect_url);
                }
            }
        });
    }
});



let $test_email_form = $("#test_email_form").validate({

    errorElement: "div",
    errorClass: 'validation-error-label invalid-feedback',
    successClass: 'validation-valid-label',
    validClass: "validation-valid-label",
    focusInvalid: true,
    ignore: "input[type=hidden]",
    invalidHandler: function (e, t) {
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    success: function(label) {
        label.addClass("validation-valid-label").text("")
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "smtp_encryption" ){
            error.appendTo('#smtp_encryption-error');
        }else{
            error.insertAfter(element);
        }
    },
    rules: {
        email: {
            required: true,
        },
    },
    messages: {
        email: {
            required: "Email is required",
        },
    },
    submitHandler: function (smtp_test_form) {
        let method = "POST";
        let url = $('#test_email_form').attr('action');
        let data = new FormData($(smtp_test_form)[0]);

        let ajax = formdata_ajax_call(method, url, data);
        ajax.done(function (response) {
            hide_loader();
            $('.submit-btn').prop('disabled', false);
            if (response['FLAG']) {
                $(smtp_test_form).trigger('reset');
                toastr.success(response['MESSAGE'], 'Success');
            }
            else {
                toastr.error(response['MESSAGE'], 'Error');
            }
        });
    }
});

let $social_media_settings_form = $("#social_media_settings_form").validate({

    errorElement: "div",
    errorClass: 'validation-error-label invalid-feedback',
    successClass: 'validation-valid-label',
    validClass: "validation-valid-label",
    focusInvalid: true,
    ignore: "input[type=hidden]",
    invalidHandler: function (e, t) {
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    success: function(label) {
        label.addClass("validation-valid-label").text("")
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "smtp_encryption" ){
            error.appendTo('#smtp_encryption-error');
        }else{
            error.insertAfter(element);
        }
    },
    rules: {
        facebook_url: {
            required: false,
        },
        instagram_url: {
            required: false,
        },
        twitter_url: {
            required: false,
        },
    },
    messages: {
        facebook_url: {
            required: "Facebook  url is required",
        },
        instagram_url: {
            required: "Instagram  url is required",
        },
        twitter_url: {
            required: "Twitter  url is required",
        },
    },
    submitHandler: function (e) {
        $(e).ajaxSubmit({
            url: $('#social_media_settings_form').attr('action'),
            dataType:'json',
            type: 'POST',
            clearForm: false,
            beforeSubmit: function (formData, jqForm, options) {
                $('#kt_account_social_media_settings_submit').attr('data-kt-indicator', 'on');
                $('#kt_account_social_media_settings_submit').attr('disabled', 'disabled');
            },
            complete: function () {
                $('#kt_account_social_media_settings_submit').removeAttr('data-kt-indicator');
                $('#kt_account_social_media_settings_submit').removeAttr('disabled');
            },
            error: function ( error ) {
                let $error = error.responseJSON.errors;
                $social_media_settings_form.showErrors($error);
            },

            success: function (data) {
                if (data.status == true) {
                    toast_message('success',data.msg,'',0,'',0,data.redirect_url);
                } else {
                    toast_message('error',data.msg,'',0,'',0,data.redirect_url);
                }
            }
        });
    }
});



let $timezone_setting_form = $("#timezone_setting_form").validate({
    errorElement: "div",
    errorClass: 'validation-error-label invalid-feedback',
    successClass: 'validation-valid-label',
    validClass: "validation-valid-label",
    focusInvalid: true,
    ignore: "input[type=hidden]",
    rules: {
        timezone: {
            required: true,
        },
    },
    messages: {
        timezone: {
            required: 'Timezone is required',
        },
    },
    invalidHandler: function (e, t) {
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    success: function(label) {
        label.addClass("validation-valid-label").text("")
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "timezone" ){
            error.insertAfter(element.next('span'));
        }
        else{
            error.insertAfter(element);
        }
    },
    submitHandler: function (e) {
        let view_name = $('#timezone_setting_form').attr('data-view');
        // let form_data = new FormData($('#timezone_setting_form')[0]);
        // form_data.append('view_name', view_name);
        $(e).ajaxSubmit({
            url: $('#timezone_setting_form').attr('action'),
            dataType:'json',
            type: 'POST',
            clearForm: true,
            beforeSubmit: function (formData, jqForm, options) {
                $('#timezone_setting_form_submit').attr('data-kt-indicator', 'on');
                $('#timezone_setting_form_submit').attr('disabled', 'disabled');
            },
            complete: function () {
                $('#timezone_setting_form_submit').removeAttr('data-kt-indicator');
                $('#timezone_setting_form_submit').removeAttr('disabled');
            },
            error: function ( error ) {
                let $error = error.responseJSON.errors;
                $timezone_setting_form.showErrors($error);
            },

            success: function (data) {
                if (data.status == true) {
                    toast_message('success',data.msg,'',0,'',0,data.redirect_url);
                } else {
                    toast_message('error',data.msg,'',0,'',0,data.redirect_url);
                }
            }
        });
    }
});


let $key_setting_form = $("#key_setting_form").validate({

    errorElement: "div",
    errorClass: 'validation-error-label invalid-feedback',
    successClass: 'validation-valid-label',
    validClass: "validation-valid-label",
    focusInvalid: true,
    ignore: "input[type=hidden]",
    invalidHandler: function (e, t) {
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    success: function(label) {
        label.addClass("validation-valid-label").text("")
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "smtp_encryption" ){
            error.appendTo('#smtp_encryption-error');
        }else{
            error.insertAfter(element);
        }
    },
    rules: {
        aws_key: {
            required: false,
        },
        aws_secret: {
            required: false,
        },
        aws_region: {
            required: false,
        },
        aws_bucket: {
            required: false,
        },
    },
    messages: {
        aws_key: {
            required: "AWS key is required",
        },
        aws_secret: {
            required: "AWS secret is required",
        },
        aws_region: {
            required: "AWS region is required",
        },
        aws_bucket: {
            required: "AWS bucket is required",
        },
    },
    submitHandler: function (e) {
        $(e).ajaxSubmit({
            url: $('#key_setting_form').attr('action'),
            dataType:'json',
            type: 'POST',
            clearForm: false,
            beforeSubmit: function (formData, jqForm, options) {
                $('#kt_key_settings_submit').attr('data-kt-indicator', 'on');
                $('#kt_key_settings_submit').attr('disabled', 'disabled');
            },
            complete: function () {
                $('#kt_key_settings_submit').removeAttr('data-kt-indicator');
                $('#kt_key_settings_submit').removeAttr('disabled');
            },
            error: function ( error ) {
                let $error = error.responseJSON.errors;
                $key_setting_form.showErrors($error);
            },

            success: function (data) {
                if (data.status == true) {
                    toast_message('success',data.msg,'',0,'',0,data.redirect_url);
                } else {
                    toast_message('error',data.msg,'',0,'',0,data.redirect_url);
                }
            }
        });
    }
});

$(document).on("submit",'#maintance_mode_form',function(event){
    event.preventDefault();
    let maintance_mode_status = $('input[name="maintance_mode"]:checked').val();
     $.ajax({
        type: "POST",
        url: $('#maintance_mode_form').attr('action'),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {'maintance_mode':maintance_mode_status},
        beforeSend: function () {
            show_loader();
            $('#kt_account_maintance_mode_settings_submit').attr('data-kt-indicator', 'on');
            $('#kt_account_maintance_mode_settings_submit').attr('disabled', 'disabled');
        },
        success: function (response) {
            hide_loader();
            $('#kt_account_maintance_mode_settings_submit').removeAttr('data-kt-indicator');
            $('#kt_account_maintance_mode_settings_submit').removeAttr('disabled');
            if (response.status == true) {
                toast_message('success',response.msg,'',0,'',0,response.redirect_url);
            }
        },
        error: function (response) {
            hide_loader();
            toast_message('error',response.msg,'',0,'',0,response.redirect_url);
        }
    });
});

// General setting on change file type validation
$(document).on("change", "#site_logo", function() {
	var $input 		= $(this);
	var files 		= $input[0].files;
	var filename 	= files[0].name;

	var extension 				= filename.substr(filename.lastIndexOf("."));
	var allowedExtensionsRegx 	= /(\.jpg|\.jpeg|\.png)$/i;
	var isAllowed 				= allowedExtensionsRegx.test(extension);

	if(!isAllowed) {
		toast_message('error','Allowed file types: png, jpg, and jpeg');
		setTimeout(() => {
			window.location.reload();
		}, 1000);
	}
});
