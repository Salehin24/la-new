$(document).ready(function () {
    'use strict';

    //navbar add remove calss
    var header = $(".fixed-top");
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 1) {
            header.removeClass('navbar-transfarent').addClass("navbar-bg");
        } else {
            header.removeClass("navbar-bg").addClass('navbar-transfarent');
        }
    });


//Back to top button
//Get the button
    let mybutton = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
        scrollFunction();
    };

    function scrollFunction() {
        if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
                ) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }
// When the user clicks on the button, scroll to the top of the document
    mybutton.addEventListener("click", backToTop);

    function backToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    //Background Image
    $(".bg-img").css("backgroundImage", function () {
        var bg = "url(" + $(this).data("image-src") + ")";
        return bg;
    });

    //Counter
    $('.counter').counterUp({
        delay: 1,
        time: 500,
    });

    //Testimonial carousel
    $('.testimonial-carousel').owlCarousel({
        loop: true,
        margin: 16,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })



    //Viewe Course carousel
    $('.viewe-carousel').owlCarousel({
        loop: true,
        margin: 20,
        dots: false,
        nav: true,
        navText: ["<i class='fas fa-caret-right'></i>", "<i class='fas fa-caret-left'></i>"],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    })



    //Popup Video
    $('.popup-youtube').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: true,
        fixedContentPos: true
    });

    //Sticky Content
    jQuery('.sticky-content').theiaStickySidebar({
        // Settings
        additionalMarginTop: 70
    });

    //Quiz Form Check Input
    $('.quiz-form-check-input').on('click', function () {
        $('.quiz-overlay').toggleClass('current');
        $("html, body").animate({scrollTop: 0}, 0);
    });

    //Notifation Scroll
    $('.notifications-scroll').each(function () {
        const ps = new PerfectScrollbar($(this)[0]);
    });

    //Scroll Triger
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').on("click", function () {
        if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
                $("html, body").animate({scrollTop: target.offset().top - 100}, 0, "easeInOutExpo");
                // return false;
            }
        }
    });


    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function () {
//        $('.navbar-collapse', '.metismenu').collapse('hide');
    });

    // Activate scrollspy to add active class to navbar items on scroll
    $('body').scrollspy({
        target: '#navbar_top',
        offset: 70
    });












    //Pricing Table
    jQuery(document).ready(function ($) {
        //hide the subtle gradient layer (.pricing-list > li::after) when pricing table has been scrolled to the end (mobile version only)
        checkScrolling($('.pricing-body'));
        $(window).on('resize', function () {
            window.requestAnimationFrame(function () {
                checkScrolling($('.pricing-body'))
            });
        });
        $('.pricing-body').on('scroll', function () {
            var selected = $(this);
            window.requestAnimationFrame(function () {
                checkScrolling(selected)
            });
        });

        function checkScrolling(tables) {
            tables.each(function () {
                var table = $(this),
                        totalTableWidth = parseInt(table.children('.pricing-features list-unstyled').width()),
                        tableViewport = parseInt(table.width());
                if (table.scrollLeft() >= totalTableWidth - tableViewport - 1) {
                    table.parent('li').addClass('is-ended');
                } else {
                    table.parent('li').removeClass('is-ended');
                }
            });
        }

        //switch from monthly to annual pricing tables
        bouncy_filter($('.pricing-container'));

        function bouncy_filter(container) {
            container.each(function () {
                var pricing_table = $(this);
                var filter_list_container = pricing_table.children('.pricing-switcher'),
                        filter_radios = filter_list_container.find('input[type="radio"]'),
                        pricing_table_wrapper = pricing_table.find('.pricing-wrapper');

                //store pricing table items
                var table_elements = {};
                filter_radios.each(function () {
                    var filter_type = $(this).val();
                    table_elements[filter_type] = pricing_table_wrapper.find('li[data-type="' + filter_type + '"]');
                });

                //detect input change event
                filter_radios.on('change', function (event) {
                    event.preventDefault();
                    //detect which radio input item was checked
                    var selected_filter = $(event.target).val();

                    //give higher z-index to the pricing table items selected by the radio input
                    show_selected_items(table_elements[selected_filter]);

                    //rotate each pricing-wrapper 
                    //at the end of the animation hide the not-selected pricing tables and rotate back the .pricing-wrapper

                    if (!Modernizr.cssanimations) {
                        hide_not_selected_items(table_elements, selected_filter);
                        pricing_table_wrapper.removeClass('is-switched');
                    } else {
                        pricing_table_wrapper.addClass('is-switched').eq(0).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function () {
                            hide_not_selected_items(table_elements, selected_filter);
                            pricing_table_wrapper.removeClass('is-switched');
                            //change rotation direction if .pricing-list has the .bounce-invert class
                            if (pricing_table.find('.pricing-list').hasClass('bounce-invert'))
                                pricing_table_wrapper.toggleClass('reverse-animation');
                        });
                    }
                });
            });
        }
        function show_selected_items(selected_elements) {
            selected_elements.addClass('is-selected');
        }

        function hide_not_selected_items(table_containers, filter) {
            $.each(table_containers, function (key, value) {
                if (key != filter) {
                    $(this).removeClass('is-visible is-selected').addClass('is-hidden');

                } else {
                    $(this).addClass('is-visible').removeClass('is-hidden is-selected');
                }
            });
        }
    });

    //Doughnut Chart
    var percents =$('#percent').val();
    const percent = percents;
    const color = '#134779';
    const canvas = 'chartCanvas';
    const container = 'chartContainer';
    const percentValue = percent; // Sets the single percentage value
    const colorGreen = color, // Sets the chart color
            animationTime = '1400'; // Sets speed/duration of the animation

    const chartCanvas = document.getElementById(canvas), // Sets canvas element by ID
            chartContainer = document.getElementById(container), // Sets container element ID
            divElement = document.createElement('div'), // Create element to hold and show percentage value in the center on the chart
            domString = '<div class="chart__value"><p>' + percentValue + '%</p></div>'; // String holding markup for above created element

    // Create a new Chart object
    const doughnutChart = new Chart(chartCanvas, {
        type: 'doughnut', // Set the chart to be a doughnut chart type
        data: {
            datasets: [
                {
                    data: [percentValue, 100 - percentValue], // Set the value shown in the chart as a percentage (out of 100)
                    backgroundColor: [colorGreen], // The background color of the filled chart
                    borderWidth: 0 // Width of border around the chart
                }
            ]
        },
        options: {
            cutoutPercentage: 84, // The percentage of the middle cut out of the chart
            responsive: false, // Set the chart to not be responsive
            tooltips: {
                enabled: false // Hide tooltips
            }
        }
    });
    Chart.defaults.global.animation.duration = animationTime; // Set the animation duration

    divElement.innerHTML = domString; // Parse the HTML set in the domString to the innerHTML of the divElement
    chartContainer.appendChild(divElement.firstChild); // Append the divElement within the chartContainer as it's child



    //Editor
    // ClassicEditor
    //         .create(document.querySelector('#editor'))
    //         .catch(error => {
    //             console.error(error);
    //         });

    let theEditor;

    ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                theEditor = editor;

            })
            .catch(error => {
                console.error(error);
            });


    function getDataFromTheEditor() {
        return theEditor.getData();
    }


    document.getElementById('getdata').addEventListener('click', () => {
        var enterprise_shortname = $("#enterprise_shortname").val();
        var enterprise_id = $("#enterprise_id").val();
        var student_id = $("#student_id").val();
        var course_id = $("#course_id").val();
        var notes = getDataFromTheEditor();

//        getnoteslist();
//        return false;
        if (notes == '') {
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: "slideDown",
                    timeOut: 1500,
                };
                toastr.error("Empty field not allow!");
            }, 1000);
            return false;
        }
