const delete_msg = `Are you sure you want to delete ?`;
$(document).ready(function () {
    if ($("#kt_table_tests").length) {
        var test_table = $("#kt_table_tests").DataTable({
            info: true,
			responsive: true,
			processing: true,
			serverSide: true,
			searching: true,
			lengthChange: true,
			stateSave: true,
			order: [[0, "desc"]],
			lengthMenu: [10, 20, 50, 100, 150, 200, 250],
			dom: '<"main-div"<"dt-top"li><p>>t<"main-div"<"dt-top"li><p>>',
			pageLength: 10,
            ajax: {
                url: tests_listing_route,
                data: function (data) {
                    // data.is_active = $('#status-filter').val()
                },
                beforeSend: function (request) {
                    show_loader();
                    request.setRequestHeader(
                        "X-CSRF-TOKEN",
                        $('meta[name="csrf-token"]').attr("content")
                    );
                },
            },

            columns: [
                {
                    data: "checkbox",
                    name: "checkbox",
                    searchable: false,
                    orderable: false,
                },
                { data: "name", name: "name" },
                { data: "type", name: "type" },
                { data: "recommended_for", name: "recommended_for" },
                { data: "overview", name: "overview" },
                { data: "cbc_test", name: "cbc_test" },
                { data: "created_at", name: "created_at" },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
            // order: [[7, 'desc']],
            drawCallback: function (settings) {
                hide_loader();
                var response = settings.json;
                // hide delete check boxes if false from serverside
                test_table.column(0).visible(response.is_delete_checkbox);
                $(
                    'td:first-child input[type="checkbox"], th:first-child input[type="checkbox"]'
                )
                    .prop("checked", false)
                    .trigger("change");
            },
        });
    }

    $(document).on(
        "keyup",
        '[data-kt-tests-table-filter="search"]',
        delay(function (event) {
            test_table.search(event.target.value).draw();
        }, 500)
    );
    $(document).on("click", "#reload-table", function () {
        test_table.ajax.reload();
    });

    // Show add edit test form
    $(document).on("click", ".open-test-form", function () {
        show_loader();
        let method = "GET";
        let url = $(this).attr("target-url");
        let heading = $(this).attr("target-header");
        let ajax = formdata_ajax_call(method, url);
        console.log(url, heading, method);
        ajax.done(function (response) {
            console.log("response", response);
            hide_loader();
            $(".submit-btn").prop("disabled", false);
            if (response["FLAG"]) {
                action_drawer({ heading: heading });
                $("#action-drawer-body").html(response["DATA"]["view"]);
            } else {
                toastr.error(response["MESSAGE"]);
            }
        });
    });

    $(document).on("click", "#kt_app_body", function () {
		event.stopPropagation();
		$("body").css("overflow", "auto");
	});


    $(document).on("change", "#test_form", function () {
		$("#test_form").valid();
	});
    // Add & Edit the test detail
    $(document).on("submit", "#test_form", function (event) {
        event.preventDefault();

        show_loader();
        $(".submit-btn").prop("disabled", true);

        let test_form = $(this);
        let method = test_form.attr("method");
        let url = test_form.attr("action");
        let data = new FormData($(test_form)[0]);

        let ajax = formdata_ajax_call(method, url, data);
        ajax.done(function (response) {
            console.log(response , 'response');
            hide_loader();
            $(".submit-btn").prop("disabled", false);
            if (response["FLAG"]) {
                test_table.ajax.reload();
                action_drawer();
                toastr.success(response["MESSAGE"], "Success");
            } else {
                toastr.error(response["MESSAGE"], "Error");
            }
        });
    });

    $(document).on("change", ".is_active", function () {
        let is_active = $(this).is(":checked") ? 1 : 0;
        let element = $(this);
        let status_name = is_active ? "activate" : "deactivate";

        delete_confirmation(
            `Are you sure you want to ${status_name} the test?`,
            `Yes, ${status_name} it!`,
            "No, Revert it!"
        ).then(function (response) {
            if (response["isConfirmed"]) {
                let url = element.attr("target-url");
                let ajax = ajax_call("POST", url, { is_active: is_active });
                ajax.done(function (response) {
                    hide_loader();
                    if (response["FLAG"]) {
                        toastr.success(response["MESSAGE"], "Success");
                    } else {
                        toastr.error(response["MESSAGE"], "Error");
                    }
                });
            } else {
                element.prop("checked", !is_active);
            }
        });
    });

    // Datatable Select all checkbox
    $(document).on(
        "change",
        'td:first-child input[type="checkbox"], th:first-child input[type="checkbox"]',
        function () {
            let checkboxes_count = $(
                'tbody td:first-child input[type="checkbox"]:checked'
            ).length;
            if (checkboxes_count > 0) {
                $(".table-action-buttons").addClass("d-none");
                $(".delete-all-button-div").removeClass("d-none");
                $('[data-kt-test-table-select="selected_count"]').text(
                    checkboxes_count
                );
            } else {
                $(".table-action-buttons").removeClass("d-none");
                $(".delete-all-button-div").addClass("d-none");
            }
        }
    );

    $(document).on(
        "click",
        '[data-kt-test-table-select="delete_selected"]',
        function () {
            let selected_ids = Array.from(
                document.querySelectorAll(
                    'tbody td:first-child input[type="checkbox"]'
                )
            )
                .filter((checkbox) => checkbox.checked)
                .map((checkbox) => checkbox.value);

            if (selected_ids.length) {
                let delete_element = $(this);
                delete_confirmation(delete_msg).then(function (response) {
                    if (response["isConfirmed"]) {
                        delete_record(delete_element, selected_ids);
                    }
                });
            }
        }
    );

    // Delete the record
    $(document).on("click", ".delete-record", function (event) {
        event.preventDefault();
        let delete_element = $(this);

        delete_confirmation(delete_msg).then(function (response) {
            if (response["isConfirmed"]) {
                delete_record(delete_element);
            }
        });
    });

    function delete_record(element, selected_ids = []) {
        let method = "DELETE";
        let url = element.attr("target-url");
        let ajax = ajax_call(method, url, { selected_ids: selected_ids });
        ajax.done(function (response) {
            hide_loader();
            if (response["FLAG"]) {
                test_table.ajax.reload();
                toastr.success(response["MESSAGE"], "Success");
            } else {
                toastr.error(response["MESSAGE"], "Error");
            }
        });
    }

    $(document).on("click", ".copy", function (e) {
        e.preventDefault();
        var placeholder_value = $(this).text();
        var prev_value = $("#meta_title").val();
        $("#meta_title").val(prev_value + placeholder_value);
    });
});
