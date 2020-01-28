<?php $__env->startSection('title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="/css/slick.css">
    <link rel="stylesheet" href="/css/daterangepicker.css">
    <link rel="stylesheet" href="/css/daterangepicker2.css">
    <link rel="stylesheet" href="/css/swiper.min.css">
    <link rel="stylesheet" href="/css/product.css">
    <link rel="stylesheet" href="/css/calendar.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .timeList {
            border-color: rgba(46, 49, 51, 0.27);
            border-right: none;
            border-bottom: none;
            border-left: none;
            border-top: none;
        }

        .timeList tr td th {
            font-family: 'Lato', sans-serif;
            align-items: center;
        }

        .btn-secondary {
            background-color: #8853c0bf;
            background-image: none;
            border-color: #8853c0bf;
        }

        .btn-group > .btn:focus, .btn-group > .btn:active, .btn-group > .btn.active,
        .btn-group-vertical > .btn:focus, .btn-group-vertical > .btn:active, .btn-group-vertical > .btn.active {
            z-index: 2;
            border-color: #8853c0bf;
        }

        .btn-secondary:active, .btn-secondary.active, .show > .btn-secondary.dropdown-toggle {
            background-color: #4E3188;
            background-image: none;
            border-color: #4E3188;
        }

        .btn:hover, .btn:active, .btn:focus {
            background-color: #4E3188;
            -webkit-box-shadow: 0 2px 4px 0 #4E3188bf;
            box-shadow: 0 2px 4px 0 #4E3188bf
        }

        .btn-secondary.disabled, .btn-secondary:disabled {
            background-color: #4E3188bf;
            border-color: #4E3188bf;
        }

        .list-group-item.active {
            z-index: 2;
            color: #fff;
            background-color: #4E3188;
            background-image: none;
            border-color: #4E3188;
        }
    </style>

    <section class="probootstrap-cover overflow-hidden relative"
             style="background-image: url('<?php echo e($partner->partner_image_route . $partner->partner_image_save_name); ?>'); padding: 2em 0 0"
             data-stellar-background-ratio="0.5"
             id="section-home">
        <div class="overlay"></div>
        <div class="container top-container">
            <div class="row align-items-center text-center">
                <div class="col-md">
                    <h2 class="heading mb-2 display-5 font-light probootstrap-animate"><?php echo e($partner->name); ?></h2>
                    <input type="hidden" value="<?php echo e($partner->id); ?>" id="partnerId" name="partnerId">
                    <div class="form-group">
                        
                        
                        <div id="reportrange" class="form-control date-btn">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span id="date"></span> <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->

    <section>
        <div class="container">
            <div class="sub-header">
                <div class="swipe-tabs">
                    <div class="swipe-tab" onclick="roomAjax(<?php echo e($id); ?>)">객실안내/예약</div>
                    <div class="swipe-tab" onclick="roomInfo(<?php echo e($id); ?>)">숙소정보</div>
                    
                    
                </div>
            </div>
        </div>
    </section>

    
    
    
    
    <!-- END section -->

    <div class="container" id="list" name="list">
    </div>
    <div class="container">
        <div class="calendar-section">
            <div class="row">
                <div class="col-sm-6">
                    <div class="calendar calendar-first" id="calendar_first">
                        <div class="calendar_header">
                            <button class="switch-month switch-left">
                                <
                            </button>
                            <h2></h2>
                            <button class="switch-month switch-right">
                                >
                            </button>
                        </div>
                        <div class="calendar_weekdays"></div>
                        <div class="calendar_content"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="calendar calendar-second">
                        <table class="timeList" border="1px" width="100%">
                            <caption>대관장소, 시간 테이블입니다.</caption>
                            <thead>
                            <tr align="center">
                                <td scope="col">대관장소</td>
                                <td scope="col">시간</td>
                            </tr>
                            </thead>
                            <tbody id="timeList_body">
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            </tbody>
                        </table>
                        <p class="bul-mark2">각 공간명을 클릭하시면 시설정보를 확인하실 수 있습니다.</p>
                        <p class="bul-mark2">
                            시간을 연속으로 선택 하여 주세요.
                            <strong class="color-black">(오전 3타임, 오후 4타임, 야간2타임)</strong>
                        </p>
                    </div>
                </div>
            </div> <!-- End Row -->
        </div> <!-- End Calendar -->
    </div> <!-- End Container -->

