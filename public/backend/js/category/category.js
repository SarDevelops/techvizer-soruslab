$(document).ready(function () {
	if ($("#kt_table_category").length) {
		var category_table = $("#kt_table_category").DataTable({
			info: true,
			pageLength: 10,
			responsive: true,
			processing: true,
			serverSide: true,
			searching: true,
			lengthChange: true,
			lengthMenu: [10, 20, 50, 100, 150, 200, 250],
			dom: '<"main-div"<"dt-top"li><p>>t<"main-div"<"dt-top"li><p>>',
			order: [[0, "desc"]],
			ajax: {
				url: category_listing_route,
				data: function (data) {
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
				{
					data: "id",
					name: "id",
					searchable: false,
					visible: false,
				},
				{
					data: "checkbox",
					name: "checkbox",
					searchable: false,
					orderable: false,
				},
				{
					data: "name",
					name: "name",
				},
				{
					data: "slug",
					name: "slug",
				},
				{
					data: "type",
					name: "type",
				},
				{
					data: "parent_category_id",
					name: "parent_category_id",
				},
				{
					data: "is_active",
					name: "is_active",
				},
				{
					data: "created_at",
					name: "created_at",
				},
				{
					data: "action",
					name: "action",
					orderable: false,
					searchable: false,
				},
			],
			drawCallback: function (settings) {
				hide_loader();
				$('td:first-child input[type="checkbox"], th:first-child input[type="checkbox"]').prop("checked", false).trigger("change");
			},
		});
	}

	// Show add edit category form
	$(document).on("click", ".open-category-form", function () {
		show_loader();
		let method = "GET";
		let url = $(this).attr("target-url");
		let heading = $(this).attr("target-header");
		let ajax = formdata_ajax_call(method, url);

		ajax.done(function (response) {
			hide_loader();
			$(".submit-btn").prop("disabled", false);
			if (response["FLAG"]) {
				action_drawer({
					heading: heading,
				});
				$("#action-drawer-body").html(response["DATA"]["view"]);
			} else {
				category_table.ajax.reload();
				toastr.error(response["MESSAGE"]);
			}
		});
	});

	$(document).on("change", "#category_form", function () {
		$("#category_form").valid();
	});
	// Add & Edit the category detail
	$(document).on("submit", "#category_form", function (event) {
		event.preventDefault();

		show_loader();
		$(".submit-btn").prop("disabled", true);
		let category_form = $(this);
		let method = category_form.attr("method");
		let url = category_form.attr("action");
		let data = new FormData($(category_form)[0]);

		let ajax = formdata_ajax_call(method, url, data);
		ajax.done(function (response) {
			hide_loader();
			$(".submit-btn").prop("disabled", false);
			if (response["FLAG"]) {
				$("#reset-filter").click();
				action_drawer();
				setTimeout(() => {
					category_table.ajax.reload();
				}, 1000);
				toastr.success(response["MESSAGE"], "Success");
			} else {
				category_table.ajax.reload();
				toastr.error(response["MESSAGE"], "Error");
			}
		});
		ajax.fail(function (response) {
		});
	});

	// Delete the category detail
	$(document).on("click", ".delete-category", function (event) {
		event.preventDefault();
		let delete_element = $(this);

		delete_confirmation(
			"Are you sure you want to delete this category?"
		).then(function (response) {
			if (response["isConfirmed"]) {
				delete_categories(delete_element);
			}
		});
	});

	$(document).on(
		"keyup",
		'[data-kt-category-table-filter="search"]',
		delay(function (event) {
			category_table.search(event.target.value).draw();
		}, 500)
	);

	$(document).on("click", "#reset-filter", function () {
		$("#role-filter").val("").trigger("change");
		$("#status-filter").val("").trigger("change");
		category_table.ajax.reload();
	});

	$(document).on("click", "#submit-filter", function () {
		category_table.ajax.reload();
		$(".menu-sub-dropdown").removeClass("show");
	});

	$(document).on("click", "#reload-table", function () {
		category_table.ajax.reload();
	});

	// $(document).on("change", "#type", function () {
	// 	if ($(this).val() == 'jewelry') {
	// 		$('#role optgroup #list_diamond').hide();
	// 		// $("#list_jewelry").addClass("show");
	// 		// $("#list_diamond").removeClass("show");
	// 	}else{
	// 		// $("#list_diamond").addClass("show");
	// 		// $("#list_jewelry").removeClass("show");
	// 	}
	// });

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
				$('[data-kt-category-table-select="selected_count"]').text(
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
		'[data-kt-category-table-select="delete_selected"]',
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
				delete_confirmation(
					"Are you sure you want to delete this category?"
				).then(function (response) {
					if (response["isConfirmed"]) {
						delete_categories(delete_element, selected_ids);
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
			`Are you sure you want to ${status_name} the category?`,
			`Yes, ${status_name} it!`,
			"No, Revert it!"
		).then(function (response) {
			if (response["isConfirmed"]) {
				let url = element.attr("target-url");
				let ajax = ajax_call("POST", url, {
					is_active: is_active,
				});
				ajax.done(function (response) {
					hide_loader();
					if (response["FLAG"]) {
						category_table.ajax.reload();
						toastr.success(response["MESSAGE"], "Success");
					} else {
						toastr.error(response["MESSAGE"], "Error");
					}
				}).fail(function(response) {
					// This function will be called if the AJAX request fails
					category_table.ajax.reload();
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

	function delete_categories(element, selected_ids = []) {
		let method = "DELETE";
		let url = element.attr("target-url");
		let ajax = ajax_call(method, url, {
			selected_ids: selected_ids,
		});
		ajax.done(function (response) {
			hide_loader();
			if (response["FLAG"]) {
				category_table.ajax.reload();
				toastr.success(response["MESSAGE"], "Success");
			} else {
				category_table.ajax.reload();
				toastr.error(response["MESSAGE"], "Error");
			}
		});
	}
});
