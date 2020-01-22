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
           style="background-image: url('//cloudfront.mo-zip.co.kr/mo-zip/images/reserve_img.jpg'); padding: 2em 0 0"
           data-stellar-background-ratio="0.5"
           id="section-home">
    <div class="overlay"></div>
    <div class="container">
      <div class="row align-items-center text-center">
        <div class="col-md">
          <div class="dropdown">
            <a class="basic-a-color" id="dropdownMenuLink" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">다른정보 보기 <i class="fa fa-angle-down"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="/information">내정보</a>
              <a class="dropdown-item" href="/reservation">예약내역</a>
              <a class="dropdown-item" href="/question">1:1 문의</a>
              <a class="dropdown-item" href="/wishlist">위시리스트</a>
            </div>
          </div>
          <h2 class="heading mb-2 display-5 font-light probootstrap-animate">위시리스트</h2>
        </div>
      </div>
    </div>
    <section class="probootstrap_section probootstrap_lg_pt-50" id="section-city-guides">
      <div class="container" id="roomList">
      </div>
    </section>
  </section>
@endsection

@section('scripts')
  <script src="/js/slick.min.js"></script>
  <script src="/js/moment.min.js"></script>
  <script src="/js/daterangepicker.js"></script>
  <script src="/js/swiper.min.js"></script>
  <script>
      $(function () {
         roomAjax();
      });
      function roomAjax() {
          $.ajax({
              url: '/wishlist',
              type: "get",
              dataType: "json", data: {
                  'json': true,
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
          });
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
              roomAjax();
          });
      }
     </script>
@endsection
