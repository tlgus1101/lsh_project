@extends('layouts.app')

@section('title')

@endsection

@section('style')
  <link rel="stylesheet" href="/css/slick.css">
  <link rel="stylesheet" href="/css/daterangepicker.css">
  <link rel="stylesheet" href="/css/swiper.min.css">
  <link rel="stylesheet" href="/css/product.css">
@endsection

@section('content')

  <section class="probootstrap-cover overflow-hidden relative"
           style="background-image: url('//cloudfront.mo-zip.co.kr/mo-zip/images/recommend_1.jpg'); padding: 2em 0 0"
           data-stellar-background-ratio="0.5"
           id="section-home">
    <div class="overlay"></div>
    <div class="container">
      <div class="row align-items-center text-center">
        <div class="col-md">
          <p class="lead mb-5 probootstrap-animate" style="margin: 0 !important;">
            <a href="#" data-toggle="modal" data-target="#mapModal" class="basic-a-color" data-backdrop="static"
               onclick="mapModal();">다른지역보기
              <i class="fa fa-angle-down"></i></a></p>
          <h2 class="heading mb-2 display-5 font-light probootstrap-animate" id="sido_gu">서울 - 강남구</h2>
        </div>
      </div>
    </div>

  </section>
  <!-- END section -->

  <section>
    <div class="container">
      <div class="sub-header">
        <div class="swipe-tabs">
          <div class="swipe-tab" onclick="roomAjax('모텔',0,'','')">모텔</div>
          <div class="swipe-tab" onclick="roomAjax('호텔',1,'','')">호텔</div>
          <div class="swipe-tab" onclick="roomAjax('펜션',2,'','')">펜션</div>
          <div class="swipe-tab" onclick="roomAjax('글램핑',3,'','')">글램핑</div>
          <div class="swipe-tab" onclick="roomAjax('공간대여',4,'','')">공간대여</div>
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

  <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">지도</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="padding: 0.25rem 0.75rem;">×</span>
          </button>
          <button class="btn icon-button" id="resizeMap" onclick="reSize();">
            <i class="simple-icon-refresh"></i>
          </button>
        </div>
        <div class="modal-body" id="map">
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script src="/js/slick.min.js"></script>
  <script src="/js/moment.min.js"></script>
  <script src="/js/daterangepicker.js"></script>
  <script src="/js/swiper.min.js"></script>
  <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
  <script type="text/javascript"
          src="//dapi.kakao.com/v2/maps/sdk.js?appkey=18f674405264089485c0e9db6bbaf2ef&libraries=services"></script>
  <script>
      var dg = {
          "서울": "seoul.jpg",
          "경기": "gyeonggi-do.jpg",
          "인천": "gyeonggi-do.jpg",
          "강원": "Gangwon-do.jpg",
          "충남": "chungcheong-do.jpg",
          "충북": "chungcheong-do.jpg",
          "대전": "chungcheong-do.jpg",
          "경북": "Gyeongsang-do.jpg",
          "경남": "Gyeongsang-do.jpg",
          "대구": "Gyeongsang-do.jpg",
          "울산": "Gyeongsang-do.jpg",
          "부산": "Gyeongsang-do.jpg",
          "전북": "jeolla-do.jpg",
          "전남": "jeolla-do.jpg",
          "광주": "jeolla-do.jpg",
          "제주특별자치도": "jeju-do.jpg",
      };

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
              var idx = '0';
              if (sessionStorage.getItem('idx') != "") {
                  idx = sessionStorage.getItem('idx');
              }

              $('.swipe-tab[data-slick-index=' + idx + ']').addClass(activeTabClassName);
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

          if ("{{ $sido }}" != "") {
              //input 값이 있고 세션 값이 있을경우 세션 값에 존재하는 데이터 저장
              if (sessionStorage.getItem('sido') != "") {
                  $("#sido").val(sessionStorage.getItem('sido'));
                  $("#gu").val(sessionStorage.getItem('sigungu'));
                  $("#sido_gu").html(sessionStorage.getItem('sido') + " - " + sessionStorage.getItem('sigungu'));
                  roomAjax(sessionStorage.getItem('type'), sessionStorage.getItem('idx'), sessionStorage.getItem('sido'), sessionStorage.getItem('sigungu'));
                  var url = "url('//cloudfront.mo-zip.co.kr/mo-zip/images/" + dg[sessionStorage.getItem('sido')] + "')";
                  $("#section-home").css("background-image", url);
              } else {//input 값이 있고 세션 값이 없을경우 세로 저장 하는 데이터 저장
                  $("#sido").val("{{ $sido }}");
                  $("#gu").val("{{ $sigungu }}");
                  $("#sido_gu").html("{{ $sido }}" + " - " + "{{ $sigungu }}");
                  roomAjax(sessionStorage.getItem('type'), sessionStorage.getItem('idx'), "{{ $sido }}", "{{ $sigungu }}");
                  var url = "url('//cloudfront.mo-zip.co.kr/mo-zip/images/" + dg["{{ $sido }}"] + "')";
                  $("#section-home").css("background-image", url);
              }
          } else if (sessionStorage.getItem('sido') != "") {
              $("#sido").val(sessionStorage.getItem('sido'));
              $("#gu").val(sessionStorage.getItem('sigungu'));
              $("#sido_gu").html(sessionStorage.getItem('sido') + " - " + sessionStorage.getItem('sigungu'));
              roomAjax(sessionStorage.getItem('type'), sessionStorage.getItem('idx'), sessionStorage.getItem('sido'), sessionStorage.getItem('sigungu'));
              var url = "url('//cloudfront.mo-zip.co.kr/mo-zip/images/" + dg[sessionStorage.getItem('sido')] + "')";
              $("#section-home").css("background-image", url);
          } else {//input 값이 없을 경우 미리 저장 되어 있는 데이터 값으로 불러오기
              var url = "url('//cloudfront.mo-zip.co.kr/mo-zip/images/" + dg[$("#sido").val()] + "')";
              $("#section-home").css("background-image", url);
              roomAjax("{{ $type }}", sessionStorage.getItem('idx'), $("#sido").val(), $("#gu").val());
          }
          ThumbnailOpacity();

          $.getJSON("js/TL_SCCO_SIG.json", function (geojson) {
              var data = geojson.features;
              var coordinates = [];    //좌표 저장할 배열
              var name = '';            //행정 구 이름

              $.each(data, function (index, val) {
                  coordinates = val.geometry.coordinates;
                  name = val.properties.SIG_KOR_NM;
                  displayArea(coordinates, name);
              });
          });
      });

      function roomAjax(type, idx, sido, gu) {
          if (sido == "") {
              sido = $("#sido").val();
              gu = $("#gu").val();
          }
          //버튼이나 지도를 눌렀을 경우에만 세션 값 저장
          sessionStorage.setItem('type', type);
          sessionStorage.setItem('idx', idx);
          sessionStorage.setItem('sido', sido);
          sessionStorage.setItem('sigungu', gu);

          $("#type").val(type);
          $.ajax({
              url: '/community',
              type: "post",
              dataType: "json", data: {
                  'json': true,
                  'type': type,
                  'idx': idx,
                  'sido': sido,
                  'sigungu': gu,
                  "_token": "{{{ csrf_token() }}}"
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

      function homepageLink(link) {
          window.open(link, '_blank');
      }

      ////////////////지도를 생성합니다   지도 json(구역 위도 경도) : https://neurowhai.tistory.com/350   지도 폴리곤(구역 도형) 이벤트 : https://jjjayyy.tistory.com/9
      var mapContainer = document.getElementById('map'), // 지도를 표시할 div
          mapOption = {
              center: new kakao.maps.LatLng(127.0326938421173, 127.04737740838436), // 지도의 중심좌표
              level: 7 // 지도의 확대 레벨
          };
      var map = new kakao.maps.Map(mapContainer, mapOption);
      var marker = new kakao.maps.Marker(), // 클릭한 위치를 표시할 마커입니다
          infowindow = new kakao.maps.InfoWindow({zindex: 1}); // 클릭한 위치에 대한 주소를 표시할 인포윈도우입니다

      function mapModal() {
          setTimeout(function () {
              reSize();
          }, 300);
      }

      function reSize() { //지도 크기 수동 변경
          mapInit($("#gu").val());
          map.relayout();
      }

      // var customOverlay = new kakao.maps.CustomOverlay({
      //     map: map,
      //     clickable: true,
      //     fillColor: '#004c80',
      //     xAnchor: 0.5,
      //     yAnchor: 1,
      //     zIndex: 3
      // });
      var polygons = [];                //function 안 쪽에 지역변수로 넣으니깐 폴리곤 하나 생성할 때마다 배열이 비어서 클릭했을 때 전체를 못 없애줌.  그래서 전역변수로 만듦.

      function mapInit(address) {
          // 주소-좌표 변환 객체를 생성합니다
          var geocoder = new kakao.maps.services.Geocoder();

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
                  map.setCenter(coords);
                  console.log(map);
                  // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
                  marker.setPosition(new kakao.maps.LatLng(result[0].y, result[0].x));
                  marker.setMap(map);
              }
          });

          // 지도를 클릭했을 때 클릭 위치 좌표에 대한 주소정보를 표시하도록 이벤트를 등록합니다
          kakao.maps.event.addListener(map, 'click', function (mouseEvent) {
              searchDetailAddrFromCoords(mouseEvent.latLng, function (result, status) {
                  if (status === kakao.maps.services.Status.OK) {
                      $address = result[0].address.address_name.split(" ");
                      var url = "url('//cloudfront.mo-zip.co.kr/mo-zip/images/" + dg[$address[0]] + "')";
                      $("#section-home").css("background-image", url);
                      $("#sido_gu").html($address[0] + " - " + $address[1]);
                      $("#sido").val($address[0]);
                      $("#gu").val($address[1]);
                      sessionStorage.setItem('sido', $address[0]);
                      sessionStorage.setItem('sigungu', $address[1]);
                      roomAjax(sessionStorage.getItem('type'), sessionStorage.getItem('idx'), $("#sido").val(), $("#gu").val());

                      // // 마커를 클릭한 위치에 표시합니다
                      // marker.setPosition(mouseEvent.latLng);
                      // marker.setMap(map);
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


      //행정구역 구분
      var polygons = [];                //function 안 쪽에 지역변수로 넣으니깐 폴리곤 하나 생성할 때마다 배열이 비어서 클릭했을 때 전체를 못 없애줌.  그래서 전역변수로 만듦.
      var customOverlayList = [];

      //행정구역 폴리곤
      function displayArea(coordinates, name) {
          var path = [];            //폴리곤 그려줄 path
          var points = [];        //중심좌표 구하기 위한 지역구 좌표들
          var polygon = "";
          var customOverlay = "";

          $.each(coordinates[0], function (index, coordinate) {        //console.log(coordinates)를 확인해보면 보면 [0]번째에 배열이 주로 저장이 됨.  그래서 [0]번째 배열에서 꺼내줌.
              var point = new Object();
              point.x = coordinate[1];
              point.y = coordinate[0];
              points.push(point);
              path.push(new kakao.maps.LatLng(coordinate[1], coordinate[0]));
              //new daum.maps.LatLng가 없으면 인식을 못해서 path 배열에 추가
          });
          customOverlay = new kakao.maps.CustomOverlay({
              map: map,
              fillColor: '#004c80',
              xAnchor: 0.5,
              yAnchor: 1,
              zIndex: 1
          });
          //폴리곤 가운대에 구 이름 저장 하는 부분
          customOverlay.setContent('<div style="color:#004c80; font-weight: bold; font-size: 1rem;">' + name + '</div>');
          customOverlay.setPosition(centroid(points));
          //new kakao.maps.LatLng(path[0]["Ha"],path[0]["Ga"])
          //customOverlayList.push(customOverlay.setMap(map));
          customOverlay.setMap(map);

          // 다각형을 생성합니다
          polygon = new kakao.maps.Polygon({
              map: map, // 다각형을 표시할 지도입니다
              path: path, // 다각형을 구성하는 좌표 배열입니다 클릭한 위치를 넣어줍니다
              strokeWeight: 2, // 선의 두께입니다
              strokeColor: '#004c80', // 선의 색깔입니다
              strokeOpacity: 0.5, // 선의 불투명도입니다 0에서 1 사이값이며 0에 가까울수록 투명합니다
              strokeStyle: 'solid', // 선의 스타일입니다
              fillColor: '#fff', // 채우기 색깔입니다
              fillOpacity: 0.5, // 채우기 불투명도입니다
          });
          polygons.push(polygon);  //폴리곤 제거하기 위한 배열
          // // 다각형에 mouseover 이벤트를 등록하고 이벤트가 발생하면 폴리곤의 채움색을 변경합니다
          // // 지역명을 표시하는 커스텀오버레이를 지도위에 표시합니다
          kakao.maps.event.addListener(polygon, 'mouseover', function (mouseEvent) {
              polygon.setOptions({
                  fillColor: '#09f'
              });
              // customOverlay.setContent('<div class="mb-1" style="color:#004c80; font-weight: bold; font-size: 1.5rem;">' + name + '</div>');
              // customOverlay.setPosition(mouseEvent.latLng);
              // customOverlay.setMap(map);
          });
          kakao.maps.event.addListener(customOverlay, 'mouseover', function (mouseEvent) {
              console.log(customOverlay);
              polygon.setOptions({
                  fillColor: '#09f'
              });
          });
          //
          // // 다각형에 mousemove 이벤트를 등록하고 이벤트가 발생하면 커스텀 오버레이의 위치를 변경합니다
          kakao.maps.event.addListener(polygon, 'mousemove', function (mouseEvent) {
              //customOverlay.setPosition(mouseEvent.latLng);
          });

          // 다각형에 mouseout 이벤트를 등록하고 이벤트가 발생하면 폴리곤의 채움색을 원래색으로 변경합니다
          // 커스텀 오버레이를 지도에서 제거합니다
          kakao.maps.event.addListener(polygon, 'mouseout', function () {
              polygon.setOptions({
                  fillColor: '#fff'
              });
              //customOverlay.setMap(null);
          });
      }

      //centroid 알고리즘 (폴리곤 중심좌표 구하기 위함)
      function centroid(points) {
          var i, j, len, p1, p2, f, area, x, y;
          area = x = y = 0;
          //customOverlayList.push(customOverlay.setMap(map));
          for (i = 0, len = points.length, j = len - 1; i < len; j = i++) {
              p1 = points[i];
              p2 = points[j];
              f = p1.y * p2.x - p2.y * p1.x;
              x += (p1.x + p2.x) * f;
              y += (p1.y + p2.y) * f;
              area += f * 3;
          }
          return new kakao.maps.LatLng(x / area - 0.0002, y / area - 0.002);
      }

      function addWishlist(login, wish, id) {

          if (login == "false") {
              alert("로그인이 필요합니다. \n로그인 페이지로 이동합니다.");
              window.location = "https://mo-zip.co.kr/login";
          }

          $.ajax({
              url: '/community/wish',
              type: "post",
              dataType: "json", data: {
                  'wish': wish,
                  'id' : id,
                  "_token": "{{{ csrf_token() }}}"
              },
          }).done(function (response) {
              var data = response.datas;
              $("#wish" + id).html(data);
          });
      }

  </script>


  {{--지도 원본--}}
  {{--    <script>--}}

  {{--        //행정구역 구분--}}
  {{--        $.getJSON("resources/json/seoul_gson.geojson", function(geojson) {--}}

  {{--            var data = geojson.features;--}}
  {{--            var coordinates = [];    //좌표 저장할 배열--}}
  {{--            var name = '';            //행정 구 이름--}}

  {{--            $.each(data, function(index, val) {--}}

  {{--                coordinates = val.geometry.coordinates;--}}
  {{--                name = val.properties.SIG_KOR_NM;--}}

  {{--                displayArea(coordinates, name);--}}

  {{--            })--}}
  {{--        })--}}


  {{--        var polygons=[];                //function 안 쪽에 지역변수로 넣으니깐 폴리곤 하나 생성할 때마다 배열이 비어서 클릭했을 때 전체를 못 없애줌.  그래서 전역변수로 만듦.--}}

  {{--        //행정구역 폴리곤--}}
  {{--        function displayArea(coordinates, name) {--}}

  {{--            var path = [];            //폴리곤 그려줄 path--}}
  {{--            var points = [];        //중심좌표 구하기 위한 지역구 좌표들--}}

  {{--            $.each(coordinates[0], function(index, coordinate) {        //console.log(coordinates)를 확인해보면 보면 [0]번째에 배열이 주로 저장이 됨.  그래서 [0]번째 배열에서 꺼내줌.--}}
  {{--                var point = new Object();--}}
  {{--                point.x = coordinate[1];--}}
  {{--                point.y = coordinate[0];--}}
  {{--                points.push(point);--}}
  {{--                path.push(new daum.maps.LatLng(coordinate[1], coordinate[0]));            //new daum.maps.LatLng가 없으면 인식을 못해서 path 배열에 추가--}}
  {{--            })--}}

  {{--            // 다각형을 생성합니다--}}
  {{--            var polygon = new daum.maps.Polygon({--}}
  {{--                map : map, // 다각형을 표시할 지도 객체--}}
  {{--                path : path,--}}
  {{--                strokeWeight : 2,--}}
  {{--                strokeColor : '#004c80',--}}
  {{--                strokeOpacity : 0.8,--}}
  {{--                fillColor : '#fff',--}}
  {{--                fillOpacity : 0.7--}}
  {{--            });--}}

  {{--            polygons.push(polygon);            //폴리곤 제거하기 위한 배열--}}

  {{--            // 다각형에 mouseover 이벤트를 등록하고 이벤트가 발생하면 폴리곤의 채움색을 변경합니다--}}
  {{--            // 지역명을 표시하는 커스텀오버레이를 지도위에 표시합니다--}}
  {{--            daum.maps.event.addListener(polygon, 'mouseover', function(mouseEvent) {--}}
  {{--                polygon.setOptions({--}}
  {{--                    fillColor : '#09f'--}}
  {{--                });--}}

  {{--                customOverlay.setContent('<div class="area">' + name + '</div>');--}}

  {{--                customOverlay.setPosition(mouseEvent.latLng);--}}
  {{--                customOverlay.setMap(map);--}}
  {{--            });--}}

  {{--            // 다각형에 mousemove 이벤트를 등록하고 이벤트가 발생하면 커스텀 오버레이의 위치를 변경합니다--}}
  {{--            daum.maps.event.addListener(polygon, 'mousemove', function(mouseEvent) {--}}

  {{--                customOverlay.setPosition(mouseEvent.latLng);--}}
  {{--            });--}}

  {{--            // 다각형에 mouseout 이벤트를 등록하고 이벤트가 발생하면 폴리곤의 채움색을 원래색으로 변경합니다--}}
  {{--            // 커스텀 오버레이를 지도에서 제거합니다--}}
  {{--            daum.maps.event.addListener(polygon, 'mouseout', function() {--}}
  {{--                polygon.setOptions({--}}
  {{--                    fillColor : '#fff'--}}
  {{--                });--}}
  {{--                customOverlay.setMap(null);--}}
  {{--            });--}}

  {{--            // 다각형에 click 이벤트를 등록하고 이벤트가 발생하면 해당 지역 확대을 확대합니다.--}}
  {{--            daum.maps.event.addListener(polygon, 'click', function() {--}}

  {{--                // 현재 지도 레벨에서 2레벨 확대한 레벨--}}
  {{--                var level = map.getLevel()-2;--}}

  {{--                // 지도를 클릭된 폴리곤의 중앙 위치를 기준으로 확대합니다--}}
  {{--                map.setLevel(level, {anchor: centroid(points), animate: {--}}
  {{--                        duration: 350            //확대 애니메이션 시간--}}
  {{--                    }});--}}

  {{--                deletePolygon(polygons);                    //폴리곤 제거--}}
  {{--            });--}}
  {{--        }--}}
  {{--        </sciprt>--}}


@endsection
