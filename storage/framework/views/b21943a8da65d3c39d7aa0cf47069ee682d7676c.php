<?php $__env->startSection('title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="/css/slick.css">
  <link rel="stylesheet" href="/css/daterangepicker.css">
  <link rel="stylesheet" href="/css/swiper.min.css">
  <link rel="stylesheet" href="/css/product.css">
  <link rel="stylesheet" href="/css/calendar.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <section class="probootstrap-cover overflow-hidden relative"
           style="background-image: url('<?php echo e($partner->partner_image_route . $partner->partner_image_save_name); ?>'); padding: 2em 0 0"
           data-stellar-background-ratio="0.5"
           id="section-home">
    <div class="overlay"></div>
    <div class="container top-container">
      <div class="row align-items-center text-center">
        <div class="col-md">
          <h2 class="heading mb-2 display-5 font-light probootstrap-animate"><?php echo e($partner->name); ?></h2>
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

  <section class="probootstrap_section probootstrap_lg_pt-50" id="section-city-guides" >
    <div class="container" id="roomList">
    </div>
  </section>
  <!-- END section -->
  </div>






































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

  <script src="/js/calendar.js"></script>

  <script>
    // var open=false;
    //   $('#openCal').click(function () {
    //       if(open == true){
    //           $('#cal').addClass("fade");
    //       }else{
    //           $('#cal').removeClass("fade");
    //       }
    //           open=!open;
    //   });

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


  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/isihyeon/Documents/GitHub/mo-zip/resources/views/product/detail.blade.php ENDPATH**/ ?>