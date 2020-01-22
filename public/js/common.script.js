function showNotification(placementFrom, placementAlign, type, title, message) {
    $.notify(
        {
            title: title,
            message: message,
            target: "_blank"
        },
        {
            element: "body",
            position: null,
            type: type,
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: false,
            placement: {
                from: placementFrom,
                align: placementAlign
            },
            offset: 20,
            spacing: 10,
            z_index: 2031,
            delay: 1000,
            timer: 1000,
            url_target: "_blank",
            mouse_over: null,
            animate: {
                enter: "animated fadeInDown",
                exit: "animated fadeOutUp"
            },
            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: "class",
            template:
                '<div data-notify="container" class="col-11 col-sm-3 alert  alert-{0} " role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                "</div>" +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                "</div>"
        }
    );
}

// 전화번호
function inputTelNumber(obj) {

    var number = obj.value.replace(/[^0-9]/g, "");
    var tel = "";
    $(obj).val(number.replace(/[^0-9]/g, ""));

    // 서울 지역번호(02)가 들어오는 경우
    if (number.substring(0, 2).indexOf('02') == 0) {
        if (number.length < 3) {
            return number;
        } else if (number.length < 6) {
            tel += number.substr(0, 2);
            tel += "-";
            tel += number.substr(2);
        } else if (number.length < 10) {
            tel += number.substr(0, 2);
            tel += "-";
            tel += number.substr(2, 3);
            tel += "-";
            tel += number.substr(5);
        } else {
            tel += number.substr(0, 2);
            tel += "-";
            tel += number.substr(2, 4);
            tel += "-";
            tel += number.substr(6);
        }

        // 서울 지역번호(02)가 아닌경우
    } else {
        if (number.length < 4) {
            return number;
        } else if (number.length < 7) {
            tel += number.substr(0, 3);
            tel += "-";
            tel += number.substr(3);
        } else if (number.length < 11) {
            tel += number.substr(0, 3);
            tel += "-";
            tel += number.substr(3, 3);
            tel += "-";
            tel += number.substr(6);
        } else {
            tel += number.substr(0, 3);
            tel += "-";
            tel += number.substr(3, 4);
            tel += "-";
            tel += number.substr(7);
        }
    }

    obj.value = tel;
}

// 휴대폰번호
function inputPhoneNumber(obj) {
    var number = $(obj).val().replace(/[^0-9]/g, "");
    var phone = "";
    $(obj).val(number.replace(/[^0-9]/g, ""));

    if (number.length < 4) {
        return number;
    } else if (number.length < 7) {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3);
    } else if (number.length < 11) {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3, 3);
        phone += "-";
        phone += number.substr(6);
    } else {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3, 4);
        phone += "-";
        phone += number.substr(7);
    }
    $(obj).val(phone);
}

// 사업자번호
function inputCompanyNumber(obj) {
    var number = $(obj).val().replace(/[^0-9]/g, "");
    var company = "";
    $(obj).val(number.replace(/[^0-9]/g, ""));

    if (number.length < 4) {
        return number;
    } else if (number.length < 6) {
        company += number.substr(0, 3);
        company += "-";
        company += number.substr(3, 2);
    } else if (number.length < 11) {
        company += number.substr(0, 3);
        company += "-";
        company += number.substr(3, 2);
        company += "-";
        company += number.substr(5);
    } else {
        company += number.substr(0, 3);
        company += "-";
        company += number.substr(3, 2);
        company += "-";
        company += number.substr(5);
    }
    $(obj).val(company);
}

// 3자리 숫자 콤마
function inputNumberWithCommas(obj) {
    var number = $(obj).val().replace(/[^0-9]/g, "");
    $(obj).val(number.replace(/[^0-9]/g, ""));
    $(obj).val(number.replace(/\B(?=(\d{3})+(?!\d))/g, ",")); // 정규식을 이용해서 3자리 마다 , 추가
}

function dataTableReload(el, html) {

    $('.data-table-feature').dataTable().fnDestroy();

    $(el).html(html);

    $(".data-table-feature").dataTable({
        bLengthChange: false,
        sDom: '<"row view-filter"<"col-lg-12"<"float-left"l><"float-right w-100"f><"clearfix">>>t<"row view-pager"<"col-lg-12"<"text-center"ip>>>',
        ordering: false,
        drawCallback: function () {
            $($(".dataTables_wrapper .pagination li:first-of-type"))
                .find("a")
                .addClass("prev");
            $($(".dataTables_wrapper .pagination li:last-of-type"))
                .find("a")
                .addClass("next");

            $(".dataTables_wrapper .pagination").addClass("pagination-sm");
        },

    });
}


