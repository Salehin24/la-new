(function ($) {
    "use strict";
    var lAcademy = {
        initialize: function () {
            this.navBar();
            this.navbarSticky();
            this.navSticky();
            this.tabsHorizontalScroll();
            this.backgroundImage();
            this.scrollbar();
            this.toTop();
            this.stickyContent();
            this.testimonialCarousel();
            this.popupVideo();
            this.counter();
            this.pricingTable();
            this.quizOverlayAndScroll();
            this.editor();
            this.doughnutChart();
        },
        //Navbar
        navBar: function () {
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
        },

        //Navbar Sticky
        navbarSticky: function () {
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
        },
        //Nav Sticky
        navSticky: function () {
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
        },
        //Tabs Horizontal Scroll
        tabsHorizontalScroll: function () {
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
        },
        //Background Image
        backgroundImage: function () {
            $(".bg-img").css("backgroundImage", function () {
                var bg = "url(" + $(this).data("image-src") + ")";
                return bg;
            });
        },
        // Perfect Scrollbar
        scrollbar: function () {
            $('.notifications-scroll').each(function () {
                const ps = new PerfectScrollbar($(this)[0]);
            });
        },

        //Testimonial carousel
        testimonialCarousel: function () {
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
        },

        //Popup Video
        popupVideo: function () {
            $('.popup-youtube').magnificPopup({
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: true,
                fixedContentPos: true
            });
        },

        //Counter
        counter: function () {
            $('.counter').counterUp({
                delay: 1,
                time: 500,
            });
        },

        //Pricing Table
        pricingTable: function () {
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
        },

        //Back to top
        toTop: function () {
            $('body').append('<div id="toTop" class="btn-top"><i class="fas fa-chevron-up"></i></div>');
            $(window).scroll(function () {
                if ($(this).scrollTop() !== 0) {
                    $('#toTop').fadeIn();
                } else {
                    $('#toTop').fadeOut();
                }
            });
            $('#toTop').on('click', function () {
                $("html, body").animate({scrollTop: 0}, 600);
                return false;
            });
        },
        //Sticky Content
        stickyContent: function () {
            jQuery('.sticky-content').theiaStickySidebar({
                // Settings
                additionalMarginTop: 70
            });
        },

        //Quiz Overlay And Scroll
        quizOverlayAndScroll: function () {
            $('.quiz-form-check-input').on('click', function () {
                $('.quiz-overlay').toggleClass('current');
                $("html, body").animate({scrollTop: 0}, 0);
            });
        },
        //Editor
        editor: function () {
            ClassicEditor
                    .create(document.querySelector('#editor'))
                    .catch(error => {
                        console.error(error);
                    });
        },

        //Doughnut Chart
        doughnutChart: function () {

            const percent = 84;
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
        },

    };


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

    //Feather Icon
    feather.replace()

    // Initialize
    $(document).ready(function () {
        lAcademy.initialize();
    });

}(jQuery));