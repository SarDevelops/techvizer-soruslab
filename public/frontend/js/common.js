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

    $(".tab", "#packageTab").click(function () {
        $(".tab", "#packageTab").removeClass("active");
        $(this).addClass("active");
        $(".tab-data", "#packageDataTab").removeClass("active");
        $("[tab-data='" + $(this).attr("data-tab") + "']").addClass("active");
    });

    $(".tab", "#labTab").click(function () {
        $(".tab", "#labTab").removeClass("active");
        $(this).addClass("active");
        $(".tab-data", "#labDataTab").removeClass("active");
        $("[tab-data='" + $(this).attr("data-tab") + "']").addClass("active");
    });

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
