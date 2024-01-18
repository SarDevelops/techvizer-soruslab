"use strict";

$(document).ready(function () {
	$('.logout-form').on('click', function () {
		$('#logout-form').trigger('submit');
	});

});

$("#kt_daterangepicker_1").daterangepicker({
	defaultDate: null,
	autoApply: true,
	maxDate: new Date()
});

if ($('#admin_activity_log_table').length) {
	var activity_table_table = $('#admin_activity_log_table').DataTable({
		info: false,
		responsive: true,
		processing: false,
		serverSide: true,
		searching: true,
		lengthChange: false,
		ajax: {
			url: activity_log_route,
			data: function (data) {
				data.date_range = $('#kt_daterangepicker_1').val();
				data.user_id = $('.filter-by-user').val();
			},
			beforeSend: function (request) {
				show_loader();
				request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
			},
		},
		columns: [{
				data: 'Activity',
				name: 'Activity',
				searchable: true,
				orderable: true
			},
			{
				data: 'Description',
				name: 'Description',
				searchable: true,
				orderable: true
			},
			{
				data: 'Logged_by',
				name: 'Logged_by'
			},
			{
				data: 'date',
				name: 'date'
			},


		],
		order: [
			[3, 'desc']
		],
		drawCallback: function (settings) {
			hide_loader();
			// $('td:first-child input[type="checkbox"], th:first-child input[type="checkbox"]').prop('checked', false).trigger('change');
		}
	});
}
$('.filter-by-user').select2({
	placeholder: 'Select an option'
});
$(document).on('keyup', '[data-kt-activity-log-table-filter="search"]', delay(function (event) {
	activity_table_table.search(event.target.value).draw();
}, 500));

$(document).on('click', '.applyBtn', function () {
	activity_table_table.ajax.reload();
});

$(document).on('click', '.cancelBtn', function (event) {
	event.preventDefault();
	$('#kt_daterangepicker_1').val('');
	$('.filter-by-user').val('').trigger('change');
	activity_table_table.ajax.reload();
});
$(document).on('click', '#reload-table', function () {
	activity_table_table.ajax.reload();
});

$(document).ready(function () {
	/* --- Start --- || spark: SAR || PC: c149 || Date: 07-12-23    */
	$(document).on('click', '.filter_products', function () {
		let id 			= $(this).attr('data-id');
		let filter_name = $(this).attr('data-filter_name');
		let type 		= $(this).attr('data-type');
		let url 		= product_filter_listing_route + '?type='+type+'&'+ 'filter_id' + '=' + id+'&'+ 'filter_name' + '=' + btoa(filter_name)+'&';
		window.location.href = url;
	});

	


	/* --- End --- || spark: SAR || PC: c149 || Date: 07-12-23    */
});
// var minDate, maxDate;
// // Custom filtering function which will search data in column four between two values
// $.fn.dataTable.ext.search.push(
//     function( settings, data, dataIndex ) {
//         var min = minDate.val();
//         var max = maxDate.val();
//         var date = new Date( data[4] );

//         if (
//             ( min === null && max === null ) ||
//             ( min === null && date <= max ) ||
//             ( min <= date   && max === null ) ||
//             ( min <= date   && date <= max )
//         ) {
//             return true;
//         }
//         return false;
//     }
// );

// $(document).ready(function() {
//     // Create date inputs
//     minDate = new DateTime($('#min'), {
//         format: 'MMMM Do YYYY'
//     });
//     maxDate = new DateTime($('#max'), {
//         format: 'MMMM Do YYYY'
//     });

//     // DataTables initialisation

//     // Refilter the table
//     $('#min, #max').on('change', function () {
//         activity_table_table.draw();
//     });
// });
