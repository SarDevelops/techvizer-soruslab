$(document).ready(function () {
    if ($('#kt_table_services').length) {
        var service_table = $('#kt_table_services').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            destroy: true,
            pageLength: 5,
            searching: true,
            filter: true,
            stateSave: false,
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
            info: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                url: service_listing_route,
                // data: function ( data ) {
                //  let selected_client = $('.list_client_name').val();
                //  if (selected_client) {
                //      data.client_id = selected_client;
                //  }
                //          },
                // error: function (xhr, error, code)
                //          {
                //           // setTimeout(() => {
                //           //  hide_loader();
                //           //  $('.datatable').DataTable().ajax.reload();
                //           // }, 2000);
                //          },
                //          beforeSend: function (request) {
                //           show_loader();
                //  request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                //  request.setRequestHeader('Authorization');
                //          },
            },
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'parent_service',
                    name: 'parent_service'
                },
                {
                    data: 'is_active',
                    name: 'is_active',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            drawCallback: function (settings) {
                KTMenu.createInstances();
            }
        });
    }

    // Show add edit service form
    $(document).on('click', '.open-service-form', function (event) {
        event.preventDefault();
        show_loader();
        let method = 'GET';
        let url = $(this).attr('target-url');
        let heading = $(this).attr('target-header');
        let ajax = formdata_ajax_call(method, url);

        ajax.done(function (response) {
            hide_loader();
            $('.submit-btn').prop('disabled', false);
            if (response['FLAG']) {
                action_drawer({
                    heading: heading
                })
                $('#action-drawer-body').empty().html(response['DATA']['view']);
            } else {
                toastr.error(response['MESSAGE'], 'Oh snap!');
            }
        });

    });

    // Add & Edit the service detail
    $(document).on('submit', '#service_form', function (event) {
        event.preventDefault();
        // show_loader();
        $('.submit-btn').prop('disabled', true);
        let service_form = $(this);
        let method = service_form.attr('method');
        let url = service_form.attr('action');
        let data = new FormData($(service_form)[0]);

        let ajax = formdata_ajax_call(method, url, data);
        ajax.done(function (response) {
            hide_loader();
            $('.submit-btn').prop('disabled', false);
            if (response['FLAG']) {
                service_table.ajax.reload();
                action_drawer();
                toastr.success(response['MESSAGE'], 'Success');
            } else {
                toastr.error(response['MESSAGE'], 'Oh snap!');
            }
        });
    });

    $(document).on("click", "input.service_status", function (event) {
        event.preventDefault();
        let service_id = $(this).data("id");
        let url = $(this).attr('target-url');
        let checked = 0;
        let status = 'deactivate';
        if ($(this).is(":checked")) {
            checked = 1;
            status = 'activate';
        }
        let data = {
            'service_id': service_id,
            'is_active': checked
        };
        delete_confirmation(`Are you sure you want to ${status} the service?`, `Yes, ${status}!`).then(function (response) {
            if (response['isConfirmed']) {
                let method = 'POST';
                let ajax = ajax_call(method, url, data);
                ajax.done(function (response) {
                    hide_loader();
                    if (response['FLAG']) {
                        service_table.ajax.reload();
                        toastr.success(response['MESSAGE'], 'Success');
                    } else {
                        toastr.error(response['MESSAGE'], 'Oh snap!');
                    }
                });
            }
        });
    })

    // Delete the service detail
    $(document).on('click', '.delete-service', function (event) {
        event.preventDefault();
        let delete_element = $(this);

        delete_confirmation('Are you sure you want to delete this service?').then(function (response) {
            if (response['isConfirmed']) {
                let method = 'DELETE';
                let url = delete_element.attr('target-url');

                let ajax = ajax_call(method, url);
                ajax.done(function (response) {
                    hide_loader();
                    if (response['FLAG']) {
                        service_table.ajax.reload();
                        toastr.success(response['MESSAGE'], 'Success');
                    } else {
                        toastr.error(response['MESSAGE'], 'Oh snap!');
                    }
                });
            }
        });
    });

    $(document).on('keyup', '[data-kt-service-table-filter="search"]', delay(function (event) {
        service_table.search(event.target.value).draw();
    }, 500));
});