//        alert(enterprise_id); return false;

        $.ajax({
            url: base_url + enterprise_shortname + "/course-notesave",
            type: "POST",
            data: {'csrf_test_name': CSRF_TOKEN, student_id: student_id, course_id: course_id, enterprise_id: enterprise_id, notes: notes},
            success: function (r) {
//                toastrSuccessMsg(r);
                getnoteslist();
            }
        });
    });



});

function getnoteslist() {
    var student_id = $("#student_id").val();
    var course_id = $("#course_id").val();
    $.ajax({
        url: base_url + enterprise_shortname + "/get-noteslist",
        type: "POST",
        data: {'csrf_test_name': CSRF_TOKEN, student_id: student_id, course_id: course_id, enterprise_id: enterprise_id},
        success: function (r) {
            $("#loadnotes").html(r);
        }
    });

}







//window.addEventListener('DOMContentLoaded', event => {
//
//    // Activate Bootstrap scrollspy on the main nav element
//    const mainNav = document.body.querySelector('#navbar_top');
//    if (mainNav) {
//        new bootstrap.ScrollSpy(document.body, {
//            target: '#navbar_top',
//            offset: 124,
//        });
//    };
//
//    // Collapse responsive navbar when toggler is visible
//    const navbarToggler = document.body.querySelector('.navbar-toggler');
//    const responsiveNavItems = [].slice.call(
//        document.querySelectorAll('#navbarResponsive .nav-link')
//    );
//    responsiveNavItems.map(function (responsiveNavItem) {
//        responsiveNavItem.addEventListener('click', () => {
//            if (window.getComputedStyle(navbarToggler).display !== 'none') {
//                navbarToggler.click();
//            }
//        });
//    });
//
//});



;
(function ($) {
    'use strict';
    $(activate);
    function activate() {
        $('.course-tabs').scrollingTabs({
            enableSwiping: true,
            scrollToTabEdge: true,
            disableScrollArrowsOnFullyScrolled: true
        })
                .on('ready.scrtabs', function () {
                    $('.tab-content').show();
                });
    }
}(jQuery));



















//Mobile menu
document.addEventListener(
        "DOMContentLoaded", () => {
    const menu = new MmenuLight(
            document.querySelector("#menu"),
            "(max-width: 991px)"
            );

    const navigator = menu.navigation();
    const drawer = menu.offcanvas();

    document.querySelector("a[href='#menu']")
            .addEventListener("click", (evnt) => {
                evnt.preventDefault();
                drawer.open();
            });
}
);




//Navbar Sticky
document.addEventListener("DOMContentLoaded", function () {
    window.addEventListener('scroll', function () {
        if (window.scrollY > 0) {
            document.getElementById('navbarSticky').classList.add('sticky');
            // add padding top to show content behind navbar
            navbar_height = document.querySelector('.header-sticky').offsetHeight;
            document.body.style.paddingTop = navbar_height + 'px';
        } else {
            document.getElementById('navbarSticky').classList.remove('sticky');
            // remove padding top from body
            document.body.style.paddingTop = '0';
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    window.addEventListener('scroll', function () {
        if (window.scrollY > 431) {
            document.getElementById('navbar_top').classList.add('fixed-header-nav');
            // add padding top to show content behind navbar
            navbar_height = document.querySelector('.sticky-nav').offsetHeight;
            document.body.style.paddingTop = navbar_height + 'px';
        } else {
            document.getElementById('navbar_top').classList.remove('fixed-header-nav');
            // remove padding top from body
            document.body.style.paddingTop = '0';
        }
    });
});

//Feather Icon
feather.replace()