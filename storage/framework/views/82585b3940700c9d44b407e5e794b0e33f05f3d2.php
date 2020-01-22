<?php $__env->startSection('style'); ?>
  
  
  <link rel="stylesheet" href="/css/auth.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="probootstrap_section" style="background: #fff;">
    <div class="container">
      <div class="row login-row">
        <div class="col-md-12  probootstrap-animate">
          <form action="/reset/update" method="post"
                class="probootstrap-form probootstrap-form-box mb60 text-center">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="token" value="<?php echo e($data->password_token); ?>">
            <h4 class="mb-5">비밀번호 재설정</h4>
            <div class="form-group">
              <label for="password" class="sr-only sr-only-focusable">Password</label>
              <input type="password" class="form-control is-invalid" id="password"
                     name="password" placeholder="새 비밀번호(영문,숫자,특수문자 8자리이상)">
              <span id="password_text" class="login-error-info-text col-md-9 text-md-right"></span>
            </div>
            <div class="form-group">
              <label for="password" class="sr-only sr-only-focusable">Password</label>
              <input type="password" class="form-control" id="password_confirm" placeholder="새 비밀번호 확인"
                     name="password_confirm" >
              <span id="password_confirm_text" class="login-error-info-text col-md-9  text-md-right"></span>
            </div>
            <div class="form-group">
              <input type="submit" id="reg" class="btn btn-primary w-100" disabled="true" value="비밀번호 변경">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script>

      $(function () {
          // 비밀번호 유효성 검사
          $('#password').on('keyup', function () {
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
          $('#password_confirm').on('keyup', function () {
              let param_password_confirm = $('#password_confirm').val();
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
      });

      // 패스워드 형식 체크
      function chkPasswd(str) {
          let regExp = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

          if (regExp.test(str)) {
              return true;
          } else {
              return false;
          }
      }

      // 유효성 체크하고, 버튼 활성화
      function validationCheck() {
          let password = $('#password').val();
          let password_confirm = $('#password_confirm').val();
          let password_text = $('#password_text').text();
          let password_confirm_text = $('#password_confirm_text').text();

          if (password != '' && password != undefined && password_text == ''
              && password_confirm != '' && password_confirm != undefined && password_confirm_text == '') {
              $('#reg').prop('disabled', false);
          } else {
              $('#reg').prop('disabled', true);
          }
      }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/isihyeon/Documents/GitHub/mo-zip/resources/views/auth/passwords/reset.blade.php ENDPATH**/ ?>