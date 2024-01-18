$(document).ready(function () {
    if ($('#kt_table_vendors').length) {
        vendor_table = $('#kt_table_vendors').DataTable({
            info: false,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100, 150, 200, 250],
            responsive: true,
            processing: false,
            serverSide: true,
            searching: true,
            lengthChange: true,
            info: true,
            dom: '<"main-div"<"dt-top"li><p>>t<"main-div"<"dt-top"li><p>>',
            order: [[0, 'desc']],
            ajax: {
                url: vendor_listing_route,
                data: function (data) {
                    data.is_active = $('#status-filter').val()
                },
                beforeSend: function (request) {
                    show_loader();
                    request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                },
            },
            columns: [
                { data: 'id', name: 'id', searchable: false, visible: false },
                { data: 'checkbox', name: 'checkbox', searchable: false, orderable: false },
                { data: 'profile', name: 'profile', searchable: false, orderable: false },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'email', name: 'email' },
                { data: 'is_active', name: 'is_active', searchable: false, orderable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            drawCallback: function (settings) {
                tooltip_initialize();
                hide_loader();
                $('td:first-child input[type="checkbox"], th:first-child input[type="checkbox"]').prop('checked', false).trigger('change');
            }
        });
    }

    $(document).on('click', '.open-vendor-form', function () {
        show_loader();
        let method = 'GET';
        let url = $(this).attr('target-url');
        let heading = $(this).attr('target-header');
        let ajax = formdata_ajax_call(method, url);
        ajax.done(function (response) {
            hide_loader();
            $('.submit-btn').prop('disabled', false);
            if (response['FLAG'] == true) {
                action_drawer({ heading: heading })
                $('#action-drawer-body').html(response['DATA']['view']);
                tooltip_initialize();
            }
            else {
                toastr.error(response['MESSAGE']);
            }
        });
    });

    // Add/Edit the vendor details
    $(document).on('submit', '#vendor_form', function (event) {
        event.preventDefault();
        let vendor_form = $(this);
        let method = vendor_form.attr('method');
        let url = vendor_form.attr('action');
        let data = new FormData($(vendor_form)[0]);

        let ajax = formdata_ajax_call(method, url, data, '#vendor_form_submit');
        ajax.done(function (response) {
            hide_loader();
            $('.submit-btn').prop('disabled', false);
            if (response['FLAG']) {
				$('#reset-filter').click();
                action_drawer();
				setTimeout(() => {
					vendor_table.ajax.reload();
				}, 1000);
                toastr.success(response['MESSAGE'], 'Success');
            }
            else {
                toastr.error(response['MESSAGE'], 'Error');
            }
        });
    });

    $(document).on('click', '.delete-vendor', function (event) {
        event.preventDefault();
        let delete_element = $(this);

        delete_confirmation('Are you sure you want to delete this vendor?').then(function (response) {
            if (response['isConfirmed']) {
                delete_vendor(delete_element);
            }
        });
    });

    $(document).on('keyup', '[data-kt-vendor-table-filter="search"]', delay(function (event) {
        vendor_table.search(event.target.value).draw();
    }, 500));

    $(document).on('click', '#reset-filter', function () {
        $('#status-filter').val('').trigger('change');
        vendor_table.ajax.reload();
    });

    $(document).on('click', '#submit-filter', function () {
        vendor_table.ajax.reload();
		$('.menu-sub-dropdown').removeClass('show');
    });

    $(document).on('click', '#reload-table', function () {
        vendor_table.ajax.reload();
    });

    // Datatable Select all checkbox
    $(document).on('change', 'td:first-child input[type="checkbox"], th:first-child input[type="checkbox"]', function () {
        let checkboxes_count = $('tbody td:first-child input[type="checkbox"]:checked').length;
        if (checkboxes_count > 0) {
            $('.table-action-buttons').addClass('d-none');
            $('.delete-all-button-div').removeClass('d-none');
            $('[data-kt-vendor-table-select="selected_count"]').text(checkboxes_count);
        }
        else {
            $('.table-action-buttons').removeClass('d-none');
            $('.delete-all-button-div').addClass('d-none');
        }
    });

    $(document).on('click', '[data-kt-vendor-table-select="delete_selected"]', function () {
        let selected_ids = Array.from(document.querySelectorAll('tbody td:first-child input[type="checkbox"]'))
            .filter((checkbox) => checkbox.checked)
            .map((checkbox) => checkbox.value);

        if (selected_ids.length) {
            let delete_element = $(this);
            delete_confirmation('Are you sure you want to delete these vendors?').then(function (response) {
                if (response['isConfirmed']) {
                    delete_vendor(delete_element, selected_ids);
                }
            });
        }
    });

    $(document).on('change', '.is_active', function () {
        let is_active = ($(this).is(':checked')) ? 1 : 0;
        let element = $(this);
        let status_name = (is_active) ? 'activate' : 'deactivate';

        delete_confirmation(`Are you sure you want to ${status_name} the vendor ?`, `Yes, ${status_name} it!`, 'No, Revert it!').then(function (response) {
            if (response['isConfirmed']) {
                let url = element.attr('target-url');
                let ajax = ajax_call('POST', url, { 'is_active': is_active });
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

    function delete_vendor(element, selected_ids = []) {
        let method = 'DELETE';
        let url = element.attr('target-url');
        let ajax = ajax_call(method, url, { selected_ids: selected_ids });
        ajax.done(function (response) {
            hide_loader();
            if (response['FLAG']) {
                vendor_table.ajax.reload();
                toastr.success(response['MESSAGE'], 'Success');
            }
            else {
                toastr.error(response['MESSAGE'], 'Error');
            }
        });
    }

    $(document).on('click', '#random_password', function (event) {
        event.preventDefault();
        let random_password;
        random_password = generateRandomPassword();
        $("#password").val(random_password);
        $("#password_confirmation").val(random_password);
    });
});
