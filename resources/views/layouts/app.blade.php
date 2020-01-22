<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>@yield('title', 'MOZ!P | 모든예약집합소!')</title>
  <meta name="description" content="Free Bootstrap 4 Theme by uicookies.com">
  <meta name="keywords"
        content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

  <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,700" rel="stylesheet">

  <link rel="stylesheet" href="/css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="/css/animate.css">
  <link rel="stylesheet" href="/fonts/ionicons/css/ionicons.min.css">

  <link rel="stylesheet" href="/css/owl.carousel.min.css">

  <link rel="stylesheet" href="/fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="/fonts/iconsmind-s/css/iconsminds.css"/>
  <link rel="stylesheet" href="/fonts/simple-line-icons/css/simple-line-icons.css"/>

  <link rel="stylesheet" href="/fonts/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="/css/select2.css">

  <link rel="stylesheet" href="/css/helpers.css">
  <link rel="stylesheet" href="/css/style.css">

  @yield('style')
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark probootstrap_navbar d-block d-lg-none" id="probootstrap-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="javascript:history.back();"><img
        src="//cloudfront.mo-zip.co.kr/mo-zip/images/pre_button.svg" class="pre-btn"></a>
    <a class="navbar-brand" href="/"><img src="//cloudfront.mo-zip.co.kr/mo-zip/images/logo-white.svg"
                                          class="logo-height"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#probootstrap-menu"
            aria-controls="probootstrap-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span><i class="ion-navicon"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="probootstrap-menu">
      <ul class="navbar-nav ml-auto">
        @if (Auth::check())
          <li class="nav-item"><a class="nav-link" href="{{ url('/reservation') }}">예약내역</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/information') }}">내 정보</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}">로그아웃</a></li>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">예약내역</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">로그인</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>
<!-- END nav -->

<nav class="navbar navbar-expand-lg navbar-dark probootstrap_navbar d-none d-lg-inline-block" id="probootstrap-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><img src="//cloudfront.mo-zip.co.kr/mo-zip/images/logo-white.svg"
                                          class="logo-height"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#probootstrap-menu"
            aria-controls="probootstrap-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span><i class="ion-navicon"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="probootstrap-menu">
      <ul class="navbar-nav ml-auto">
        @if (Auth::check())
          <li class="nav-item"><a class="nav-link" href="{{ url('/reservation') }}">예약내역</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/information') }}">내 정보</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}">로그아웃</a></li>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">예약내역</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">로그인</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>


<!-- END nav -->


@yield('content')

<div class="modal fade" id="emailckModal" tabindex="-1" role="dialog" aria-labelledby="emailckModalLabel"
     aria-hidden="true">
  <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="emailckModalLabel">회원 정보 저장</h5>
      </div>
      <div class="modal-body">
        <span class="detail-contents"> * 안전한 거래를 위하여 회원님의 이메일과 전화번호를 입력 부탁드립니다.</span>
        <div class="form-group" id='ct_confirm'></div>
        <div class="form-group">
          <label for="email" class="sr-only sr-only-focusable">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="이메일 주소"
          >
          <span id="email_text" class="login-info-text"></span>
        </div>
        <div class="form-group" id='contact_confirm'>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="contact"  maxlength="11" onkeypress="inputPhoneNumber(this)"
                   name="contact" placeholder="휴대전화번호">
          </div>
        </div>
        <div class="mb-3">
          <button type="button" class="btn btn-primary w-100" onclick="userInfoSave()">정보 저장</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/js/jquery.min.js"></script>

<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/owl.carousel.min.js"></script>

<script src="/js/bootstrap-datepicker.js"></script>
<script src="/js/jquery.waypoints.min.js"></script>
<script src="/js/jquery.easing.1.3.js"></script>

<script src="/js/select2.min.js"></script>
<script src="/js/main.js"></script>


<script>
  @if (Auth::check())
  @if(Auth::user()->email == "" || Auth::user()->contact == "" )
  $("#email").val("{{ Auth::user()->email }}");
  $("#contact").val("{{ Auth::user()->contact }}");
  $("#emailckModal").modal({backdrop: 'static'});

  @endif
  @endif
  function userInfoSave() {
      if ($("#email").val() == "") {
          alert('이메일을 입력해 주세요.');
          $("#email").focus();
          return false;
      }
      if ($("#contact").val() == "") {
          alert('전화번호를 입력해 주세요.');
          $("#contact").focus();
          return false;
      }
      $.ajax({
          url: '/userinfosave',
          type: "POST",
          dataType: "json",
          data: {
              "email": $("#email").val(),
              "contact": $("#contact").val(),
              "_token": "{{{ csrf_token() }}}"
          },
      }).done(function (response) {
          if (response.result == 0) {
              alert("정보입력을 실패 하였습니다.");
          } else {
              alert("정보입력을 성공 하였습니다.");
              $("#emailckModal").modal('hide');
          }
      });
  }
  // 휴대폰번호
  function inputPhoneNumber(obj) {
      $("#ct_confirm").html("");
      var number = $(obj).val().replace(/[^0-9]/g, "");
      var phone = "";
      $(obj).val(number.replace(/[^0-9]/g, ""));

      if (number.length < 4) {
          return number;
      } else if (number.length < 7) {
          phone += number.substr(0, 3);
          phone += number.substr(3);
      } else if (number.length < 11) {
          phone += number.substr(0, 3);
          phone += number.substr(3, 3);
          phone += number.substr(6);
      } else {
          phone += number.substr(0, 3);
          phone += number.substr(3, 4);
          phone += number.substr(7);
      }
      $(obj).val(phone);
  }
</script>

@yield('scripts', '')
</body>
</html>
