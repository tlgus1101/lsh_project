<?php $__env->startSection('title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="/css/auth.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="probootstrap_section" style="background: #fff;">
    <div class="container">
      <div class="row join-row">
        <div class="col-md-12  probootstrap-animate" style="z-index: 9">
          <form id="rForm" action="/store" method="post" class="probootstrap-form probootstrap-form-box mb60 text-center">

            <a class="col-md-12 navbar-brand mb-3" href="/" ><img src="//cloudfront.mo-zip.co.kr/mo-zip/images/logo-black.svg"
                                                                  class="logo-height" style="width: 100%" ></a>
            <div class="form-group">
              <label for="email" class="sr-only sr-only-focusable">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="이메일 주소" onchange="validationCheck();">
              <span id="email_text" class="login-error-info-text"></span>
            </div>
            <div class="form-group">
              <label for="password" class="sr-only sr-only-focusable">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="비밀번호(영문,숫자,특수문자( @#$%^&+= ) 8자리이상)">
              <span id="password_text" class="login-error-info-text"></span>
            </div>
            <div class="form-group">
              <label for="password-confirm" class="sr-only sr-only-focusable">Confirm-Password</label>
              <input type="password" class="form-control" id="password-confirm" name="password-confirm" placeholder="비밀번호 확인">
              <span id="password_confirm_text" class="login-error-info-text"></span>
            </div>
            <div class="form-group">
              <label for="name" class="sr-only sr-only-focusable">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="이름">
              <span id="name_text" class="login-error-info-text"></span>
            </div>
            <div class="sign-up-box">
              <label for="agree">
                <input type="checkbox" id="agree">
                <span class="login-info-text">이벤트 및 뉴스레터를 이메일로 받아 보겠습니다.</span>
              </label>
            </div>
            <div class="form-group">
              <input type="button" class="btn btn-primary w-100" id="reg" name="reg" value="회원가입" disabled="disabled">
            </div>
            <div class="sign-up-box text-left">
              <p class="login-info-text m-0">회원가입을 함으로써 모집의 <a class="sign-up underline login-sub-text text-highlight" name="btn-join" href="<?php echo e(url('/agreement')); ?>" target="_blank">이용약관</a>, <a class="sign-up underline login-sub-text text-highlight" name="btn-join" href="<?php echo e(url('/privacy')); ?>" target="_blank">개인정보보호정책</a> 에 동의하시게 됩니다.</p>
            </div>
            <p class="space_or"><span>또는</span></p>
            <div class="form-group">
              <a href="<?php echo e(url('/google/login')); ?>" id="google-login-btn" class="btn btn-primary btn_google"><span><i
                    class="icon-ic_login_google"></i> 회원가입</span></a>
            </div>
            <div class="form-group">
              <a href="<?php echo e(url('/facebook/login')); ?>" id="fb-login-btn" class="btn btn-primary btn_fb"><span><i
                    class="icon-ic_login_fb"></i> 회원가입</span></a>
            </div>
            <div class="form-group">
              <a href="<?php echo e(url('/kakao/login')); ?>" id="kakao-login-btn" class="btn btn-primary btn_kakao"><span><i
                    class="icon-ic_login_kakaotalk"></i> 회원가입</span></a>
            </div>
            <div class="form-group">
              <a href="<?php echo e(url('/naver/login')); ?>" id="naver-login-btn" class="btn btn-primary btn_naver"><span><i
                    class="icon-ic_login_naver"></i> 회원가입</span></a>
            </div>
            <div class="sign-up-box">
              <span class="login-info-text">이미 가입 하셨다구요?</span>
              <a class="sign-up underline login-sub-text text-highlight" name="btn-join" href="/login">로그인</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- END section -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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

    // 비밀번호 유효성 검사
    $('#password').on('keyup', function() {
      let param_password = $('#password').val();
      if (!param_password) {
        $('#password_text').text('비밀번호를 입력해 주세요.');
        validationCheck();
      } else if (!chkPasswd(param_password)) {
          $('#password_text').text('올바른 비밀번호를 입력해 주세요.');
        validationCheck();
      } else {
        $('#password_text').text('');
        validationCheck();
      }
    });

    // 비밀번호 확인 유효성 검사
    $('#password-confirm').on('keyup', function() {
      let param_password_confirm = $('#password-confirm').val();
      if (!param_password_confirm) {
        $('#password_confirm_text').text('비밀번호를 입력해 주세요.');
        validationCheck();
      } else if (param_password_confirm != $('#password').val()) {
        $('#password_confirm_text').text('위 비밀번호와 동일하게 입력해 주세요.');
        validationCheck();
      } else {
        $('#password_confirm_text').text('');
        validationCheck();
      }
    });

    // 이름 유효성 검사
    $('#name').on('keyup', function() {
      let param_name = $('#name').val();
      if (!param_name) {
        $('#name_text').text('이름을 입력해 주세요.');
        validationCheck();
      } else {
        $('#name_text').text('');
        validationCheck();
      }
    });

    // 유효성 체크하고, 버튼 활성화
    function validationCheck() {
      let email                 = $('#email').val();
      let password              = $('#password').val();
      let password_confirm      = $('#password-confirm').val();
      let name                  = $('#name').val();
      let email_text            = $('#email_text').text();
      let password_text         = $('#password_text').text();
      let password_confirm_text = $('#password_confirm_text').text();
      let name_text             = $('#name_text').text();

      if (email != '' && email != undefined && email_text == ''
          && password != '' && password != undefined && password_text == ''
          && password_confirm != '' && password_confirm != undefined && password_confirm_text == ''
          && name != '' && name != undefined && name_text == '') {
          $('#reg').prop('disabled', false);
      } else {
        $('#reg').prop('disabled', true);
      }
    }

    // 파라미터 체크
    $('#reg').on('click', function() {
      let param_email        = $('#email').val();
      let param_pass         = $('#password').val();
      //let param_pass_confirm = $('#password-confirm').val();
      let param_name         = $('#name').val();
      let param_agree        = $("#agree").is(":checked");

      $.ajax({
        url: '/store',
        type: "POST",
        dataType: "json",
        data: {
          'email'    : param_email,
          'password' : param_pass,
          'name'     : param_name,
          'agree'    : param_agree,
          "_token"   : "<?php echo e(csrf_token()); ?>"
        },
      }).done(function (response) {
        if (!$.isEmptyObject(response.error)) {
          let errorMsg = response.error[0];
          let errorMsgSplit = errorMsg.split(' ');
          if (errorMsgSplit[0] == 'email') {
            alert('입력하신 이메일은 이미 사용 중입니다.');
            $('#email').val('');
            return false;
          }
        } else if (response.status == 'OK'){
          location.href = '/';
        } else {
          alert('에러가 발생하였습니다. 고객센터로 문의 바랍니다.');
        }
      });
    });

    // 이메일 형식 체크
    function chkEmail(str) {
      let regExp = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

      if (regExp.test(str)) {
        return true;
      } else {
        return false;
      }
    }

    // 패스워드 형식 체크
    function chkPasswd(str) {
      let regExp = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;
      if (regExp.test(str)) {
        return true;
      } else {
        return false;
      }
    }

  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/isihyeon/Documents/GitHub/mo-zip/resources/views/auth/register.blade.php ENDPATH**/ ?>