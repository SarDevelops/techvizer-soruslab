$(document).ready(function () {
    initHome();

});
function initHome() {
    $(".slider-carousel").owlCarousel({
        loop: true,
        margin: 20,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            0: {
                items: 1,
                nav: false,
                loop: true,
            },
            600: {
                items: 1,
                nav: false,
                loop: true,
            },
            1000: {
                items: 1,
                nav: false,
                loop: true,
            },
        },
    });

    $(".tab").click(function () {
        $(".tab").removeClass("active");
        $(this).addClass("active");
        var cat_id = $(this).attr("data-tab");
        $("[tab-data='" + $(this).attr("data-tab") + "']").addClass("active");
        if (cat_id != 0) {
            $('.lab-store').hide();
            $(".lab-store[data-cat-id="+cat_id+"]").show()
        }else{
            $('.lab-store').show();
        }
        // let method = "GET";
        // let url = $(this).attr("target-url");
        // let heading = $(this).attr("target-header");
        // let ajax = formdata_ajax_call(method, url);
        // ajax.done(function (response) {
        //     console.log("response", response);
        //     $(".submit-btn").prop("disabled", false);
        //     if (response["FLAG"]) {
        //         // action_drawer({ heading: heading });
        //         // $("#action-drawer-body").html(response["DATA"]["view"]);
        //         console.log(response["DATA"]["html"]);
        //         $("#packageDataTab").empty();
        //         $("#packageDataTab").html(response["DATA"]["html"]);
        //     } else {
        //         toastr.error(response["MESSAGE"]);
        //     }
        // }).fail(function (response) {
        //     console.log(response, "datat fails");
        // });
    });

    // $(".tab", "#packageTab").click(function () {
    //     $(".tab", "#packageTab").removeClass("active");
    //     $(this).addClass("active");
    //     $(".tab-data", "#packageDataTab").removeClass("active");
    //     $("[tab-data='" + $(this).attr("data-tab") + "']").addClass("active");
    // });

    // $(".tab", "#labTab").click(function () {
    //     $(".tab", "#labTab").removeClass("active");
    //     $(this).addClass("active");
    //     $(".tab-data", "#labDataTab").removeClass("active");
    //     $("[tab-data='" + $(this).attr("data-tab") + "']").addClass("active");
    // });

    $(".lab-carousel").owlCarousel({
        loop: true,
        margin: 20,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            0: {
                items: 1,
                nav: false,
                loop: true,
            },
            600: {
                items: 2,
                nav: false,
                loop: true,
            },
            1000: {
                items: 3,
                nav: false,
                loop: true,
            },
        },
    });

    $(".test-carousel").owlCarousel({
        loop: true,
        margin: 20,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            0: {
                items: 2,
                nav: false,
                loop: true,
            },
            600: {
                items: 4,
                nav: false,
                loop: true,
            },
            1000: {
                items: 8,
                nav: false,
                loop: true,
            },
        },
    });

    $(".top-test-carousel").owlCarousel({
        loop: true,
        margin: 20,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            0: {
                items: 1,
                nav: false,
                loop: true,
            },
            600: {
                items: 2,
                nav: false,
                loop: true,
            },
            1000: {
                items: 4,
                nav: false,
                loop: true,
            },
        },
    });

    $(".review-carousel").owlCarousel({
        loop: true,
        margin: 20,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        //        navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
        responsive: {
            0: {
                items: 1,
                nav: false,
                loop: true,
            },
            600: {
                items: 1,
                nav: false,
                loop: true,
            },
            1000: {
                items: 1,
                nav: false,
                loop: true,
            },
        },
    });
}



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
