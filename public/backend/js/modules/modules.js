// console.log(modules_listing_route)
$(document).ready(function () {
    if ($('#admin_modules_table').length) {
        var admin_modules_table = $('#admin_modules_table').DataTable({
            info: false,
            responsive: true,
            processing: false,
            serverSide: true,
            searching:true,
            lengthChange: false,
            ajax: {
                url: modules_listing_route,
                data: function ( data ) {
                    data.role_id = $('#role-filter').val()
                    data.is_active = $('#status-filter').val()
                },
                beforeSend: function (request) {
                  show_loader();
                  request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                },
            },
            columns: [
                { data: 'module_name', name: 'module_name' },
                { data: 'module_type', name: 'first_name' },
                { data: 'action', name: 'last_name' },
            ],
            drawCallback: function( settings ) {
                hide_loader();
                // $('td:first-child input[type="checkbox"], th:first-child input[type="checkbox"]').prop('checked', false).trigger('change');
            }
        });
    }

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

    $(document).on('click', '.delete-user', function (event) {
       event.preventDefault();
       let delete_element = $(this);

       delete_confirmation().then(function (response) {
            if (response['isConfirmed']) {
                delete_module(delete_element);
            }
       });
    });

    function delete_module(element, selected_ids = []) {
        let method = 'DELETE';
        let url = element.attr('target-url');
        let ajax = ajax_call(method, url, { selected_ids : selected_ids });
        ajax.done(function (response) {
            hide_loader();
            if (response['FLAG']) {
                role_permission_table.ajax.reload();
                toastr.success(response['MESSAGE'], 'Success');
                location.reload();
            }
            else {
                toastr.error(response['MESSAGE'], 'Error');
            }
        });
    }
});
