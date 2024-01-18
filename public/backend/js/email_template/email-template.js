"use strict";
$(document).ready(function () {
	var email_template_table = $("#admin_email_templates_table").DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		destroy: true,
		pageLength: 10,
		lengthMenu: [
			[5, 10, 20, 50, 100],
			[5, 10, 20, 50, 100],
		],
		language: {
			search: "<span>Search : </span> _INPUT_",
			lengthMenu: "<span>Show : </span> _MENU_",
			searchPlaceholder: "Search",
			emptyTable: "No data available in table",
			zeroRecords: "No data available in table",
		},
		buttons: {
			dom: {
				button: {
					className: "btn btn-default",
				},
			},
			buttons: [],
		},
		"order": [
			[3, "desc"]
		],
		columns: [{
				name: "email_templates.id",
				data: "id",
				visible: false,
				searchable: false,
				render: function (data, type, full, meta) {
					return data;
				},
			},
			{
				name: "email_templates.name",
				data: "name",
				className: "px-4",
				render: function (data, type, full, meta) {
					return data;
				},
			},
			{
				name: "email_templates.subject",
				data: "subject",
				className: "px-4",
				render: function (data, type, full, meta) {
					return data;
				},
			},
			{
				name: "email_templates.created_at",
				visible: false,
				searchable: false,
				data: "created_at",
				className: "px-4",
				render: function (data, type, full, meta) {
					return data;
				},
			},
			{
				name: "email_templates.id",
				data: "id",
				orderable: false,
				className: "px-4 text-center",
				render: function (data, type, full, meta) {
					let edit_path = adminUrl + "/email-templates/edit/" + btoa(full.id);
					let html = "";
					html += `<a href="${edit_path}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">`;
					html += '<span class="svg-icon svg-icon-3">';
					html += '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">';
					html += '<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="#134266" />';
					html += '<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="#134266" />';
					html += '</svg>';
					html += '</span>';
					html += '</a>';

					return html;
				},
			},
		],
		initComplete: function () {
			$("select").addClass("datatable-select");
		},
		fnServerData: function (sSource, aoData, fnCallback) {
			var req_obj = {};
			aoData.forEach(function (data, key) {
				req_obj[data["name"]] = data["value"];
			});

			$.ajax({
				dataType: "json",
				type: "get",
				data: req_obj,
				url: email_template_listing_route,
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
				},
				pageLength: 5,
				success: function (data) {
					fnCallback(data);
				},
			});
		},
	});

	$(document).on('keyup', '[data-kt-email-template-table-filter="search"]', delay(function (event) {
		email_template_table.search(event.target.value).draw();
	}, 500));

	CKEDITOR.replace('message', {
		uiColor: '#EFF3F3',
		editorplaceholder: 'Start typing here..',
		height: '400px',
		removeButtons: 'PasteFromWord,Form,Radio,Checkbox,TextField,Textarea,Button,Select,HiddenField,ImageButton,Subscript,Superscript,BidiLtr,BidiRtl,Language,Anchor,Flash,Iframe,ShowBlocks,About',
		removePlugins: 'scayt',

		on: {
			instanceReady: function (ev) {
				// Output paragraphs as <p>Text</p>.
				this.dataProcessor.writer.setRules('p', {
					indent: false,
					breakBeforeOpen: true,
					breakAfterOpen: false,
					breakBeforeClose: false,
					breakAfterClose: true
				});
			}
		}
	});

	$('.copy').on('click', function (e) {
		e.preventDefault();
		var placeholder_value = $(this).text();
		CKEDITOR.instances['mail_body'].insertText(placeholder_value);
	});

	let $email_template_form = $("#email_template_form").validate({

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
	        subject: {
	            required: true,
	        },
	        message: {
				function()
				{
					CKEDITOR.instances.message.updateElement();
				},
	            required: true,
	        },
	    },
	    messages: {
	        subject: {
	            required: "Subject is required",
	        },
	        message: {
	            required: "Message is required",
	        },
	    },
	    submitHandler: function (e) {
	        $(e).ajaxSubmit({
	            url: $('#email_template_form').attr('action'),
	            dataType:'json',
	            type: 'POST',
	            clearForm: false,
	            beforeSubmit: function (formData, jqForm, options) {
	                $('#btn_edit_email_template').attr('data-kt-indicator', 'on');
	                $('#btn_edit_email_template').attr('disabled', 'disabled');
	            },
	            complete: function () {
	                $('#btn_edit_email_template').removeAttr('data-kt-indicator');
	                $('#btn_edit_email_template').removeAttr('disabled');
	            },
	            error: function ( error ) {
	                let $error = error.responseJSON.errors;
	                $email_template_form.showErrors($error);
	            },

	            success: function (data) {
	                if (data.status == true) {
	                    toast_message('success');
	                } else {
	                    toast_message('error',data.msg,'',0,'',0,data.redirect_url);
	                }
	            }
	        });
	    }
	});
});
