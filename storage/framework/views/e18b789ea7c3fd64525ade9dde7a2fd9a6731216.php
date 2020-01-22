<?php $__env->startSection('title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="/css/my.css">
  <link rel="stylesheet" href="/css/product.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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
              <a class="dropdown-item" href="/information">내 정보</a>
              <a class="dropdown-item" href="/reservation">예약내역</a>
              <a class="dropdown-item" href="/question">1:1 문의</a>
              <a class="dropdown-item" href="/wishlist">위시리스트</a>
            </div>
          </div>
          <h2 class="heading mb-2 display-5 font-light probootstrap-animate">내 정보</h2>
        </div>
      </div>
    </div>
  </section>


  <!-- END section -->
  <?php if(Auth::user()->route == "mozip"): ?>
    <section class="probootstrap_section" id="section-login"
             style="/*background-image: url('/images/brand_bg.jpg');*/ background: #fff;">
      <div class="container">
        <div class="row join-row" id="informationcom">
          <div class="col-md-12  probootstrap-animate" style="z-index: 9">
            <form action="javascript:show()"
                  class="probootstrap-form probootstrap-form-box mb60 text-center">
              <div class="col-md-12  probootstrap-animate" style="z-index: 9">
                <h4 class="mb-5">비밀번호 확인</h4>
                <div class="form-group">
                  <label for="password" class="sr-only sr-only-focusable">Password</label>
                  <input type="password" class="form-control" id="password" name="password"
                         placeholder="비밀번호">
                  <span id="password_text" class="login-info-text"></span>
                </div>
                <div class="form-group">
                  <input type="button" onclick="show('');"
                         class="btn btn-primary w-100" value="정보변경">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  <?php else: ?>
    <div class="container">
      <div class="row join-row">
        <div class="col-md-12" style="z-index:9">
          <form class="probootstrap-form probootstrap-form-box mb60 text-center">
            <h4 class="mb-5">내 정보</h4>
            <div class="form-group">
              <label for="name" class="sr-only sr-only-focusable">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="이름"
                     value="<?php echo e(Auth::user()->name); ?>" disabled>
              <span id="name_text" class="login-info-text"></span>
            </div>
            <?php if(Auth::user()->contact == ""): ?>
              <div class="form-group">
                <div class="input-group mb-3
                            ">
                  <input type="text" class="form-control" id="contact"
                         name="contact" placeholder="휴대전화번호" maxlength="11"
                         aria-label="휴대전화번호" onkeypress='inputPhoneNumber(this)'
                         aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-secondary input-group-btn"
                            onclick='CertificationNumber()' type="button">인증번호 발송
                    </button>
                  </div>
                </div>
              </div>
            <?php else: ?>
              <div class="form-group" id='contact_confirm'>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id="contact" 
                         name="contact" placeholder="휴대전화번호" value="<?php echo e(Auth::user()->contact); ?>"
                         disabled>
                  <div class="input-group-append">
                    <button class="btn btn-secondary input-group-btn" onclick='contactupdate()'
                            type="button">수정하기
                    </button>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <div class="form-group" id='ct_confirm'></div>
            <div class="form-group">
              <label for="email" class="sr-only sr-only-focusable">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="이메일 주소"
                     value="<?php echo e(Auth::user()->email); ?>" disabled>
              <span id="email_text" class="login-info-text"></span>
            </div>
            <br>
            <a class="leave-btn" onclick="openLeaveModal()">회원탈퇴</a>
          </form>
        </div>
      </div>
    </div>

  <?php endif; ?>
  <div class="modal fade" id="leaveModal" tabindex="-1" role="dialog" aria-labelledby="leaveModal"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">회원 탈퇴 하기</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="padding: 0.25rem 0.75rem;">×</span>
          </button>
        </div>
        <div class="modal-body probootstrap-form p-0" id="delete_modal">
          <div class="form-group m-3">
            <span class="detail-contents"><span class="text-red">* </span>탈퇴 후에는 "<?php echo e(Auth::user()->email); ?>" 으로 다시 가입할 수 없으며 아이디와 데이터는 복구할 수 없습니다.</span>
            <div class="p-3">
              <input class="typeCk" type="checkbox" id="check">
              <span class="text-red">(필수)</span> <span class="detail-contents">안내 사항을 모두 확인하였으며, 이에 동의 합니다.</span>
            </div>
          </div>
          <div class="form-group m-3">
            <label for="delete_password" class="sr-only sr-only-focusable">Delete-Password</label>
            <input type="password" class="form-control" id="delete_password" name="delete_password"
                   placeholder="현재 비밀번호를 입력">
          </div>
          <div class="row">
            <div class="col-6 pr-0">
              <div class="form-group m-3">
                <input type="button" id="reg" name="reg" onclick="deleteUser();" class="btn btn-secondary w-100"
                       value="탈퇴하기">
              </div>
            </div>
            <div class="col-6 pl-0">
              <div class="form-group m-3">
                <input type="button" class="btn btn-primary w-100" data-dismiss="modal" aria-label="Close"
                       value="다음에 할게요!">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- END section -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script>

      function infoupdate(type) {
          $.ajax({
              url: '/information/update',
              type: "POST",
              dataType: "json",
              data: {
                  type: type,
                  'old_password': $("#old_password").val(),
                  'password': $("#password").val(),
                  'contact': $("#contact").val(),
                  "_token": "<?php echo e(csrf_token()); ?>"
              },
          }).done(function (response) {
              var data = response.data;
              var result = response.result;
              alert(result);
              alert(data);
              if (result != 0) {
                  show("ok");
              }
          });
      }

      function show(confirm) {
          $.ajax({
              url: '/information/show',
              type: "POST",
              dataType: "json",
              data: {
                  "password": $('#password').val(),
                  "confirm": confirm,
                  "_token": "<?php echo e(csrf_token()); ?>"
              },
          }).done(function (response) {
              var result = response.result;
              if (result == 0) {
                  alert("비밀번호가 틀렸습니다.");
              } else {
                  var data = response.datas;
                  $("#informationcom").html(data);
              }
          });
      }

      function deleteUser() {
          if ($("#check").prop("checked")) {
              $.ajax({
                  url: '/information/delete',
                  type: "POST",
                  dataType: "json",
                  data: {
                      "password": $('#delete_password').val(),
                      "_token": "<?php echo e(csrf_token()); ?>"
                  },
              }).done(function (response) {
                  var result = response.result;
                  if (result == 0) {
                      alert("비밀번호가 틀렸습니다.");
                  } else {
                      alert("탈퇴 되었습니다.");
                      window.location = "/logout";
                  }
              });
          } else {
              alert("안내 확인에 동의해 주세요.");
          }
      }

      function CertificationNumber() {//인증 번호 보낸후 확인

          if ($("#contact").val() != "") {
              $("#contact").attr('onkeypress', "inputPhoneNumber(this)");
              $str = "<div class=\"form-group\">" +
                  "<div class=\"input-group mb-3\">" +
                  "<input type=\"text\" class=\"form-control\" id=\"contact_cf\"" +
                  "name=\"contact_cf\" placeholder=\"인증번호 6자리 입력\">" +
                  "<div class=\"input-group-append\">" +
                  "<button class=\"btn btn-secondary input-group-btn\" onclick='checkContact()'  type=\"button\">인증번호 확인</button>" +
                  "</div>" +
                  "</div>" +
                  "</div><div class=\"form-group\" id='ct_confirm'></div>";
              $("#ct_confirm").html($str);

              $.ajax({
                  url: '/information/contact/send',
                  type: "POST",
                  dataType: "json",
                  data: {
                      "contact": $("#contact").val(),
                      "_token": "<?php echo e(csrf_token()); ?>"
                  },
                  error: function (request, status, error) {
                      //alert("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                  }
              }).done(function (response) {
                  if (response.result == 0) {
                      alert("인증 번호를 전송을 실패 하였습니다.");
                  } else {
                      $("#contactcheck_btn").removeAttr('disabled');
                      alert("인증 번호를 전송 하였습니다.");
                  }
              });
          } else {
              alert("전화번호를 입력해 주세요.");
          }
      }

      function checkContact() {
          $.ajax({
              url: '/information/contact/check',
              type: "POST",
              dataType: "json",
              data: {
                  "contact_confirm": $("#contact_cf").val(),
                  "contact": $("#contact").val(),
                  "_token": "<?php echo e(csrf_token()); ?>"
              },
          }).done(function (response) {
              if (response.result == 0) {
                  alert("인증번호가 틀렸습니다.");
              } else {
                  alert("인증을 성공 하였습니다.");
                  show("ok");
              }
          });
      }

      function openLeaveModal() {
          $("#leaveModal").modal({backdrop: 'static'});
      }

      function contactupdate() {
          $str = "<div class=\"form-group\">" +
              "<div class=\"input-group mb-3\">" +
              "<input type=\"text\" class=\"form-control\" id=\"contact\" maxlength='11' " +
              "name=\"contact\" placeholder=\"휴대전화번호\"" +
              "aria-label=\"휴대전화번호\"" +
              "aria-describedby=\"basic-addon2\">" +
              "<div class=\"input-group-append\">" +
              "<button class=\"btn btn-secondary input-group-btn\" onclick='CertificationNumber()'  type=\"button\">인증번호 발송</button>" +
              "</div>" +
              "</div>" +
              "</div><div class=\"form-group\" id='ct_confirm'></div>";
          $("#contact_confirm").html($str);
      }

      function passwdupdate() {
          $str = "<div class=\"form-group\">\n                        " +
              "<label for=\"password_confirm\" class=\"sr-only sr-only-focusable\">Confirm-Password</label>" +
              "<input type=\"password\" class=\"form-control\" id=\"old_password\" name=\"old_password\" placeholder=\"현재 비밀번호를 입력\">" +
              "</div>" +
              "<div class=\"form-group\">" +
              "<label for=\"password\" class=\"sr-only sr-only-focusable\">Password</label>" +
              "<input type=\"password\" class=\"form-control\" id=\"password\" name=\"password\" placeholder=\"새 비밀번호(영문,숫자,특수문자 8자리이상)\">" +
              "<span id=\"password_text\" class=\"login-error-info-text\"></span>" +
              "</div>" +
              "<div class=\"form-group\">" +
              "<label for=\"password_confirm\" class=\"sr-only sr-only-focusable\">Confirm-Password</label>" +
              "<input type=\"password\" class=\"form-control\" id=\"password_confirm\" name=\"password_confirm\" placeholder=\"새 비밀번호 확인\">" +
              "<span id=\"password_confirm_text\" class=\"login-error-info-text\"></span>" +
              "</div>" +
              "<div class=\"form-group\">" +
              "<input type=\"button\" id=\"reg\" name=\"reg\" disabled=\"true\"  onclick=\"infoupdate('password');\"class=\"btn btn-primary w-100\" value=\"비밀번호 변경\">" +
              "</div>";
          $("#pwupdate").html($str);

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/isihyeon/Documents/GitHub/mo-zip/resources/views/my/information.blade.php ENDPATH**/ ?>