//링크 전달
function goPage(url) {
    location.href = url;
}

function post_goto(url, parm, target) {
    var f = document.createElement('form');


    var objs, value;
    for (var key in parm) {
        value = parm[key];
        objs = document.createElement('input');
        objs.setAttribute('type', 'hidden');
        objs.setAttribute('name', key);
        objs.setAttribute('value', value);
        f.appendChild(objs);
    }

    if (target)
        f.setAttribute('target', target);


    f.setAttribute('method', 'post');
    f.setAttribute('action', url);
    document.body.appendChild(f);
    f.submit();
}

// //모달 스트립트
// $('.modal').dialog({
//     autoOpen: false,
//     resizable: false,
//     modal: true,
//     draggable: false,
//     dialogClass: 'modal_custom',
//     width: 500,
//     buttons: [
//         {
//             text: "확인",
//             class: "modal_button",
//             id: "modal_btn",
//             click: function () {
//                 $(this).dialog("close");
//             }
//         }
//     ]
// });
<!-- 모달 임시 스크립트 -->


$('.modal').dialog({
    autoOpen: false,
    resizable: false,
    modal: true,
    draggable: false,
    dialogClass: 'modal_custom',
    width: 500,
    buttons: [
        {
            text: "확인",
            id: "modal_btn",
            click: function () {
                $(this).dialog("close");
            }
        }
    ]
});


/* 객실상세보기 */
$("#room_detail_view").click(function () {
    $("#modal_detail").css({
        "display": "block"
    });
    $("html").css({
        "overflow": "hidden"
    });
});

$(".modal_close").click(function () {
    $("#modal_detail").css({
        "display": "none"
    });
    $("html").css({
        "overflow": "auto"
    });
});



