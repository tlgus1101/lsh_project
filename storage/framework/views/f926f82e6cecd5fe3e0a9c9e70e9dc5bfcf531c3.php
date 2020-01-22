<?php $__env->startSection('title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="/css/slick.css">
  <link rel="stylesheet" href="/css/my.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="probootstrap-cover overflow-hidden relative"
           style="background-image: url('https://d2mgzmtdeipcjp.cloudfront.net/files/upload/15501919173889.jpg?s=1400x467'); padding: 2em 0 0"
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
          <h2 class="heading mb-2 display-5 font-light probootstrap-animate">1:1 문의</h2>
        </div>
      </div>
    </div>
  </section>

  <!-- END section -->
  <section>
    <div class="container">
      <div class="sub-header">
        <div class="swipe-tabs">
          <div class="swipe-tab" onclick="questionList();">나의 문의 내역</div>
          <div class="swipe-tab" onclick="questions();">새 문의 작성</div>
        </div>
      </div>
    </div>
  </section>

  <section class="probootstrap_section ">
    <div class="container show active" id="questionList">
      <div class="container">
        <div class="reserve_none">
          <i>&nbsp;</i>
          <b>등록된 1:1 문의가 없습니다.</b>
          모집은 회원님들의 소중한 의견에 귀 기울여 신속하고 정확하게 답변드리도록 하겠습니다.
        </div>
      </div>
    </div>
    <div class="container" id="questions">
      <div class="row">
        <div class="col-md-12">
          <form class="probootstrap-form probootstrap-form-box mb60 text-center">
            <h4 class="mb-5">문의 하기</h4>
            <div class="form-group">
              <label for="name" class="sr-only sr-only-focusable">카테고리 유형</label>
              <select class="form-control" id='question_category_type' name='question_category_type'>
                <option value="" selected>카테고리 유형을 선택하세요.</option>
                <option value='모텔'>모텔</option>
                <option value='호텔'>호텔</option>
                <option value='펜션'>펜션</option>
                <option value='글램핑'>글램핑</option>
                <option value='공간대여'>공간대여</option>
                <option value='특가'>특가</option>
              </select>
              <span id="name_text" class="login-info-text"></span>
            </div>
            <div class="form-group">
              <label for="name" class="sr-only sr-only-focusable">문의 유형</label>
              <select class="form-control" id='question_type' name='question_type'>
                <option value="" selected>문의 유형을 선택하세요.</option>
                <option value='예약/결제'>예약/결제</option>
                <option value='업체정보'>업체정보</option>
                <option value='회원정보'>회원정보</option>
                <option value='리뷰'>리뷰</option>
                <option value='기타'>기타</option>
              </select>
              <span id="name_text" class="login-info-text"></span>
            </div>
            <div class="form-group">
              <label for="name" class="sr-only sr-only-focusable">문의 내용</label>
              <textarea class="form-control" id="question_contents" name="question_contents" placeholder="문의하실 내용을 10자 이상 입력해 주세요.

문의하시는 제휴점 이름과 예약정보를 남겨주시면 보다 빠른 상담이 가능합니다.

휴대폰 번호는 유선답변을 위해 수집되며, 답변 완료 후 즉시 삭제 됩니다." rows="20"></textarea>
              <span id="name_text" class="login-info-text"></span>
            </div>
            <div class="mb-1">
              <button type="button" class="btn btn-primary w-100" onclick="questionsave()"
                      data-toggle="modal" data-target="#reservationModal">문의 신청하기
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <!-- END section -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script src="/js/slick.min.js"></script>
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
          $("#questions").hide();
          questionList();
      });

      function questionList() {
          $.ajax({
              url: '/question',
              type: "get",
              dataType: "json",
              data: {
                  'json': "true",
              },
          }).done(function (response) {
              var data = response.datas;
              $("#questionList").html(data);
              $("#questionList").show();
              $("#questions").hide();
          });
      }

      function questions() {
          $("#questionList").hide();
          $("#questions").show();

          // $str = "              <div class=\"row join-row\">\n" +
          //     "                  <div class=\"col-md-12\" style=\"z-index:9\">\n" +
          //     "                      <form class=\"probootstrap-form probootstrap-form-box mb60 text-center\">\n" +
          //     "                          <h4 class=\"mb-5\">문의 하기</h4>\n" +
          //     "                          <div class=\"form-group\">\n" +
          //     "                              <label for=\"name\" class=\"sr-only sr-only-focusable\">카테고리 유형</label>\n" +
          //     "                              <select class=\"form-control\" id='question_category_type' name='question_category_type'>\n" +
          //     "                                  <option selected>카테고리 유형을 선택하세요.</option>\n" +
          //     "                                  <option value='모텔'>모텔</option>\n" +
          //     "                                  <option value='호텔'>호텔</option>\n" +
          //     "                                  <option value='펜션'>펜션</option>\n" +
          //     "                                  <option value='글램핑'>글램핑</option>\n" +
          //     "                                  <option value='공간대여'>공간대여</option>\n" +
          //     "                                  <option value='특가'>특가</option>\n" +
          //     "                              </select>\n" +
          //     "                              <span id=\"name_text\" class=\"login-info-text\"></span>\n" +
          //     "                          </div>\n" +
          //     "                          <div class=\"form-group\">\n" +
          //     "                              <label for=\"name\" class=\"sr-only sr-only-focusable\">문의 유형</label>\n" +
          //     "                              <select class=\"form-control\" id='question_type' name='question_type'>\n" +
          //     "                                  <option selected>문의 유형을 선택하세요.</option>\n" +
          //     "                                  <option value='예약/결제'>예약/결제</option>\n" +
          //     "                                  <option value='업체정보'>업체정보</option>\n" +
          //     "                                  <option value='회원정보'>회원정보</option>\n" +
          //     "                                  <option value='리뷰'>리뷰</option>\n" +
          //     "                                  <option value='기타'>기타</option>\n" +
          //     "                              </select>\n" +
          //     "                              <span id=\"name_text\" class=\"login-info-text\"></span>\n" +
          //     "                          </div>\n" +
          //     "                          <div class=\"form-group\">\n" +
          //     "                              <label for=\"name\" class=\"sr-only sr-only-focusable\">문의 내용</label>\n" +
          //     "                              <textarea class=\"form-control\" id=\"question_contents\" name=\"question_contents\" placeholder=\"문의하실 내용을 10자 이상 입력해 주세요.\n" +
          //     "\n" +
          //     "문의하시는 제휴점 이름과 예약정보를 남겨주시면 보다 빠른 상담이 가능합니다.\n" +
          //     "\n" +
          //     "휴대폰 번호는 유선답변을 위해 수집되며, 답변 완료 후 즉시 삭제 됩니다.\" rows=\"20\"></textarea>\n" +
          //     "                              <span id=\"name_text\" class=\"login-info-text\"></span>\n" +
          //     "                          </div>\n" +
          //     "                          <div class=\"mb-1\">\n" +
          //     "                              <button class=\"btn btn-primary w-100\" onclick=\"questionsave()\"\n" +
          //     "                                      data-toggle=\"modal\" data-target=\"#reservationModal\">문의 신청하기\n" +
          //     "                              </button>\n" +
          //     "                          </div>\n" +
          //     "                      </form>\n" +
          //     "                  </div>\n" +
          //     "              </div>\n" +
          //     "          </div>";

          // $("#questionList").html($str);
      }

      function questionsave() {
          if ($("#question_category_type").val() == "") {
              alert("카테고리 유형을 선택해 주세요.");
              return false;
          }
          if ($("#question_type").val() == "") {
              alert("문의 유형을 선택해 주세요.");
              return false;
          }
          if ($("#question_contents").val().length < 10) {
              alert("10이상 입력 부탁 드립니다.");
              return false;
          }
          $.ajax({
              url: '/question/save',
              type: "post",
              dataType: "json",
              data: {
                  'question_category_type': $("#question_category_type").val(),
                  'question_type': $("#question_type").val(),
                  'question_contents': $("#question_contents").val(),
                  "_token": "<?php echo e(csrf_token()); ?>"
              },
          }).done(function (response) {
              if (response.result == 0) {
                  alert("문의 신청을 실패 하였습니다.");
              } else {
                  alert("문의 신청을 성공 하였습니다.");
                  questionList();
              }
          });
      }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/isihyeon/Documents/GitHub/mo-zip/resources/views/my/question.blade.php ENDPATH**/ ?>