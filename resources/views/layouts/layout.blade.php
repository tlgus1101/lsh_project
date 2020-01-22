<!DOCTYPE html>
<html lang="en">
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

<nav class="navbar navbar-expand-lg navbar-dark probootstrap_navbar" id="probootstrap-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="/" style="width: 30.5px;"></a>
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


<div class="mainpage-container container">
  <div class="main-item-container main-footer">
    <div class="pc">
      <div class="top">
        <div class="footerInfo-container">
          <div class="footerInfo-c-item-1">
            <div class="title display-6">회사소개</div>
            <a href="//mozip.quv.kr" target="_blank">서비스 소개</a></div>

          <div class="footerInfo-c-item-1">
            <div class="title display-6">파트너</div>
            <a href="//partner.mo-zip.co.kr/login" target="_blank">파트너 센터</a></div>

          <div class="footerInfo-c-item-2">
            <div class="title display-6">고객센터</div>
            {{--            <div><a href="#" target="_blank">FAQ</a></div>--}}
            <div><a href="{{ url('/agreement') }}" target="_blank">이용약관</a></div>
            <div><a href="{{ url('/privacy') }}" target="_blank">개인정보처리방침</a></div>
          </div>

          {{--          <div class="footerInfo-c-item-3">--}}
          {{--            <div class="title display-6">PAYMENT</div>--}}
          {{--            <div class="image-list">--}}
          {{--              <div class="image-item"><img src="https://d2mgzmtdeipcjp.cloudfront.net/files/upload/15452006422222.svg">--}}
          {{--              </div>--}}
          {{--              <div class="image-item"><img src="https://d2mgzmtdeipcjp.cloudfront.net/files/upload/15452006708461.svg">--}}
          {{--              </div>--}}
          {{--              <div class="image-item"><img src="https://d2mgzmtdeipcjp.cloudfront.net/files/upload/15452006841604.svg">--}}
          {{--              </div>--}}
          {{--            </div>--}}
          {{--          </div>--}}

          <div class="footerInfo-c-item-4">
            <div class="title display-6">SNS</div>
            <div class="image-list">
              <div class="image-item"><a href="//www.facebook.com/mozipplace" target="_blank"><img
                    src="//cloudfront.mo-zip.co.kr/mo-zip/images/facebook_btn.svg"></a></div>
              <div class="image-item"><a href="//www.instagram.com/mozip_place/" target="_blank"><img
                    src="//cloudfront.mo-zip.co.kr/mo-zip/images/instargram_btn.svg"></a></div>
              <div class="image-item"><a href="	//blog.naver.com/mo-zip" target="_blank"><img
                    src="//cloudfront.mo-zip.co.kr/mo-zip/images/blog_btn.svg"></a></div>
              <div class="image-item"><a href="	//story.kakao.com/mozip" target="_blank"><img
                    src="//cloudfront.mo-zip.co.kr/mo-zip/images/kakao_btn.svg"></a></div>
            </div>
          </div>
          <div class="footerInfo-c-item-5">
            <div class="title display-6">블루웹</div>
            <div class="form-group">
              <select class="form-control" onchange="window.open(this.value);">
                <option value="">FAMILY SITE</option>
                <option value="//www.blueweb.co.kr/">블루웹</option>
                <option value="//cookingm.blueweb.co.kr/">쿠킹엠</option>
                <option value="//total-yello.co.kr">토탈옐로</option>
                <option value="//bb.co.kr">가격비교 비비</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="bottom">
        <div class="footerText-container">
          <div class="left">
            <div>사업자등록증번호 : 106-81-85951</div>
            <div>통신판매업 신고번호 : 강남 3315호</div>
            <div>개인정보보호책임자 : 김경아</div>
            <div>전화번호 :02-3429-1910, 메일 : mozip@blueweb.co.kr</div>
          </div>
          <div class="right">
            <div>서울 성동구 성수일로8길 5 서울숲 SK V1 TOWER B동 3층</div>
            <div>대표이사 김남진</div>
          </div>
        </div>
      </div>
    </div>
    <div class="mobile">
      <div>
        <div class="footer-follow">
          <div class="footer-follow-text display-5 text-black">SNS</div>
          <div class="footer-follow-icon">
            <div class="image-items">
              <div class="image-item"><a href="//www.facebook.com/mozipplace" target="_blank"><img
                    src="//cloudfront.mo-zip.co.kr/mo-zip/images/facebook_btn.svg"></a></div>
              <div class="image-item"><a href="//www.instagram.com/mozip_place/" target="_blank"><img
                    src="//cloudfront.mo-zip.co.kr/mo-zip/images/instargram_btn.svg"></a></div>
              <div class="image-item"><a href="//blog.naver.com/mo-zip" target="_blank"><img
                    src="//cloudfront.mo-zip.co.kr/mo-zip/images/blog_btn.svg"></a></div>
              <div class="image-item"><a href="//story.kakao.com/mozip" target="_blank"><img
                    src="//cloudfront.mo-zip.co.kr/mo-zip/images/kakao_btn.svg"></a></div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="footer-info-text"><span class="display-6 text-black">㈜블루웹</span>
          {{--          <div class="content">블루웹은 통신판매 중개자로서 통신판매의 당사자가 아니며 상품의 예약, 이용 및 환불 등과 관련한 의무와 책임은 각 판매자에게 있습니다.</div>--}}
          <div class="ceo-name">대표이사 ┃ 김남진</div>
          <div class="footer-info-t-content">
            <div>서울 성동구 성수일로8길 5 서울숲 SK V1 TOWER B동 3층</div>

            <div class="reserved">사업자등록증번호 : 106-81-85951</div>
            <div>통신판매업 신고번호 : 강남 3315호</div>
            <div>개인정보보호책임자 : 김경아</div>
            <div>전화번호 :02-3429-1910, 메일 : mozip@blueweb.co.kr</div>
          </div>
        </div>
      </div>
      <div>
        <div class="footer-userref" style="background-color: transparent;">
          <div class="footer-btn mr-1">
            <a class="btn btn-primary text w-100" href="{{ url('/agreement') }}" target="_blank">이용약관</a>
          </div>
          <div class="footer-btn">
            <a class="btn btn-primary text w-100" href="{{ url('/privacy') }}" target="_blank">개인정보처리방침</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<footer class="probootstrap_section probootstrap-border-top footer-last pt-2 pb-0">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 text-center">
        <p class="footer-last-contents">© 2000-2019 BLUEWEB Corp. All rights reserved.
          <small>
          </small>
        </p>

      </div>
    </div>
  </div>
</footer>

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
            <input type="text" class="form-control" id="contact" maxlength="11" onkeypress="inputPhoneNumber(this)"
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
  @if(Auth::user()->email == "" || Auth::user()->contact == "")
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

  if (window.location.hash && window.location.hash == '#_=_') {
    window.location.hash = '';
  }
</script>

@yield('scripts', '')
</body>
</html>