/* 03.13. Owl carousel */
if ($().owlCarousel) {

    if ($(".owl-carousel.basic").length > 0) {
        $(".owl-carousel.basic")
            .owlCarousel({
                margin: 30,
                rtl: isRtl,
                stagePadding: 15,
                dotsContainer: $(".owl-carousel.basic")
                    .parents(".owl-container")
                    .find(".slider-dot-container"),
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
            .data("owl.carousel")
            .onResize();
    }

    if ($(".owl-carousel.dashboard-numbers").length > 0) {
        $(".owl-carousel.dashboard-numbers")
            .owlCarousel({
                margin: 15,
                loop: true,
                autoplay: true,
                stagePadding: 5,
                rtl: isRtl,
                responsive: {
                    0: {
                        items: 1
                    },
                    320: {
                        items: 2
                    },
                    576: {
                        items: 3
                    },
                    1200: {
                        items: 3
                    },
                    1440: {
                        items: 3
                    },
                    1800: {
                        items: 4
                    }
                }
            })
            .data("owl.carousel")
            .onResize();
    }

    if ($(".best-rated-items").length > 0) {
        $(".best-rated-items")
            .owlCarousel({
                margin: 15,
                rtl: isRtl,
                items: 1,
                loop: true,
                autoWidth: true
            })
            .data("owl.carousel")
            .onResize();
    }

    if ($(".owl-carousel.single").length > 0) {
        $(".owl-carousel.single")
            .owlCarousel({
                margin: 30,
                rtl: isRtl,
                items: 1,
                loop: true,
                stagePadding: 15,
                dotsContainer: $(".owl-carousel.single")
                    .parents(".owl-container")
                    .find(".slider-dot-container")
            })
            .data("owl.carousel")
            .onResize();
    }

    if ($(".owl-carousel.center").length > 0) {
        $(".owl-carousel.center")
            .owlCarousel({
                loop: true,
                rtl: isRtl,
                margin: 30,
                stagePadding: 15,
                center: true,
                dotsContainer: $(".owl-carousel.center")
                    .parents(".owl-container")
                    .find(".slider-dot-container"),
                responsive: {
                    0: {
                        items: 1
                    },
                    480: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            })
            .data("owl.carousel")
            .onResize();
    }

    $(".owl-dot").click(function () {
        var carouselReference = $(
            $(this)
                .parents(".owl-container")
                .find(".owl-carousel")
        ).owlCarousel();
        carouselReference.trigger("to.owl.carousel", [$(this).index(), 300]);
    });

    $(".owl-prev").click(function (event) {
        event.preventDefault();
        var carouselReference = $(
            $(this)
                .parents(".owl-container")
                .find(".owl-carousel")
        ).owlCarousel();
        carouselReference.trigger("prev.owl.carousel", [300]);
    });

    $(".owl-next").click(function (event) {
        event.preventDefault();
        var carouselReference = $(
            $(this)
                .parents(".owl-container")
                .find(".owl-carousel")
        ).owlCarousel();
        carouselReference.trigger("next.owl.carousel", [300]);
    });
}

/* 03.02. Resize */
var subHiddenBreakpoint = 1440;
var searchHiddenBreakpoint = 768;
var menuHiddenBreakpoint = 768;

function onResize() {
    var windowHeight = $(window).outerHeight();
    var windowWidth = $(window).outerWidth();
    var navbarHeight = $(".navbar").outerHeight();

    var submenuMargin = parseInt(
        $(".sub-menu .scroll").css("margin-top"),
        10
    );
    $(".sub-menu .scroll").css(
        "height",
        windowHeight - navbarHeight - submenuMargin * 2
    );

    $(".main-menu .scroll").css("height", windowHeight - navbarHeight);
    $(".app-menu .scroll").css("height", windowHeight - navbarHeight - 40);

    if ($(".chat-app .scroll").length > 0 && chatAppScroll) {
        $(".chat-app .scroll").scrollTop(
            $(".chat-app .scroll").prop("scrollHeight")
        );
        chatAppScroll.update();
    }

    if (windowWidth < menuHiddenBreakpoint) {
        $("#app-container").addClass("menu-mobile");
    } else if (windowWidth < subHiddenBreakpoint) {
        $("#app-container").removeClass("menu-mobile");
        if ($("#app-container").hasClass("menu-default")) {
            $("#app-container").removeClass(allMenuClassNames);
            $("#app-container").addClass("menu-default menu-sub-hidden");
        }
    } else {
        $("#app-container").removeClass("menu-mobile");
        if (
            $("#app-container").hasClass("menu-default") &&
            $("#app-container").hasClass("menu-sub-hidden")
        ) {
            $("#app-container").removeClass("menu-sub-hidden");
        }
    }

    setMenuClassNames(0, true);
}

function setDirection() {
    if (typeof Storage !== "undefined") {
        if (localStorage.getItem("dore-direction")) {
            direction = localStorage.getItem("dore-direction");
        }
        isRtl = direction == "rtl" && true;
    }
}

$(window).on("resize", function (event) {
    if (event.originalEvent.isTrusted) {
        onResize();
    }
});
onResize();



/* 03.05. Menu */
var menuClickCount = 0;
var allMenuClassNames = "menu-default menu-hidden sub-hidden main-hidden menu-sub-hidden main-show-temporary sub-show-temporary menu-mobile";

function setMenuClassNames(clickIndex, calledFromResize, link) {
    menuClickCount = clickIndex;
    var container = $("#app-container");
    if (container.length == 0) {
        return;
    }

    var link = link || getActiveMainMenuLink();

    //menu-default no subpage
    if (
        $(".sub-menu ul[data-link='" + link + "']").length == 0 &&
        (menuClickCount == 2 || calledFromResize)
    ) {
        if ($(window).outerWidth() >= menuHiddenBreakpoint) {
            if (isClassIncludedApp("menu-default")) {
                if (calledFromResize) {
                    // $("#app-container").attr(
                    //   "class",
                    //   "menu-default menu-sub-hidden sub-hidden"
                    // );
                    $("#app-container").removeClass(allMenuClassNames);
                    $("#app-container").addClass("menu-default menu-sub-hidden sub-hidden");
                    menuClickCount = 1;
                } else {
                    // $("#app-container").attr(
                    //   "class",
                    //   "menu-default main-hidden menu-sub-hidden sub-hidden"
                    // );
                    $("#app-container").removeClass(allMenuClassNames);
                    $("#app-container").addClass("menu-default main-hidden menu-sub-hidden sub-hidden");

                    menuClickCount = 0;
                }
                resizeCarousel();
                return;
            }
        }
    }

    //menu-sub-hidden no subpage
    if (
        $(".sub-menu ul[data-link='" + link + "']").length == 0 &&
        (menuClickCount == 1 || calledFromResize)
    ) {
        if ($(window).outerWidth() >= menuHiddenBreakpoint) {
            if (isClassIncludedApp("menu-sub-hidden")) {
                if (calledFromResize) {
                    // $("#app-container").attr("class", "menu-sub-hidden sub-hidden");
                    $("#app-container").removeClass(allMenuClassNames);
                    $("#app-container").addClass("menu-sub-hidden sub-hidden");
                    menuClickCount = 0;
                } else {
                    // $("#app-container").attr(
                    //   "class",
                    //   "menu-sub-hidden main-hidden sub-hidden"
                    // );
                    $("#app-container").removeClass(allMenuClassNames);
                    $("#app-container").addClass("menu-sub-hidden main-hidden sub-hidden");
                    menuClickCount = -1;
                }
                resizeCarousel();
                return;
            }
        }
    }

    //menu-sub-hidden no subpage
    if (
        $(".sub-menu ul[data-link='" + link + "']").length == 0 &&
        (menuClickCount == 1 || calledFromResize)
    ) {
        if ($(window).outerWidth() >= menuHiddenBreakpoint) {
            if (isClassIncludedApp("menu-hidden")) {
                if (calledFromResize) {
                    // $("#app-container").attr(
                    //   "class",
                    //   "menu-hidden main-hidden sub-hidden"
                    // );
                    $("#app-container").removeClass(allMenuClassNames);
                    $("#app-container").addClass("menu-hidden main-hidden sub-hidden");

                    menuClickCount = 0;
                } else {
                    // $("#app-container").attr(
                    //   "class",
                    //   "menu-hidden main-show-temporary"
                    // );
                    $("#app-container").removeClass(allMenuClassNames);
                    $("#app-container").addClass("menu-hidden main-show-temporary");

                    menuClickCount = 3;
                }
                resizeCarousel();
                return;
            }
        }
    }

    if (clickIndex % 4 == 0) {
        if (isClassIncludedApp("menu-main-hidden")) {
            nextClasses = "menu-main-hidden";
        } else if (
            isClassIncludedApp("menu-default") &&
            isClassIncludedApp("menu-sub-hidden")
        ) {
            nextClasses = "menu-default menu-sub-hidden";
        } else if (isClassIncludedApp("menu-default")) {
            nextClasses = "menu-default";
        } else if (isClassIncludedApp("menu-sub-hidden")) {
            nextClasses = "menu-sub-hidden";
        } else if (isClassIncludedApp("menu-hidden")) {
            nextClasses = "menu-hidden";
        }
        menuClickCount = 0;
    } else if (clickIndex % 4 == 1) {
        if (
            isClassIncludedApp("menu-default") &&
            isClassIncludedApp("menu-sub-hidden")
        ) {
            nextClasses = "menu-default menu-sub-hidden main-hidden sub-hidden";
        } else if (isClassIncludedApp("menu-default")) {
            nextClasses = "menu-default sub-hidden";
        } else if (isClassIncludedApp("menu-main-hidden")) {
            nextClasses = "menu-main-hidden menu-hidden";
        } else if (isClassIncludedApp("menu-sub-hidden")) {
            nextClasses = "menu-sub-hidden main-hidden sub-hidden";
        } else if (isClassIncludedApp("menu-hidden")) {
            nextClasses = "menu-hidden main-show-temporary";
        }
    } else if (clickIndex % 4 == 2) {
        if (isClassIncludedApp("menu-main-hidden") && isClassIncludedApp("menu-hidden")) {
            nextClasses = "menu-main-hidden";
        } else if (
            isClassIncludedApp("menu-default") &&
            isClassIncludedApp("menu-sub-hidden")
        ) {
            nextClasses = "menu-default menu-sub-hidden sub-hidden";
        } else if (isClassIncludedApp("menu-default")) {
            nextClasses = "menu-default main-hidden sub-hidden";
        } else if (isClassIncludedApp("menu-sub-hidden")) {
            nextClasses = "menu-sub-hidden sub-hidden";
        } else if (isClassIncludedApp("menu-hidden")) {
            nextClasses = "menu-hidden main-show-temporary sub-show-temporary";
        }
    } else if (clickIndex % 4 == 3) {
        if (isClassIncludedApp("menu-main-hidden")) {
            nextClasses = "menu-main-hidden menu-hidden";
        } else if (
            isClassIncludedApp("menu-default") &&
            isClassIncludedApp("menu-sub-hidden")
        ) {
            nextClasses = "menu-default menu-sub-hidden sub-show-temporary";
        } else if (isClassIncludedApp("menu-default")) {
            nextClasses = "menu-default sub-hidden";
        } else if (isClassIncludedApp("menu-sub-hidden")) {
            nextClasses = "menu-sub-hidden sub-show-temporary";
        } else if (isClassIncludedApp("menu-hidden")) {
            nextClasses = "menu-hidden main-show-temporary";
        }
    }
    if (isClassIncludedApp("menu-mobile")) {
        nextClasses += " menu-mobile";
    }
    // container.attr("class", nextClasses);
    container.removeClass(allMenuClassNames);
    container.addClass(nextClasses);
    resizeCarousel();
}

$(".menu-button").on("click", function (event) {
    event.preventDefault();
    setMenuClassNames(++menuClickCount);
});

$(".menu-button-mobile").on("click", function (event) {
    event.preventDefault();
    $("#app-container")
        .removeClass("sub-show-temporary")
        .toggleClass("main-show-temporary");
    return false;
});

$(".main-menu").on("click", "a", function (event) {
    event.preventDefault();

    var link = $(this)
        .attr("href")
        .replace("#", "");

    if ($(".sub-menu ul[data-link='" + link + "']").length == 0) {
        var target = $(this).attr("target");
        if ($(this).attr("target") == null) {
            window.open(link, "_self");
        } else {
            window.open(link, target);
        }
        return;
    }

    showSubMenu($(this).attr("href"));
    var container = $("#app-container");
    if (!$("#app-container").hasClass("menu-mobile")) {
        if (
            $("#app-container").hasClass("menu-sub-hidden") &&
            (menuClickCount == 2 || menuClickCount == 0)
        ) {
            setMenuClassNames(3, false, link);
        } else if (
            $("#app-container").hasClass("menu-hidden") &&
            (menuClickCount == 1 || menuClickCount == 3)
        ) {
            setMenuClassNames(2, false, link);
        } else if (
            $("#app-container").hasClass("menu-default") &&
            !$("#app-container").hasClass("menu-sub-hidden") &&
            (menuClickCount == 1 || menuClickCount == 3)
        ) {
            setMenuClassNames(0, false, link);
        }
    } else {
        $("#app-container").addClass("sub-show-temporary");
    }
    return false;
});

$(document).on("click", function (event) {
    if (
        !(
            $(event.target)
                .parents()
                .hasClass("menu-button") ||
            $(event.target).hasClass("menu-button") ||
            $(event.target)
                .parents()
                .hasClass("sidebar") ||
            $(event.target).hasClass("sidebar")
        )
    ) {
        if (
            $("#app-container").hasClass("menu-sub-hidden") &&
            menuClickCount == 3
        ) {
            var link = getActiveMainMenuLink();
            if (link == lastActiveSubmenu) {
                setMenuClassNames(2);
            } else {
                setMenuClassNames(0);
            }
        } else if ($("#app-container").hasClass("menu-main-hidden") && $("#app-container").hasClass("menu-mobile")) {
            setMenuClassNames(0);
        } else if ($("#app-container").hasClass("menu-main-hidden")) {

        } else if (
            $("#app-container").hasClass("menu-hidden") ||
            $("#app-container").hasClass("menu-mobile")
        ) {
            setMenuClassNames(0);
        }
    }
});

function getActiveMainMenuLink() {
    var dataLink = $(".main-menu ul li.active a").attr("href");
    return dataLink ? dataLink.replace("#", "") : "";
}

function isClassIncludedApp(className) {
    var container = $("#app-container");
    var currentClasses = container
        .attr("class")
        .split(" ")
        .filter(x => x != "");
    return currentClasses.includes(className);
}

var lastActiveSubmenu = "";

function showSubMenu(dataLink) {
    if ($(".main-menu").length == 0) {
        return;
    }

    var link = dataLink ? dataLink.replace("#", "") : "";
    if ($(".sub-menu ul[data-link='" + link + "']").length == 0) {
        $("#app-container").removeClass("sub-show-temporary");

        if ($("#app-container").length == 0) {
            return;
        }

        if (
            isClassIncludedApp("menu-sub-hidden") ||
            isClassIncludedApp("menu-hidden")
        ) {
            menuClickCount = 0;
        } else {
            menuClickCount = 1;
        }
        $("#app-container").addClass("sub-hidden");
        noTransition();
        return;
    }
    if (link == lastActiveSubmenu) {
        return;
    }
    $(".sub-menu ul").fadeOut(0);
    $(".sub-menu ul[data-link='" + link + "']").slideDown(100);

    $(".sub-menu .scroll").scrollTop(0);
    lastActiveSubmenu = link;
}

function noTransition() {
    $(".sub-menu").addClass("no-transition");
    $("main").addClass("no-transition");
    setTimeout(function () {
        $(".sub-menu").removeClass("no-transition");
        $("main").removeClass("no-transition");
    }, 350);
}

showSubMenu($(".main-menu ul li.active a").attr("href"));

function resizeCarousel() {
    setTimeout(function () {
        var event = document.createEvent("HTMLEvents");
        event.initEvent("resize", false, false);
        window.dispatchEvent(event);
    }, 350);
}
