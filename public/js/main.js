$(document).ready(function ($) {

    "use strict";

    var isMobile = false; //initiate as false
// device detection
    if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) isMobile = true;

    // scroll

    var scrollWindow = function () {
        var lastScrollTop = 0;
        $(window).scroll(function () {
            var $w = $(this),
                st = $w.scrollTop(),
                navbar = $('.probootstrap_navbar'),
                sd = $('.js-scroll-wrap');


            if (st > 150) {
                if (!navbar.hasClass('scrolled')) {
                    navbar.addClass('scrolled');
                }
            }
            if (st < 150) {
                if (navbar.hasClass('scrolled')) {
                    navbar.removeClass('scrolled sleep');
                }
            }
            if (st > 350) {
                if (!navbar.hasClass('awake')) {
                    navbar.addClass('awake');
                }
            }
            if (st < 350) {
                if (navbar.hasClass('awake')) {
                    navbar.removeClass('awake');
                    navbar.addClass('sleep');
                }
            }

        });
    };
    scrollWindow();


    // navigation
    var OnePageNav = function () {
        var navToggler = $('.navbar-toggler');
        $(".smoothscroll[href^='#'], #probootstrap-navbar ul li a[href^='#']").on('click', function (e) {
            e.preventDefault();
            var hash = this.hash;

            $('html, body').animate({

                scrollTop: $(hash).offset().top
            }, 700, 'easeInOutExpo', function () {
                window.location.hash = hash;
            });
        });
        $("#probootstrap-navbar ul li a[href^='#']").on('click', function (e) {
            if (navToggler.is(':visible')) {
                navToggler.click();
            }
        });

    };
    OnePageNav();


    var select2 = function () {
        $('.js-dropdown-multiple, .js-example-basic-single').select2();
    }
    select2();


    var contentWayPoint = function () {
        var i = 0;
        if ($('.probootstrap-animate').length > 0) {
            $('.probootstrap-animate').waypoint(function (direction) {

                if (direction === 'down' && !$(this.element).hasClass('probootstrap-animated')) {

                    i++;

                    $(this.element).addClass('item-animate');
                    setTimeout(function () {

                        $('body .probootstrap-animate.item-animate').each(function (k) {
                            var el = $(this);
                            setTimeout(function () {
                                var effect = el.data('animate-effect');
                                if (effect === 'fadeIn') {
                                    el.addClass('fadeIn probootstrap-animated');
                                } else if (effect === 'fadeInLeft') {
                                    el.addClass('fadeInLeft probootstrap-animated');
                                } else if (effect === 'fadeInRight') {
                                    el.addClass('fadeInRight probootstrap-animated');
                                } else {
                                    el.addClass('fadeInUp probootstrap-animated');
                                }
                                el.removeClass('item-animate');
                            }, k * 50, 'easeInOutExpo');
                        });

                    }, 50);

                }

            }, {offset: '95%'});
        }
    };
    contentWayPoint();


    var owlCarouselFunc = function () {
        $('.js-owl-carousel').owlCarousel({
            loop: false,
            margin: 20,
            nav: true,
            stagePadding: 50,
            navText: ["<span class='ion-chevron-left'></span>", "<span class='ion-chevron-right'></span>"],
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
        });

        $('.js-owl-carousel-2').owlCarousel({
            margin: 5,
            nav: false,
            loop: true,
            stagePadding: 0,
            dots: false,
            navText: ["<span class='ion-chevron-left'></span>", "<span class='ion-chevron-right'></span>"],
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 2
                },
                800: {
                    items: 4
                },
                1000: {
                    items: 4
                }
            }
        });
    };
    owlCarouselFunc();

    var ThumbnailOpacity = function () {
        var t = $('.probootstrap-thumbnail');
        t.hover(function () {
            var $this = $(this);
            t.addClass('sleep');
            $this.removeClass('sleep');
        }, function () {
            var $this = $(this);
            t.removeClass('sleep');
        });
    }
    ThumbnailOpacity();

    var ThumbnailOpacity2 = function () {
        var t = $('.probootstrap-thumbnail2');
        t.hover(function () {
            var $this = $(this);
            t.addClass('sleep');
            $this.removeClass('sleep');
        }, function () {
            var $this = $(this);
            t.removeClass('sleep');
        });
    }
    ThumbnailOpacity2();

    var datePicker = function () {
        $('#probootstrap-date-departure, #probootstrap-date-arrival').datepicker({
            'format': 'm/d/yyyy',
            'autoclose': true
        });
    };
    datePicker();
});

function goPage(url) {
    if (url) {
        window.open(url, '_self');
    }
}