$(document).ready(function () {
	$('.file-valid').change(function() {
		var fileName = $(this).val();
		var ext = fileName.split('.').pop().toLowerCase();
		if (ext === 'jfif') {
			toastr.error('Please select a valid file type (jpeg, jpg, png).');
			event.stopPropagation();
		}
	});


	$(document).on('change','#image_preview',function(){
		var imageElement = $("#myImage");
		var selectedFile = this.files[0];
		var this_preview = $(this);
		this_preview.parent('.section').find('.error-feedback').attr('hidden',true);
		if (selectedFile) {
			// Read the selected file as a data URL
			var reader = new FileReader();
			// $(this).parent('.section').find('.preview-image').attr('src',);
			reader.onload = function(e) {
				this_preview.parent('.section').find('.preview-image').attr('src',e.target.result);
			}
			reader.readAsDataURL(selectedFile); // Read the file as data URL
		} else {
		  // If no file is selected, hide the image preview
		  imagePreview.css("display", "none");
		}
		var preview = $(this).val();

	});

	$('#sectionOne').on('input', function() {
		$('.error-feedback').attr('hidden',true);
	});

	$('#sectionTwo').on('input', function() {
		$('.error-feedback').attr('hidden',true);
	});

	$('#sectionThree').on('input', function() {
		$('.error-feedback').attr('hidden',true);
	});
	$('#sectionFour').on('input', function() {
		$('.error-feedback').attr('hidden',true);
	});
	$('#sectionFive').on('input', function() {
		$('.error-feedback').attr('hidden',true);
	});
	$('#sectionSix').on('input', function() {
		$('.error-feedback').attr('hidden',true);
	});


	$('#section_one').on('click',function(e) {
		e.preventDefault();
		var formData = new FormData($('#sectionOne')[0]);
		var url = submit_action;
		$.ajax({
			type: 'POST',
			url: url,
			data: formData,
			contentType: false,
			processData: false,
			headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
            },
			success: function(response) {
				console.log('yes',response);
				if(response.errors){
					var errors = response.errors;
					displayErrors(errors);
					toastr.error('Please fill the form 1 first!',  'Error!');
				}else{
					toastr.success(response.message, 'Success!');
					setTimeout(() => {
						location.reload();
						$('#section_one').parents('.collapse').addClass('show')
					}, 2000);
				}
			},
			error: function(response) {
				var errors = response.responseJSON.errors;
				displayErrors(errors);
				toastr.error('Please fill the form 1 first!',  'Error!');
			}
		});
	});

	$('#section_two').on('click',function(e) {
		e.preventDefault();
		var formData = new FormData($('#sectionTwo')[0]);
		var url = submit_action;
		$.ajax({
			type: 'POST',
			url: url,
			data: formData,
			contentType: false,
			processData: false,
			headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
            },
			success: function(response) {
				console.log('yes',response);
				if(response.errors){
					var errors = response.errors;
					displayErrors(errors);
					toastr.error('Please fill the form 2 first!',  'Error!');
				}else{
				toastr.success(response.message, 'Success!');
					setTimeout(() => {
						location.reload();
						$('#section_two').parents('.collapse').addClass('show')
					}, 2000);
				}
			},
			error: function(response) {
				var errors = response.responseJSON.errors;
				displayErrors(errors);
				toastr.error('Please fill the form 2 first!',  'Error!');
			}
		});
	});

	$('#section_three').click(function(e) {
		e.preventDefault();
		var formData = new FormData($('#sectionThree')[0]);
		var url = submit_action;
		$.ajax({
			type: 'POST',
			url: url,
			data: formData,
			contentType: false,
			processData: false,
			headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
            },
			success: function(response) {
				console.log('yes',response);
				if(response.errors){
					var errors = response.errors;
					displayErrors(errors);
					toastr.error('Please fill the form 3 first!',  'Error!');
				}else{
				toastr.success(response.message, 'Success!');
					setTimeout(() => {
						location.reload();
						$('#section_three').parents('.collapse').addClass('show')
					}, 2000);
				}
			},
			error: function(response) {
				var errors = response.responseJSON.errors;
				displayErrors(errors);
				toastr.error('Please fill the form 3 first!',  'Error!');
			}
		});
	});

	$('#section_four').click(function(e) {
		e.preventDefault();
		var formData = new FormData($('#sectionFour')[0]);
		var url = submit_action;
		$.ajax({
			type: 'POST',
			url: url,
			data: formData,
			contentType: false,
			processData: false,
			headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
            },
			success: function(response) {
				if(response.errors){
					var errors = response.errors;
					displayErrors(errors);
					toastr.error('Please fill the form 4 first!',  'Error!');
				}else{
				toastr.success(response.message, 'Success!');
					setTimeout(() => {
						location.reload();
						$('#section_four').parents('.collapse').addClass('show')
					}, 2000);
				}
			},
			error: function(response) {
				var errors = response.responseJSON.errors;
				console.log('qqqq');
				displayErrors(errors);
				toastr.error('Please fill the form 4 first!',  'Error!');
			}
		});
	});

	$('#section_five').click(function(e) {
		e.preventDefault(); // Prevent default form submission
		// var formData = $(this).serialize();
		console.log('five click');
		var formData = new FormData($('#sectionFive')[0]);
		var url = submit_action;
		$.ajax({
			type: 'POST',
			url: url,
			data: formData,
			contentType: false,
			processData: false,
			headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
            },
			success: function(response) {
				console.log('yes',response);
				if(response.errors){
					var errors = response.errors;
					displayErrors(errors);
					toastr.error('Please fill the form 5 first!',  'Error!');
				}else{
				toastr.success(response.message, 'Success!');
					setTimeout(() => {
						location.reload();
						$('#section_five').parents('.collapse').addClass('show')
					}, 2000);
				}
			},
			error: function(response) {
				var errors = response.responseJSON.errors;
				displayErrors(errors);
				toastr.error('Please fill the form 5 first!',  'Error!');
			}
		});
	});

	$('#section_six').click(function(e) {
		e.preventDefault(); // Prevent default form submission
		// var formData = $(this).serialize();
		var formData = new FormData($('#sectionSix')[0]);
		var url = submit_action;
		$.ajax({
			type: 'POST',
			url: url, // Replace with your route URL
			data: formData,
			contentType: false,
			processData: false,
			headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
            },
			success: function(response) {
				console.log('yes',response);
				if(response.errors){
					var errors = response.errors;
					displayErrors(errors);
					toastr.error('Please fill the form 6 first!',  'Error!');
				}else{
				toastr.success(response.message, 'Success!');
					setTimeout(() => {
						location.reload();
						$('#section_six').parents('.collapse').addClass('show')
					}, 2000);
				}
			},
			error: function(response) {
				var errors = response.responseJSON.errors;
				displayErrors(errors);
				toastr.error('Please fill the form 6first!',  'Error!');
			}
		});
	});

	function displayErrors(errors) {
		for (var field in errors) {
			$('#' + field).removeAttr('hidden');
			$('#' + field).html(errors[field][0]);
		}
	}


});
