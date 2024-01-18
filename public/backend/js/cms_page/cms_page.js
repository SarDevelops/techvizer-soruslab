$(document).ready(function () {
    // listing the data
    if ($('#cms_page_table').length) {
        var cms_page_table = $('#cms_page_table').DataTable({
            info: true,
			responsive: true,
			processing: true,
			serverSide: true,
			searching: true,
			lengthChange: true,
			order: [[0, "desc"]],
			lengthMenu: [10, 20, 50, 100, 150, 200, 250],
			dom: '<"main-div"<"dt-top"li><p>>t<"main-div"<"dt-top"li><p>>',
			pageLength: 10,
            ajax: {
                url: cms_page_listing_route,
                beforeSend: function (request) {
                  show_loader();
                  request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                },
            },
            columns: [
                {
                    data: 'id'
                },
                {
                    data: 'heading'
                },
                {
                    data: 'slug'
                },
                {
                    data : 'is_active'
                },
                {
                    data : 'created_at',
                    searchable: false,
                    visible: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            order: [[4, 'desc']],
            drawCallback: function( settings ) {
                hide_loader();
            }
        });
    }

    // Show edit cms page form
    $(document).on('click', '.open-cms-page-form', function () {
        show_loader();
        let method = 'GET';
        let url = $(this).attr('target-url');
        let heading = $(this).attr('target-header');
		let is_multi_element= Number($(this).attr('target-multi-element'));
        let ajax = formdata_ajax_call(method, url);

        ajax.done(function (response) {
            hide_loader();
            $('.submit-btn').prop('disabled', false);
            if (response['FLAG']) {
                action_drawer({heading : heading})
                $('#action-drawer-body').html(response['DATA']['view']);
            }
            else {
                toastr.error(response['MESSAGE']);
            }
            // textarea replace with CKEDITOR
			if(is_multi_element)
			{
				// replace multiple textarea with CKEDITOR
				addMultipleEditor();

			}else{
                CKEDITOR.replace('cms_description', {
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
			}



        });
    });


    //submit form
    $(document).on('submit', '#cms_page_form', function (event) {
        event.preventDefault();
        show_loader();
        $('.submit-btn').prop('disabled', true);
        let cms_page_form = $(this);
        let method = cms_page_form.attr('method');
        let url = cms_page_form.attr('action');
        let data = new FormData($(cms_page_form)[0]);
        let ajax = formdata_ajax_call(method, url, data);
        ajax.done(function (response) {
            hide_loader();
            $('.submit-btn').prop('disabled', false);
            if (response['FLAG']) {
                cms_page_table.ajax.reload();
                action_drawer();
                toastr.success(response['MESSAGE'], 'Success');
            }
            else {
                toastr.error(response['MESSAGE'], 'Error');
            }
        });
    });

    $(document).on('change', '.is_active', function () {
        let is_active = ($(this).is(':checked')) ? 1 : 0;
        let element = $(this);
        var currentRow = $(this).closest("tr");
        var col_text = currentRow.find("td:eq(1)").text();
        let status_name = (is_active) ? 'activate' : 'deactivate';

        delete_confirmation(`Are you sure you want to ${status_name} the ${col_text} page?`, `Yes, ${status_name} it!`, 'No, Revert it!').then(function (response) {
            if (response['isConfirmed']) {
                let url = element.attr('target-url');
                let ajax = ajax_call('POST', url, { 'is_active' : is_active });
                ajax.done(function (response) {
                    hide_loader();
                    if (response['FLAG']) {
                        toastr.success(response['MESSAGE'], 'Success');
                    }
                    else {
                        toastr.error(response['MESSAGE'], 'Error');
                    }
                });
            }
            else {
                element.prop('checked', !is_active);
            }
        });
    });
});

// add and remove faq form elements dynamically
$(document).on('click', '.add_faq', function () {

        // Finding total number of elements added
        var total_element = $(".element").length;

        // last <div> with element class id
        var lastid = $(".element:last").attr("id");
        var split_id = lastid.split("_");
        var nextindex = Number(split_id[1]) + 1;
            // Adding new div container after last occurance of element class
            $(".element:last").after("<div class='element' id='div_"+ nextindex +"'></div>");

            // Adding element to <div>
            $("#div_" + nextindex).append('<hr><div class="col-lg-12 fv-row mb-7">'+
			'<label class="fw-bold fs-6 mb-2">Question</label>'+
			'<input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="questions[]" value=""/></div>'+
			'<div class="col-lg-12 fv-row mb-7">'+
			'<label class="fw-bold fs-6 mb-2">Answer</label>'+
	        '<textarea name="answers[]" class="form-control cms_description" id="editor_'+nextindex+'"></textarea></div><input type="button" value="remove" id="remove_'+nextindex+'" class="remove_faq" />');
			addMultipleEditor();

});
    // Remove faq element
	$(document).on('click', '.container .remove_faq', function () {
		if(confirm('Are you sure you want to delete this element?')) {
			var id = this.id;
			var split_id = id.split("_");
			var deleteindex = split_id[1];
			// Remove <div> with id
			$("#div_" + deleteindex).remove();
		}

    });

function addMultipleEditor()
{

        $('.cms_description').each(function(e){
            CKEDITOR.replace(this.id, {
                uiColor: '#EFF3F3',
                editorplaceholder: 'Start typing here..',
                height: '150px',
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
			$(this).removeClass('cms_description');
        });

}
