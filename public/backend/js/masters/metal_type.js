$(document).ready(function () {
	if ($('#kt_table_metal_type').length) {
		var metal_type_table = $('#kt_table_metal_type').DataTable({
			info: true,
			pageLength: 10,
			rowReorder: {
				selector: 'tr'
			},
			responsive: true,
			processing: true,
			serverSide: true,
			searching: true,
			lengthChange: true,
			lengthMenu: [10,20,50,100,200,150,250],
			dom: '<"main-div"<"dt-top"li><p>>t<"main-div"<"dt-top"li><p>>',
			order: [
				[0, 'desc']
			],
			ajax: {
				url: metal_type_listing_route,
				data: function (data) {
					data.is_active = $('#status-filter').val()
				},
				beforeSend: function (request) {
					show_loader();
					request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
				},
			},
			columns: [{
					data: 'id',
					name: 'id',
					searchable: false,
					visible: false,
				},
				{
					data: 'checkbox',
					name: 'checkbox',
					searchable: false,
					orderable: false
				},
				// {
				// 	data: 'image',
				// 	name: 'image',
				// 	searchable: false,
				// 	orderable: false
				// },
				{
					data: 'type',
					name: 'type'
				},
				{
					data: 'name',
					name: 'name'
				},
				{
					data: "jewelry_counts",
					name: "jewelry_counts",
				},
				{
					data: 'is_active',
					name: 'is_active'
				},
				{
					data: 'created_at',
					name: 'created_at'
				},
				{
					data: 'action',
					name: 'action',
					orderable: false,
					searchable: false
				},
			],
			drawCallback: function (settings) {
				hide_loader();
				$('td:first-child input[type="checkbox"], th:first-child input[type="checkbox"]').prop('checked', false).trigger('change');
			}
		});
	}

	// Show add edit shape form
	$(document).on('click', '.open-metal-type-form', function () {
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
				$('#action-drawer-body').html(response['DATA']['view']);
			} else {
				toastr.error(response['MESSAGE']);
			}
		});
	});

	$(document).on('change', '#metal_type_form', function () {
		$('#metal_type_form').valid();
	});

	// Add & Edit the metal_type detail
	$(document).on('submit', '#metal_type_form', function (event) {
		event.preventDefault();

		show_loader();
		$('.submit-btn').prop('disabled', true);
		let metal_type_form = $(this);
		let method = metal_type_form.attr('method');
		let url = metal_type_form.attr('action');
		let data = new FormData($(metal_type_form)[0]);

		let ajax = formdata_ajax_call(method, url, data);
		ajax.done(function (response) {
			hide_loader();
			$('.submit-btn').prop('disabled', false);
			if (response['FLAG']) {
				$('#reset-filter').click();
                action_drawer();
				setTimeout(() => {
					metal_type_table.ajax.reload();
				}, 1000);
				toastr.success(response['MESSAGE'], 'Success');
			} else {
				toastr.error(response['MESSAGE'], 'Error');
			}
		});
		ajax.fail(function (response) {
		});
	});

	// Delete the metal_type detail
	$(document).on('click', '.delete-metal-type', function (event) {
		event.preventDefault();
		let delete_element = $(this);

		delete_confirmation('Are you sure you want to delete this metal type?').then(function (response) {
			if (response['isConfirmed']) {
				delete_metal_type(delete_element);
			}
		});
	});

	$(document).on('keyup', '[data-kt-metal-type-table-filter="search"]', delay(function (event) {
		metal_type_table.search(event.target.value).draw();
	}, 500));

	$(document).on('click', '#reset-filter', function () {
		$('#role-filter').val('').trigger('change');
		$('#status-filter').val('').trigger('change');
		metal_type_table.ajax.reload();
	});

	$(document).on('click', '#submit-filter', function () {
		metal_type_table.ajax.reload();
		$('.menu-sub-dropdown').removeClass('show');
	});

	$(document).on('click', '#reload-table', function () {
		metal_type_table.ajax.reload();
	});

	// Datatable Select all checkbox
	$(document).on('change', 'td:first-child input[type="checkbox"], th:first-child input[type="checkbox"]', function () {
		let checkboxes_count = $('tbody td:first-child input[type="checkbox"]:checked').length;
		if (checkboxes_count > 0) {
			$('.table-action-buttons').addClass('d-none');
			$('.delete-all-button-div').removeClass('d-none');
			$('[data-kt-metal-type-table-select="selected_count"]').text(checkboxes_count);
		} else {
			$('.table-action-buttons').removeClass('d-none');
			$('.delete-all-button-div').addClass('d-none');
		}
	});

	$(document).on('click', '[data-kt-metal-type-table-select="delete_selected"]', function () {
		let selected_ids = Array.from(document.querySelectorAll('tbody td:first-child input[type="checkbox"]'))
			.filter((checkbox) => checkbox.checked)
			.map((checkbox) => checkbox.value);

		if (selected_ids.length) {
			let delete_element = $(this);
			delete_confirmation('Are you sure you want to delete this metal type?').then(function (response) {
				if (response['isConfirmed']) {
					delete_metal_type(delete_element, selected_ids);
				}
			});
		}
	});

	$(document).on('change', '.is_active', function () {
		let is_active = ($(this).is(':checked')) ? 1 : 0;
		let element = $(this);
		let status_name = (is_active) ? 'activate' : 'deactivate';

		delete_confirmation(`Are you sure you want to ${status_name} the metal type?`, `Yes, ${status_name} it!`, 'No, Revert it!').then(function (response) {
			if (response['isConfirmed']) {
				let url = element.attr('target-url');
				let ajax = ajax_call('POST', url, {
					'is_active': is_active
				});
				ajax.done(function (response) {
					hide_loader();
					if (response['FLAG']) {
						toastr.success(response['MESSAGE'], 'Success');
					} else {
						toastr.error(response['MESSAGE'], 'Error');
					}
				});
			} else {
				element.prop('checked', !is_active);
			}
		});
	});

	// While all child checkboxes checked-unched, SelectAll checkbox automatically checked-unchecked
	$(document).on('change', 'td:first-child input[type="checkbox"]', function () {
		let checked_checkboxes_count = $('tbody td:first-child input[type="checkbox"]:checked').length;
		let actual_checkboxes_count = $('tbody td:first-child input[type="checkbox"]').length;
		$('th:first-child input[type="checkbox"]').prop('checked', actual_checkboxes_count == checked_checkboxes_count);
	});

	function delete_metal_type(element, selected_ids = []) {
		let method = 'DELETE';
		let url = element.attr('target-url');
		let ajax = ajax_call(method, url, {
			selected_ids: selected_ids
		});
		ajax.done(function (response) {
			hide_loader();
			if (response['FLAG']) {
				metal_type_table.ajax.reload();
				toastr.success(response['MESSAGE'], 'Success');
			} else {
				toastr.error(response['MESSAGE'], 'Error');
			}
		});
	}

});
