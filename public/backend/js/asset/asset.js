$(document).ready(function () {
	if ($('#kt_table_assets').length) {
		var asset_table = $('#kt_table_assets').DataTable({
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
				url: asset_listing_route,
			},
			columns: [{
					data: 'checkbox',
					name: 'checkbox',
					searchable: false,
					orderable: false
				},
				{
					data: 'asset_code',
					name: 'asset_code'
				},
				{
					data: 'name',
					name: 'name'
				},
				{
					data: 'supplier',
					name: 'supplier'
				},
				{
					data: 'qty',
					name: 'qty'
				},
				{
					data: 'price',
					name: 'price'
				},
				{
					data: 'serial_no',
					name: 'serial_no'
				},
				{
					data: 'calibration_date',
					name: 'calibration_date'
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

	// Show add edit asset form
	$(document).on('click', '.open-asset-form', function (event) {
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

	// Add & Edit the asset detail
	$(document).on('submit', '#asset_form', function (event) {
		event.preventDefault();
		// show_loader();
		$('.submit-btn').prop('disabled', true);
		let asset_form = $(this);
		let method = asset_form.attr('method');
		let url = asset_form.attr('action');
		let data = new FormData($(asset_form)[0]);

		let ajax = formdata_ajax_call(method, url, data);
		ajax.done(function (response) {
			hide_loader();
			$('.submit-btn').prop('disabled', false);
			if (response['FLAG']) {
				asset_table.ajax.reload();
				action_drawer();
				toastr.success(response['MESSAGE'], 'Success');
			} else {
				toastr.error(response['MESSAGE'], 'Oh snap!');
			}
		});
	});

	$(document).on("click", "input.asset_status", function (event) {
		event.preventDefault();
		let asset_id = $(this).data("id");
		let url = $(this).attr('target-url');
		let checked = 0;
		let status = 'deactivate';
		if ($(this).is(":checked")) {
			checked = 1;
			status = 'activate';
		}
		let data = {
			'asset_id': asset_id,
			'is_active': checked
		};
		delete_confirmation(`Are you sure you want to ${status} the asset?`, `Yes, ${status}!`).then(function (response) {
			if (response['isConfirmed']) {
				let method = 'POST';
				let ajax = ajax_call(method, url, data);
				ajax.done(function (response) {
					hide_loader();
					if (response['FLAG']) {
						asset_table.ajax.reload();
						toastr.success(response['MESSAGE'], 'Success');
					} else {
						toastr.error(response['MESSAGE'], 'Oh snap!');
					}
				});
			}
		});
	})

	// Delete the asset detail
	$(document).on('click', '.delete-asset', function (event) {
		event.preventDefault();
		let delete_element = $(this);

		delete_confirmation('Are you sure you want to delete this asset?').then(function (response) {
			if (response['isConfirmed']) {
				let method = 'DELETE';
				let url = delete_element.attr('target-url');

				let ajax = ajax_call(method, url);
				ajax.done(function (response) {
					hide_loader();
					if (response['FLAG']) {
						asset_table.ajax.reload();
						toastr.success(response['MESSAGE'], 'Success');
					} else {
						toastr.error(response['MESSAGE'], 'Oh snap!');
					}
				});
			}
		});
	});

	$(document).on('keyup', '[data-kt-asset-table-filter="search"]', delay(function (event) {
		asset_table.search(event.target.value).draw();
	}, 500));
});
