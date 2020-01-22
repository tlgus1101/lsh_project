@extends('layouts.app')

@section('title')

@endsection

@section('style')
  <link rel="stylesheet" href="/css/auth.css">
@endsection

@section('content')
  <section class="probootstrap_section" style="background: #fff;">
    <div class="container">
      <div class="row join-row">
        <div class="col-md-12  probootstrap-animate" style="z-index: 9">
          <form class="probootstrap-form probootstrap-form-box mb60 text-center">
            <h4 class="mb-5">비밀번호 찾기</h4>
            <div class="sign-up-box text-left mb-3">
              <span class="login-info-text">가입하셨던 이메일 주소를 입력하시면 비밀번호 재설정 URL을 전송해드립니다.</span>
            </div>
            <div class="form-group">
              <label for="email" class="sr-only sr-only-focusable">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="이메일 주소" onchange="validationCheck();">
              <span id="email_text" class="login-error-info-text"></span>
            </div>
            <div class="form-group">
              <input type="button" class="btn btn-primary w-100" id="reg" name="reg" value="비밀번호 재설정 URL 보내기" disabled="disabled" onclick="sendMail();">
            </div>
            <div class="sign-up-box">
              <span class="login-info-text">비밀번호가 기억나시나요?</span>
              <a class="sign-up underline login-sub-text text-highlight" name="btn-join" href="/login">로그인</a>
            </div>
            <div class="sign-up-box">
              <span class="login-info-text">아직 모집 멤버가 아니세요?</span>
              <a class="sign-up underline login-sub-text text-highlight" name="btn-join" href="/register">회원가입</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- END section -->

@endsection

@section('scripts')
  <script>
      // 이메일 유효성 검사
      $('#email').on('keyup', function() {
          let param_email = $('#email').val();
          if (!param_email) {
              $('#email_text').text('이메일을 입력해 주세요.');
              validationCheck();
          } else if (!chkEmail(param_email)) {
              $('#email_text').text('올바른 이메일을 입력해 주세요.');
              validationCheck();
          } else {
              $('#email_text').text('');
              validationCheck();
          }
      });

      // 유효성 체크하고, 버튼 활성화
      function validationCheck() {
          let email                 = $('#email').val();

          if (email != '' && email != undefined) {
              $('#reg').prop('disabled', false);
          } else {
              $('#reg').prop('disabled', true);
          }
      }

      // 이메일 형식 체크
      function chkEmail(str) {
          let regExp = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

          if (regExp.test(str)) {
              return true;
          } else {
              return false;
          }
      }

      function sendMail() {
          $.ajax({
              url: '/verify/send',
              type: "post",
              dataType: "json", data: {
                  'email': $("#email").val(),
                  "_token": "{{{ csrf_token() }}}"
              },
          }).done(function (response) {
              var data = response.datas;
              if (data == 'ok') {
                  alert("가입된 이메일로 비밀번호 재설정 URL을 전송하였습니다.");
              } else {
                  alert("가입되지 않은 아이디입니다.");
              }

          });
      }
  </script>
@endsection
