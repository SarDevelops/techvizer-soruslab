$(document).ready(function () {
    if ($('#kt_table_role_permission').length) {
        var role_permission_table = $('#kt_table_role_permission').DataTable({
            info: true,
            responsive: true,
            processing: true,
            serverSide: true,
            searching:true,
            lengthChange: true,
			pageLength: 10,
			lengthMenu: [10,20,50,100,150,200,250],
			dom: '<"main-div"<"dt-top"li><p>>t<"main-div"<"dt-top"li><p>>',
            ajax: {
                url: role_permission_listing_route,
                data: function ( data ) {
                    data.role_id = $('#role-filter').val();
                    data.is_active = $('#status-filter').val();
                },
                beforeSend: function (request) {
                  show_loader();
                  request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                },
            },
            columns: [
                { data: 'checkbox', name: 'checkbox', searchable: false, orderable: false },
                { data: 'role_name', name: 'role_name' },
                { data: 'permissions', name: 'permissions', searchable: false, orderable: false },
                { data: 'is_active', name: 'is_active', searchable: false, orderable: false  },
                { data: 'created_at', name: 'created_at' ,searchable: false, visible: false },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            order: [[4, 'desc']],
            drawCallback: function( settings ) {
                hide_loader();
                $('td:first-child input[type="checkbox"], th:first-child input[type="checkbox"]').prop('checked', false).trigger('change');
                KTMenu.createInstances();
            }
        });
    }

    // Show add edit user form
    $(document).on('click', '.open-user-form', function () {
        show_loader();
        let method = 'GET';
        let url = $(this).attr('target-url');
        let heading = $(this).attr('target-header');
        let ajax = formdata_ajax_call(method, url);

        ajax.done(function (response) {
            hide_loader();
            $('.submit-btn').prop('disabled', false);
            if (response['FLAG']) {
                action_drawer({heading : heading})
                $('#action-drawer-body').html(response['DATA']['view']);
            }
            else {
                toastr.error(response['MESSAGE'], 'Error');
            }
        });
    });

	$(document).on('change', '#role_permission_form', function () {
		$('#role_permission_form').valid();
	});

    // Add & Edit the user detail
    $(document).on('submit', '#role_permission_form', function (event) {
        event.preventDefault();
        /* add validation on role permission */
        var $fields = $(this).find('input[type="checkbox"]:checked');
        if (!$fields.length) {
            toastr.error("You must select at least one permission!");
            return false;
        }
        // show_loader();
        $('.submit-btn').prop('disabled', true);

        let role_permission_form = $(this);
        let method = role_permission_form.attr('method');
        let url = role_permission_form.attr('action');
        let data = new FormData($(role_permission_form)[0]);

        var permission_checkbox = role_permission_form.find(".modules-permission input[type=checkbox]");

        $.each(permission_checkbox, function(key, val) {
            data.append($(val).attr('name'), ($(this).is(':checked')) ? 1 : 0)
        });

        let ajax = formdata_ajax_call(method, url, data);
        ajax.done(function (response) {
            hide_loader();
            $('.submit-btn').prop('disabled', false);
            if (response['FLAG']) {
                role_permission_table.ajax.reload();
                action_drawer();
                toastr.success(response['MESSAGE']);
            }
            else {
                toastr.error(response['MESSAGE']);
            }
        });
    });

    // Delete the user detail
   $(document).on('click', '.delete-user', function (event) {
       event.preventDefault();
       let delete_element = $(this);

       delete_confirmation('Are you sure you want to delete this role?').then(function (response) {
            if (response['isConfirmed']) {
                delete_users(delete_element);
            }
       });
    });

    $(document).on('keyup', '[data-kt-user-table-filter="search"]', delay(function (event) {
        role_permission_table.search(event.target.value).draw();
    }, 500));

    $(document).on('click', '#reset-filter', function () {
        $('#role-filter').val('');
        $('#status-filter').val('').trigger('change');
        role_permission_table.ajax.reload();
    });

    $(document).on('click', '#submit-filter', function () {
        role_permission_table.ajax.reload();
		$('.menu-sub-dropdown').removeClass('show');
    });

    $(document).on('click', '#reload-table', function () {
       role_permission_table.ajax.reload();
    });

    // Datatable Select all checkbox
    $(document).on('change', 'td:first-child input[type="checkbox"], th:first-child input[type="checkbox"]', function () {
        let checkboxes_count = $('tbody td:first-child input[type="checkbox"]:checked').length;
        if (checkboxes_count > 0) {
            $('.table-action-buttons').addClass('d-none');
            $('.delete-all-button-div').removeClass('d-none');
            $('[data-kt-user-table-select="selected_count"]').text(checkboxes_count);
        }
        else {
            $('.table-action-buttons').removeClass('d-none');
            $('.delete-all-button-div').addClass('d-none');
        }
    });

    $(document).on('click', '[data-kt-user-table-select="delete_selected"]', function () {
        let selected_ids = Array.from(document.querySelectorAll('tbody td:first-child input[type="checkbox"]'))
            .filter((checkbox) => checkbox.checked)
            .map((checkbox) => checkbox.value);

        if (selected_ids.length) {
            let delete_element = $(this);
            delete_confirmation('Are you sure you want to delete this roles?').then(function (response) {
                if (response['isConfirmed']) {
                    delete_users(delete_element, selected_ids);
                }
            });
        }
    });

    $(document).on('change', '.is_active', function () {
        let is_active = ($(this).is(':checked')) ? 1 : 0;
        let element = $(this);
        let status_name = (is_active) ? 'activate' : 'deactivate';

        delete_confirmation(`Are you sure you want to ${status_name} the role permission?`, `Yes, ${status_name} it!`, 'No, Revert it!').then(function (response) {
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

    function delete_users(element, selected_ids = []) {
        let method = 'DELETE';
        let url = element.attr('target-url');
        let ajax = ajax_call(method, url, { selected_ids : selected_ids });
        ajax.done(function (response) {
            hide_loader();
            if (response['FLAG']) {
                role_permission_table.ajax.reload();
                toastr.success(response['MESSAGE'], 'Success');
            }
            else {
                toastr.error(response['MESSAGE'], 'Error');
            }
        });
    }

    // If given admin permission then select all the permissions
    $('body').on('click', '#kt_roles_select_all[type="checkbox"]', function (event) {
		if ($(this).prop('checked') == true) {
			console.log($(this).parent('.form-check').find('.form-check-label').text('Deselect All Permissions'),'text' );
		}else{
			console.log($(this).parent('.form-check').find('.form-check-label').text('Select all text'));
		}

		console.log($('.modules-permission input[type="checkbox"]').prop('checked', $('#kt_roles_select_all[type="checkbox"]').is(':checked')));
        $('.modules-permission input[type="checkbox"]').prop('checked', $('#kt_roles_select_all[type="checkbox"]').is(':checked'));
    });

    // If given selected all the permission then it will consider as admin
    $('body').on('click', '.modules-permission input[type="checkbox"]', function (event) {
        check_all_permission_exist();
    });


    function check_all_permission_exist() {
       $('#kt_roles_select_all[type="checkbox"]').prop('checked', $('.modules-permission input[type="checkbox"]:checked').length == $('.modules-permission input[type="checkbox"]').length);
    }

});
