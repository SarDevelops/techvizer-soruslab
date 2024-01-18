var repeater = $(".repeater-default").repeater({
	initval: 1,
});

jQuery(".drag")
	.sortable({
		axis: "y",
		cursor: "pointer",
		opacity: 0.5,
		placeholder: "row-dragging",
		delay: 150,
		update: function (event, ui) {
			console.log("repeaterVal");
			console.log(repeater.repeaterVal());
			console.log("serializeArray");
			console.log($("form").serializeArray());
		},
	})
	.disableSelection();

var repeater2 = $(".repeater_slider").repeater({
	initval: 1,
});

jQuery(".slider_add")
	.sortable({
		axis: "y",
		cursor: "pointer",
		opacity: 0.5,
		placeholder: "row-dragging",
		delay: 150,
		update: function (event, ui) {
			console.log("repeaterVal");
			console.log(repeater2.repeaterVal());
			console.log("serializeArray");
			console.log($("form").serializeArray());
		},
	})
	.disableSelection();

jQuery("#banner_image").change(function () {
	element = $(this);
	var files = this.files;
    var _URL = window.URL || window.webkitURL;
    var image, file;
	image = new Image();
    image.src = _URL.createObjectURL(files[0]);
	console.log(files);
	console.log(_URL);
	console.log(image);
	console.log(image.src);
	if (image.src) {
		// element.parents('form-outline').find('#feature_img_show').find('img').attr('src') = image.src;
		console.log(element.parents('form-outline').find('#feature_img_show').find('.img-wrap').find('img').attr('src',image),'qqqq');
	}
});
