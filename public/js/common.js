"use strict";

function show_loader() {
    $.LoadingOverlay("show", {
        background: "rgba(255, 255, 255, 0.8)",
        image: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" style="width: 100%; height: 100%; fill: rgb(251, 109, 58);"><circle r="80" cx="500" cy="90" style="fill: #513e9d;"></circle><circle r="80" cx="500" cy="910" style="fill: #513e9d;"></circle><circle r="80" cx="90" cy="500" style="fill: #513e9d;"></circle><circle r="80" cx="910" cy="500" style="fill: #513e9d;"></circle><circle r="80" cx="212" cy="212" style="fill: #fb6d3a;"></circle><circle r="80" cx="788" cy="212" style="fill: #fb6d3a;"></circle><circle r="80" cx="212" cy="788" style="fill: #fb6d3a;"></circle><circle r="80" cx="788" cy="788" style="fill: #fb6d3a;"></circle></svg>',
        imageColor: ['#00a3ff', '#ef305e'],
        size: '40',
        maxSize: '40',
        minSize: '40'
    });
}

function hide_loader() {
    $.LoadingOverlay("hide");
}

show_loader();
$(document).ready(function () {
    hide_loader();

    $( document ).ajaxStop(function() {
       let select2 = $('[data-control="select2"]:not(.select2-hidden-accessible)')
       $.each(select2, function (index, element) {
            $(element).select2({
                placeholder : ($(element).attr('data-placeholder') ?? 'Select option')
            });
       });
    });
});




// Call AJAX function with method_name, route and data
function ajax_call(method, route, data = null) {
    return $.ajax({
        type: method,
        url: route,
        dataType: 'json',
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function(response) {
            ajax_fail(response)
        }
    });
}

// Call AJAX function with method_name, route and data
function formdata_ajax_call(method, route, data = null) {
    return $.ajax({
        type: method,
        url: route,
        cache: false,
        processData: false,
        contentType: false,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function(response) {
            ajax_fail(response)
        }
    });
}

// Handle ajax call failures
function ajax_fail(response) {
    hide_loader();
    if ($('.submit-btn').length) {
        $('.submit-btn').prop('disabled', false);
    }

    let message = response['statusText'];
    let error_type = 'Error';

    if (response['responseJSON']) {
        message = response['responseJSON']['MESSAGE'];
    }

    // if (response['status'] == 401) {
    //     sessionStorage.clear();
    //     // unauthorized();
    // }

    if (response['status'] == 422) {
        error_type = 'Validation Error';
        if (response['responseJSON'].hasOwnProperty('FLAG')) {
            message = response['responseJSON']['MESSAGE'];
        } else {
            $.each(response['responseJSON']['errors'], function(key, value) {
                message = value[0];
                return false;
            });
        }
    }

    if (response['status'] == 500) {
        if (response['responseJSON'].hasOwnProperty('FLAG')) {
            message = response['responseJSON']['MESSAGE'];
        } else {
             message = response['statusText'];
        }
    }

    toastr.error(message, error_type);
}

// function action_drawer(request = new Object) {
//     let heading = 'Action Drawer';
//     if (request.hasOwnProperty('heading')) {
//         heading = request['heading'];
//     }

//     $('.action-drawer-header').text(heading);
//     $('#action_drawer').toggleClass('drawer-on');
// }

function action_drawer(request = new Object) {
    let heading = 'Action Drawer';
    var drawerEl = document.querySelector("#action_drawer");
    var drawer = KTDrawer.getInstance(drawerEl);

    if (request.hasOwnProperty('heading')) {
        heading = request['heading'];
    }

    $('.action-drawer-header').text(heading);
    drawer.toggle();
}

function delete_confirmation(message = 'Are you sure you want to delete this user?', confirmButtonText = "Yes, delete!", cancelButtonText = 'No, cancel' ) {
    return Swal.fire({
        text: message,
        icon: "warning",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText,
		showLoaderOnConfirm: true,
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    });
}

function delay(callback, ms) {
  var timer = 0;
  return function() {
    var context = this, args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function () {
      callback.apply(context, args);
    }, ms || 0);
  };
}
// Image image not exist then load defaul image
// function image_error() {
//     var image_tags = $('body').find('section').find('img');
//     var image_tags_length = image_tags.length;
//     for (var i = 0; i < image_tags_length; i++) {
//         $(image_tags[i]).on('error', function() {
//             $(this).attr("onerror", null);
//             $(this).attr("src", default_image);
//         });
//     }
// }

// function lazyload_image() {
//     setTimeout(function () {
//         if (typeof $('body').find('.lazy').lazy !== "undefined") {
//             // Load Image Lazy
//             $('body').find('.lazy').lazy({
//                 // your configuration goes here
//                 chainable: false,
//                 scrollDirection: 'vertical',
//                 effect: 'fadeIn',
//                 visibleOnly: true,
//                 combined: true,
//                 delay: 2000,
//                 effectTime: 2000,
//                 threshold: 0,
//                 throttle: 1000,
//                 // placeholder: "data:image/gif;base64,R0lGODlhEALAPQAPzl5uLr9Nrl8e7...",
//                 onError: function(element) {
//                     element.attr('src', default_image);
//                 }
//             });
//         }
//     }, 200);
// }

/* Toastr Confirgration */
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toastr-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "10000"
  };

function tooltip_initialize(){
    $('[data-bs-toggle="tooltip"]').tooltip();
}

function generateRandomPassword(length) {
	/*	 --- start --- | Spark ID - SAR | PC - C149 | Date 11-12-23 */
	const uppercaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const lowercaseChars = 'abcdefghijklmnopqrstuvwxyz';
    const numberChars = '0123456789';
    const specialChars = '@#$%&';
    function getRandomChar(charSet) {
      const randomIndex = Math.floor(Math.random() * charSet.length);
      return charSet.charAt(randomIndex);
    }
    const password = getRandomChar(uppercaseChars) + getRandomChar(lowercaseChars) + getRandomChar(numberChars) + getRandomChar(specialChars) +
                     Array.from({ length: 8 }, () => {
                       const charSets = [uppercaseChars, lowercaseChars, numberChars, specialChars];
                       const randomCharSet = charSets[Math.floor(Math.random() * charSets.length)];
                       return getRandomChar(randomCharSet);
                     }).join('');
    return password;
	/* --- End --- */

    // const characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@$%^&_+';
    // const charactersLength = characters.length;
    // let randomString = '';


    // for (let i = 0; i < length; i++) {
    //     randomString += characters[Math.floor(Math.random() * charactersLength)];
    // }

    // return randomString;
}
