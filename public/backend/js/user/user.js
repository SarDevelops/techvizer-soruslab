$(document).ready(function () {
	if ($("#kt_table_users").length) {
		var user_table = $("#kt_table_users").DataTable({
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
				url: user_listing_route,
				data: function (data) {
					data.role_id = $("#role-filter").val();
					data.is_active = $("#status-filter").val();
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
				{ data: "id", name: "id", searchable: false, visible: false },
				{
					data: "checkbox",
					name: "checkbox",
					searchable: false,
					orderable: false,
				},
				{
					data: "profile",
					name: "profile",
					searchable: false,
					orderable: false,
				},
				{ data: "first_name", name: "first_name" },
				{ data: "last_name", name: "last_name" },
				{ data: "email", name: "email" },
				{ data: "role", name: "role" },
				{ data: "is_active", name: "is_active" },
				{ data: "created_at", name: "created_at" },
				{
					data: "action",
					name: "action",
					orderable: false,
					searchable: false,
				},
			],
			drawCallback: function (settings) {
				hide_loader();
				$(
					'td:first-child input[type="checkbox"], th:first-child input[type="checkbox"]'
				)
					.prop("checked", false)
					.trigger("change");
			},
		});
	}

	function changeMetaTitle(newTitle) {
		$("head title").text(newTitle);
	}

	// Show add edit user form
	$(document).on("click", ".open-user-form", function () {

		show_loader();
		let method = "GET";
		let url = $(this).attr("target-url");
		let heading = $(this).attr("target-header");
		let ajax = formdata_ajax_call(method, url);

		ajax.done(function (response) {
			hide_loader();
			$(".submit-btn").prop("disabled", false);
			if (response["FLAG"]) {
				action_drawer({ heading: heading });
				$("#action-drawer-body").html(response["DATA"]["view"]);
				$("body").css("overflow", "hidden");
				// changeMetaTitle(heading);
			} else {
				toastr.error(response["MESSAGE"]);
			}
		});
	});
	$(document).on("click", "#kt_app_body", function () {
		event.stopPropagation();
		$("body").css("overflow", "auto");
	});

	$(document).on("change", "#user_form", function () {
		$("#user_form").valid();
	});

	// Add & Edit the user detail
	$(document).on("submit", "#user_form", function (event) {
		event.preventDefault();

		show_loader();
		$(".submit-btn").prop("disabled", true);

		let user_form = $(this);
		let method = user_form.attr("method");
		let url = user_form.attr("action");
		let data = new FormData($(user_form)[0]);

		let ajax = formdata_ajax_call(method, url, data);
		ajax.done(function (response) {
			hide_loader();
			$(".submit-btn").prop("disabled", false);
			if (response["FLAG"]) {
				$("#reset-filter").click();
				action_drawer();
				setTimeout(() => {
					user_table.ajax.reload(null, false);
				}, 1000);
				toastr.success(response["MESSAGE"], "Success");
			} else {
				toastr.error(response["MESSAGE"], "Error");
			}
		});
	});

	// Delete the user detail
	$(document).on("click", ".delete-user", function (event) {
		event.preventDefault();
		let delete_element = $(this);

		delete_confirmation().then(function (response) {
			if (response["isConfirmed"]) {
				delete_users(delete_element);
			}
		}); 
	});

	$(document).on(
		"keyup",
		'[data-kt-user-table-filter="search"]',
		delay(function (event) {
			user_table.search(event.target.value).draw();
		}, 500)
	);

	$(document).on("click", "#reset-filter", function () {
		$("#role-filter").val("").trigger("change");
		$("#status-filter").val("").trigger("change");
		user_table.ajax.reload();
	});

	$(document).on("click", "#submit-filter", function () {
		user_table.ajax.reload();
		$(".menu-sub-dropdown").removeClass("show");
	});

	$(document).on("click", "#reload-table", function () {
		user_table.ajax.reload();
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
				$('[data-kt-user-table-select="selected_count"]').text(
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
		'[data-kt-user-table-select="delete_selected"]',
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
				delete_confirmation().then(function (response) {
					if (response["isConfirmed"]) {
						delete_users(delete_element, selected_ids);
					}
				});
			}
		}
	);

	$(document).on("change", ".is_active", function () {
		let is_active = $(this).is(":checked") ? 1 : 0;
		let element = $(this);
		let status_name = is_active ? "activate" : "deactivate";

		delete_confirmation(
			`Are you sure you want to ${status_name} the user?`,
			`Yes, ${status_name} it!`,
			"No, Revert it!"
		).then(function (response) {
			if (response["isConfirmed"]) {
				let url = element.attr("target-url");
				let ajax = ajax_call("POST", url, { is_active: is_active });
				ajax.done(function (response) {
					hide_loader();
					if (response["FLAG"]) {
						user_table.ajax.reload();
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

	// While all child checkboxes checked-unched, SelectAll checkbox automatically checked-unchecked
	$(document).on(
		"change",
		'td:first-child input[type="checkbox"]',
		function () {
			let checked_checkboxes_count = $(
				'tbody td:first-child input[type="checkbox"]:checked'
			).length;
			let actual_checkboxes_count = $(
				'tbody td:first-child input[type="checkbox"]'
			).length;
			$('th:first-child input[type="checkbox"]').prop(
				"checked",
				actual_checkboxes_count == checked_checkboxes_count
			);
		}
	);

	function delete_users(element, selected_ids = []) {
		let method = "DELETE";
		let url = element.attr("target-url");
		let ajax = ajax_call(method, url, { selected_ids: selected_ids });
		ajax.done(function (response) {
			hide_loader();
			if (response["FLAG"]) {
				user_table.ajax.reload();
				toastr.success(response["MESSAGE"], "Success");
			} else {
				toastr.error(response["MESSAGE"], "Error");
			}
		});
	}
});