<div id="app"></div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="/js/vue.js"></script>
    <script src="/js/slick.min.js"></script>
    <script src="/js/slick.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/daterangepicker.js"></script>
    
    <script src="/js/swiper.min.js"></script>
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
    <script type="text/javascript"
            src="//dapi.kakao.com/v2/maps/sdk.js?appkey=18f674405264089485c0e9db6bbaf2ef&libraries=services"></script>

    <script src="/js/calendar.js"></script>

    <script>

        // 아래 내용은 컴파일러가 필요합니다
        new Vue({
            template: '<div><?php echo e(hi); ?></div>'
        })
        // 아래는 필요하지 않습니다
        new Vue({
            render (h) {
                return h('div', this.hi)
            }
        })

        $(function () {
            'use strict';
            resetList(moment().subtract(0, 'days').format('YYYYMMDD'), moment().subtract(-1, 'days').format('YYYYMMDD'));
                
            var $swipeTabsContainer = $('.swipe-tabs'),
                $swipeTabs = $('.swipe-tab'),
                currentIndex = 0,
                activeTabClassName = 'active-tab';

            $swipeTabsContainer.on('init', function (event, slick) {
                $swipeTabsContainer.removeClass('invisible');

                currentIndex = slick.getCurrent();
                $swipeTabs.removeClass(activeTabClassName);
                $('.swipe-tab[data-slick-index=' + currentIndex + ']').addClass(activeTabClassName);
            });

            $swipeTabsContainer.slick({
                // slidesToShow: 3.25,
                slidesToShow: 2,
                slidesToScroll: 1,
                arrows: false,
                infinite: false,
                swipeToSlide: true
            });

            $swipeTabs.on('click', function (event) {
                // gets index of clicked tab
                currentIndex = $(this).data('slick-index');
                $swipeTabs.removeClass(activeTabClassName);
                $('.swipe-tab[data-slick-index=' + currentIndex + ']').addClass(activeTabClassName);
                $swipeTabsContainer.slick('slickGoTo', currentIndex);
            });

            var start = moment().subtract(0, 'days');
            var end = moment().subtract(-1, 'days');

            function cb(start, end) {
                $('#reportrange span').html(start.format('YYYY.MM.DD') + ' ~ ' + end.format('YYYY.MM.DD'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                minDate: new Date(),
                "locale": {
                    "format": "YYYY년MM월DD일",
                    "separator": " ~ ",
                    "applyLabel": "확인",
                    "cancelLabel": "취소",
                    "fromLabel": "시작일",
                    "toLabel": "종료일",
                    "customRangeLabel": "선택",
                    "daysOfWeek": [
                        "일",
                        "월",
                        "화",
                        "수",
                        "목",
                        "금",
                        "토"
                    ],
                    "monthNames": [
                        "1월",
                        "2월",
                        "3월",
                        "4월",
                        "5월",
                        "6월",
                        "7월",
                        "8월",
                        "9월",
                        "10월",
                        "11월",
                        "12월"
                    ],
                    "firstDay": 1
                }
            }, cb);

            cb(start, end);

            //
            // $('#reportrange2').daterangepicker2({
            //     startDate: start,
            //     endDate: end,
            //     minDate: new Date(),
            //     "locale": {
            //         "format": "YYYY년MM월DD일",
            //         "separator": " ~ ",
            //         "applyLabel": "확인",
            //         "cancelLabel": "취소",
            //         "fromLabel": "시작일",
            //         "toLabel": "종료일",
            //         "customRangeLabel": "선택",
            //         "daysOfWeek": [
            //             "일",
            //             "월",
            //             "화",
            //             "수",
            //             "목",
            //             "금",
            //             "토"
            //         ],
            //         "monthNames": [
            //             "1월",
            //             "2월",
            //             "3월",
            //             "4월",
            //             "5월",
            //             "6월",
            //             "7월",
            //             "8월",
            //             "9월",
            //             "10월",
            //             "11월",
            //             "12월"
            //         ],
            //         "firstDay": 1
            //     }
            // }, cb);
            //
            // cb(start, end);

            

            $(".applyBtn").on('click', function (event) {
                var dates = $('.drp-selected').html().split('~');

                var start = dates[0].replace("년", "");
                start = start.replace("월", "");
                start = start.replace("일", "");

                var end = dates[1].replace("년", "");
                end = end.replace("월", "");
                end = end.replace("일", "");

                resetList(start, end);
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
            });

        });

        function reserve(type, idx) {
            $dates = $('#date').html().split('~');

            $start = $dates[0].replace(".", "");
            $start = $start.replace(".", "");
            $end = $dates[1].replace(".", "");
            $end = $end.replace(".", "");

            var url = "";
            if (type == 'renting') {
                url = "/reserve?idx=" + idx + "&start=" + $start + "&end=" + $end + "&type=1";
            } else if (type == 'lodgment') {
                url = "/reserve?idx=" + idx + "&start=" + $start + "&end=" + $end + "&type=2";
            } else {
                url = "/reserve?idx=" + idx + "&start=" + $start + "&end=" + $end + "&type=3";
            }
            window.location = url;
        }

        function roomAjax(id) {
            $dates = $('#date').html().split('~');

            $start = $dates[0].replace(".", "");
            $start = $start.replace(".", "");
            $start = $start.replace(".", "");

            $end = $dates[1].replace(".", "");
            $end = $end.replace(".", "");
            $end = $end.replace(".", "");

            resetList($start, $end)
        }

        function roomInfo(id) {
            $.ajax({
                url: '/detail/info',
                type: "post",
                dataType: "json", data: {
                    'id': id,
                    "_token": "<?php echo e(csrf_token()); ?>"
                },
            }).done(function (response) {
                var data = response.datas;
                $("#roomList").html(data);
                var address = response.address;
                var name = response.name;
                map(address, name);
            });
        }

        function findTimeList(year, month, date) {
            if ($("input:radio[name='room']:checked").val() == undefined)
                alert("룸을 선택해 주세요");
            else {
                $.ajax({
                    url: '/detail/timeList',
                    type: "post",
                    dataType: "json", data: {
                        'id': $("#partnerId").val(),
                        'room_idx': $("input:radio[name='room']:checked").val(),
                        'year': year,
                        'month': month,
                        'date': date,
                        "_token": "<?php echo e(csrf_token()); ?>"
                    },
                }).done(function (response) {
                    var data = response.datas;
                    $("#timeList_body").html(data);
                });
            }
        }

        function resetList(start, end) {
            $.ajax({
                url: '/detail',
                type: "get",
                dataType: "json", data: {
                    'id': "<?php echo e($id); ?>",
                    'room_product_start_date': start,
                    'room_product_end_date': end,
                    'json': true,
                    "_token": "<?php echo e(csrf_token()); ?>"
                },
            }).done(function (response) {
                var data = response.datas;
                var list = response.list;
                $("#roomList").html(data);
                $("#list").html(list);
                var swiper = new Swiper('.swiper-container', {
                    pagination: {
                        el: '.swiper-pagination',
                        type: 'progressbar',
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });

            });
        }

        // var container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
        // var options = { //지도를 생성할 때 필요한 기본 옵션
        //     center: new kakao.maps.LatLng(33.450701, 126.570667), //지도의 중심좌표.
        //     level: 3 //지도의 레벨(확대, 축소 정도)
        // };
        //
        // var map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴


        function map(address, name) {
            var container = document.getElementById('map');
            var options = {
                center: new kakao.maps.LatLng(33.450701, 126.570667),
                level: 3
            };

            var map = new kakao.maps.Map(container, options);

            var geocoder = new kakao.maps.services.Geocoder();

            var mapTypeControl = new kakao.maps.MapTypeControl();

            // 지도에 컨트롤을 추가해야 지도위에 표시됩니다
// kakao.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
            map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPRIGHT);

// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
            var zoomControl = new kakao.maps.ZoomControl();
            map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

            // 주소로 좌표를 검색합니다
            geocoder.addressSearch(address, function (result, status) {

                // 정상적으로 검색이 완료됐으면
                if (status === kakao.maps.services.Status.OK) {

                    var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                    // 결과값으로 받은 위치를 마커로 표시합니다
                    var marker = new kakao.maps.Marker({
                        map: map,
                        position: coords
                    });

                    // 인포윈도우로 장소에 대한 설명을 표시합니다
                    var infowindow = new kakao.maps.InfoWindow({
                        content: '<div style="width:150px;text-align:center;padding:6px 0;">' + name + '</div>'
                    });
                    infowindow.open(map, marker);

                    // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
                    map.setCenter(coords);
                }
            });
        }

        function timeclick(id) {
            $("input[name=time]").prop("checked", false);
            $("#time"+id).prop("checked", true);
        
        
        
        
        
        
        
        
        
        
        }


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/isihyeon/Documents/GitHub/lsh_project/resources/views/product/detail.blade.php ENDPATH**/ ?>