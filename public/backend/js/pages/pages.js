"use strict";


var about_us_editor;
var blog_editor;
var privacy_policy_editor;
var terms_editor;

ClassicEditor
    .create( document.querySelector( '#about_us' ) )
    .then( editor => {
        page_editor = editor;
    })
    .catch( err => {
        
    });

ClassicEditor
    .create( document.querySelector( '#blog' ) )
    .then( editor => {
        blog_editor = editor;
    })
    .catch( err => {
        
    });

ClassicEditor
    .create( document.querySelector( '#privacy_policy' ) )
    .then( editor => {
        privacy_policy_editor = editor;
    })
    .catch( err => {
        
    });

ClassicEditor
    .create( document.querySelector( '#terms' ) )
    .then( editor => {
        terms_editor = editor;
    })
    .catch( err => {
        
    });



let $pages_terms_form = $("#pages_terms_form").validate({

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
        about_us: {
            required: false,
        },
        blog: {
            required: false,
        },
        privacy_policy: {
            required: false,
        },
        terms: {
            required: false,
        },
    },
    about_us: {
        subject: {
            required: "About us is required",
        },
        blog: {
            required: "Blog is required",
        },
        privacy_policy: {
            required: "Blog is required",
        },
        terms: {
            required: "Terms is required",
        },
    },
    submitHandler: function (e) {
        $(e).ajaxSubmit({
            url: $('#pages_terms_form').attr('action'),
            dataType:'json',
            type: 'POST',
            clearForm: false,
            cache: false,
            processData: false,
            contentType: false,
            beforeSubmit: function (formData, jqForm, options) {
                $('#kt_pages_submit').attr('data-kt-indicator', 'on');
                $('#kt_pages_submit').attr('disabled', 'disabled');
            },
            complete: function () {
                $('#kt_pages_submit').removeAttr('data-kt-indicator');
                $('#kt_pages_submit').removeAttr('disabled');
            },
            error: function ( error ) {
                let $error = error.responseJSON.errors;
                $pages_terms_form.showErrors($error);
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