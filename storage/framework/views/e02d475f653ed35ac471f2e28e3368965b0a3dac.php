<?php $__env->startSection('title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="/css/slick.css">
    <link rel="stylesheet" href="/css/daterangepicker.css">
    <link rel="stylesheet" href="/css/swiper.min.css">
    <link rel="stylesheet" href="/css/product.css">
    <style>
        .icon-button {
            padding: 0;
            font-size: 14px;
            width: 34px;
            height: 34px;
            line-height: 34px;
            background: white;
        }

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="probootstrap-cover overflow-hidden relative"
             style="background-image: url('images/recommend_1.jpg'); padding: 2em 0 0"
             data-stellar-background-ratio="0.5"
             id="section-home">
        <div class="overlay"></div>
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-md">
                    <p class="lead mb-5 probootstrap-animate" style="margin: 0 !important;"><a href="#"
                                                                                               data-toggle="modal"
                                                                                               data-target="#exampleModal1"
                                                                                               class="basic-a-color"
                                                                                               onclick="mapModal();">다른지역보기
                            <i
                                class="fa fa-angle-down"></i></a></p>
                    <h2 class="heading mb-2 display-5 font-light probootstrap-animate" id="sido_gu">서울시 - 강남구</h2>
                </div>
            </div>
        </div>

    </section>
    <!-- END section -->

    <section>
        <div class="container">
            <div class="sub-header">
                <div class="swipe-tabs">
                    <div class="swipe-tab" onclick="roomAjax('모텔')">모텔</div>
                    <div class="swipe-tab" onclick="roomAjax('호텔')">호텔</div>
                    <div class="swipe-tab" onclick="roomAjax('펜션')">펜션</div>
                    <div class="swipe-tab" onclick="roomAjax('글램핑')">글램핑</div>
                    <div class="swipe-tab" onclick="roomAjax('공간대여')">공간대여</div>
                </div>
            </div>
        </div>
        <input type="hidden" id="type" value="모텔">
        <input type="hidden" id="sido" value="서울">
        <input type="hidden" id="gu" value="강남구">
    </section>

    <section class="probootstrap_section probootstrap_lg_pt-50" id="section-city-guides">
        <div class="container" id="roomList">
        </div>
    </section>

    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">지도</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="padding: 0.25rem 0.75rem;">×</span>
                    </button>
                    <button class="btn icon-button" id="resizeMap"  onclick="reSize();">
                        <i class="simple-icon-refresh"></i>
                    </button>
                </div>
                <div class="modal-body" id="map">
                    <div class="form-group">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    
    

    
    
    <!-- END section -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="/js/slick.min.js"></script>
    <script src="/js/slick.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/daterangepicker.js"></script>
    <script src="/js/swiper.min.js"></script>
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
    <script type="text/javascript"
            src="//dapi.kakao.com/v2/maps/sdk.js?appkey=18f674405264089485c0e9db6bbaf2ef&libraries=services"></script>
    <script>
        $(function () {
            'use strict';

            var $swipeTabsContainer = $('.swipe-tabs'),
                $swipeTabs = $('.swipe-tab'),
                currentIndex = 0,
                activeTabClassName = 'active-tab';

            $swipeTabsContainer.on('init', function (event, slick) {
                $swipeTabsContainer.removeClass('invisible');

                currentIndex = slick.getCurrent();
                $swipeTabs.removeClass(activeTabClassName);
                $('.swipe-tab[data-slick-index=' + <?php echo e($_GET['idx']); ?> +']').addClass(activeTabClassName);
            });

            $swipeTabsContainer.slick({
                // slidesToShow: 3.25,
                slidesToShow: 4,
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
            roomAjax("<?php echo e($type); ?>");
            ThumbnailOpacity();

        });

        function roomAjax(type) {
            $("#type").val(type);
            $.ajax({
                url: '/goods',
                type: "get",
                dataType: "json", data: {
                    'json': true,
                    'type': type,
                    'partner_sido': $("#sido").val(),
                    'partner_sigungu': $("#gu").val(),
                    "_token": "<?php echo e(csrf_token()); ?>"
                },
            }).done(function (response) {
                var data = response.datas;
                $("#roomList").html(data);
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
                $(".close").click();
            });

            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            

            
        }

        function reserve(type, idx) {
            var url = "";
            if (type == 'renting') {
                url = "/reserve?idx=" + idx;
            } else {
                url = "/reserve?idx=" + idx;
            }
            window.location = url;
        }

        var ThumbnailOpacity = function () {
            var t = $('.probootstrap-thumbnail');
            t.hover(function () {
                console.log(t);
                var $this = $(this);
                t.addClass('sleep');
                $this.removeClass('sleep');
            }, function () {
                var $this = $(this);
                t.removeClass('sleep');
            });
        }

        function roomDetail(id) {
            window.location = "/detail?id=" + id;
        }

        var mapContainer = document.getElementById('map'), // 지도를 표시할 div
            mapOption = {
                center: new kakao.maps.LatLng(37.566826, 126.9786567), // 지도의 중심좌표
                level: 7 // 지도의 확대 레벨
            };

        // 지도를 생성합니다
        var map = new kakao.maps.Map(mapContainer, mapOption);

        function mapModal() {
            mapInit($("#gu").val());
            setTimeout(function() {
                reSize();
            }, 300);
        }

        function reSize() {
            map.relayout();
        }

        // function map(address) {
        //     var container = document.getElementById('map');
        //     var options = {
        //         center: new kakao.maps.LatLng(33.450701, 126.570667),
        //         level: 3
        //     };
        //
        //     var map = new kakao.maps.Map(container, options);
        //
        //     var geocoder = new kakao.maps.services.Geocoder();
        //
        //     var clickMarker = null;
        //     //노선 마커와 위치 클릭 마커
        //
        //     var clickIcon = new daum.maps.MarkerImage(
        //         "./image/location.png",
        //         new daum.maps.Size(32, 32));
        //
        //
        //     // 주소로 좌표를 검색합니다
        //     geocoder.addressSearch(address, function (result, status) {
        //
        //         // 정상적으로 검색이 완료됐으면
        //         if (status === kakao.maps.services.Status.OK) {
        //
        //             var coords = new kakao.maps.LatLng(result[0].y, result[0].x);
        //
        //             // 결과값으로 받은 위치를 마커로 표시합니다
        //             var marker = new kakao.maps.Marker({
        //                 map: map,
        //                 position: coords
        //             });
        //
        //             // 인포윈도우로 장소에 대한 설명을 표시합니다
        //             // var infowindow = new kakao.maps.InfoWindow({
        //             //     content: '<div style="width:150px;text-align:center;padding:6px 0;">'+name+'</div>'
        //             // });
        //             // infowindow.open(map, marker);
        //
        //             // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
        //             map.setCenter(coords);
        //         }
        //     });
        //
        //     daum.maps.event.addListener(map, 'click', function (mouseEvent) {
        //
        //         if (clickMarker != null) {
        //             clickMarker.setMap(null);
        //         }
        //
        //         // 클릭한 위도, 경도 정보를 가져옵니다
        //         var latlng = mouseEvent.latLng;
        //
        //
        //         var resultDiv1 = document.getElementById('lat');
        //         resultDiv1.value = Math.floor(latlng.getLat() * 100000) / 100000;
        //         var resultDiv2 = document.getElementById('lng');
        //         resultDiv2.value = Math.floor(latlng.getLng() * 100000) / 100000;
        //
        //         clickMarker = new daum.maps.Marker({
        //             position: new daum.maps.LatLng(resultDiv1.value, resultDiv2.value),
        //             image: clickIcon,
        //             clickable: false
        //         });
        //
        //
        //         clickMarker.setMap(map);
        //
        //     });
        //
        // }

        function mapInit(address) {
            // 주소-좌표 변환 객체를 생성합니다
            var geocoder = new kakao.maps.services.Geocoder();

            var marker = new kakao.maps.Marker(), // 클릭한 위치를 표시할 마커입니다
                infowindow = new kakao.maps.InfoWindow({zindex: 1}); // 클릭한 위치에 대한 주소를 표시할 인포윈도우입니다

            // 현재 지도 중심좌표로 주소를 검색해서 지도 좌측 상단에 표시합니다
            //searchAddrFromCoords(map.getCenter(), displayCenterInfo);

            // 주소로 좌표를 검색합니다
            geocoder.addressSearch(address, function (result, status) {

                // 정상적으로 검색이 완료됐으면
                if (status === kakao.maps.services.Status.OK) {

                    var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                    // 결과값으로 받은 위치를 마커로 표시합니다
                    // var marker = new kakao.maps.Marker({
                    //     map: map,
                    //     position: coords
                    // });

                    // 인포윈도우로 장소에 대한 설명을 표시합니다
                    // var infowindow = new kakao.maps.InfoWindow({
                    //     content: '<div style="width:150px;text-align:center;padding:6px 0;">'+name+'</div>'
                    // });
                    // infowindow.open(map, marker);

                    // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
                    map.setCenter(coords);
                }
            });

            // 지도를 클릭했을 때 클릭 위치 좌표에 대한 주소정보를 표시하도록 이벤트를 등록합니다
            kakao.maps.event.addListener(map, 'click', function (mouseEvent) {
                searchDetailAddrFromCoords(mouseEvent.latLng, function (result, status) {
                    if (status === kakao.maps.services.Status.OK) {

                        $address = result[0].address.address_name.split(" ");
                        $("#sido_gu").html($address[0] + "시 - " + $address[1]);
                        $("#sido").val($address[0]);
                        $("#gu").val($address[1]);
                        roomAjax($("#type").val());

                        // var detailAddr = !!result[0].road_address ? '<div>도로명주소 : ' + result[0].road_address.address_name + '</div>' : '';
                        // detailAddr += '<div>지번 주소 : ' + result[0].address.address_name + '</div>';
                        //
                        // var content = '<div class="bAddr">' +
                        //     '<span class="title">법정동 주소정보</span>' +
                        //     detailAddr +
                        //     '</div>';
                        //
                        // // 마커를 클릭한 위치에 표시합니다
                        marker.setPosition(mouseEvent.latLng);
                        marker.setMap(map);
                        //
                        // // 인포윈도우에 클릭한 위치에 대한 법정동 상세 주소정보를 표시합니다
                        // infowindow.setContent(content);
                        // infowindow.open(map, marker);
                    }
                });
            });

// 중심 좌표나 확대 수준이 변경됐을 때 지도 중심 좌표에 대한 주소 정보를 표시하도록 이벤트를 등록합니다
//             kakao.maps.event.addListener(map, 'idle', function () {
//                 searchAddrFromCoords(map.getCenter(), displayCenterInfo);
//             });

            function searchAddrFromCoords(coords, callback) {
                // 좌표로 행정동 주소 정보를 요청합니다
                geocoder.coord2RegionCode(coords.getLng(), coords.getLat(), callback);
            }

            function searchDetailAddrFromCoords(coords, callback) {
                // 좌표로 법정동 상세 주소 정보를 요청합니다
                geocoder.coord2Address(coords.getLng(), coords.getLat(), callback);
            }

// // 지도 좌측상단에 지도 중심좌표에 대한 주소정보를 표출하는 함수입니다
//             function displayCenterInfo(result, status) {
//                 if (status === kakao.maps.services.Status.OK) {
//                     var infoDiv = document.getElementById('centerAddr');
//
//                     for (var i = 0; i < result.length; i++) {
//                         // 행정동의 region_type 값은 'H' 이므로
//                         if (result[i].region_type === 'H') {
//                             infoDiv.innerHTML = result[i].address_name;
//                             break;
//                         }
//                     }
//                 }
//             }
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/isihyeon/Documents/GitHub/mo-zip/resources/views/product/goods.blade.php ENDPATH**/ ?>