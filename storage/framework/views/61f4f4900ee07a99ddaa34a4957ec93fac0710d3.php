<?php $__env->startSection('title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="/css/my.css">

  <style>
    .btn[disabled]{
      border-color: #cccccc;
      background: #cccccc;
    }
  </style>
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
              <a class="dropdown-item" href="/information">내정보</a>
              <a class="dropdown-item" href="/reservation">예약내역</a>
              <a class="dropdown-item" href="/question">1:1 문의</a>
              <a class="dropdown-item" href="/wishlist">위시리스트</a>
            </div>
          </div>
          <h2 class="heading mb-2 display-5 font-light probootstrap-animate">예약내역</h2>
        </div>
      </div>
    </div>


  </section>
  <!-- END section -->

  <section class="probootstrap_section probootstrap_lg_pt-50" id="section-city-guides">
    <div class="container" id="reserveList">

      <?php if(count($datas) > 0): ?>
        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="row mb-3">
            <div class="col-md-12">
              <div class="media probootstrap-media d-flex align-items-stretch mb-4 probootstrap-animate">
                <div class="probootstrap-media-image"
                     style="background-image: url(<?php echo e($data->room_rep_image_route.$data->room_rep_image_save_name); ?>)">
                </div>
                <div class="media-body">
                  <h5 class="mb-1 reservation-main"><?php echo e($data->name); ?></h5>
                  <div><span class="reservation-title">객실정보</span> <span
                      class="reservation-contents"><?php echo e($data->room_name); ?></span>
                  </div>
                  <?php if( $data->reservation_type == "숙박" ): ?>
                    <div class="mb-3"><span class="reservation-title">방문일자</span>
                      <span
                        class="reservation-contents"><?php echo e(date("Y년m월d일", strtotime($data->reservation_use_start_date))); ?> ~
                                    <?php echo e(date("Y년m월d일", strtotime($data->reservation_use_end_date))); ?>

                            </span>
                    </div>
                  <?php else: ?>
                    <div class="mb-3"><span class="reservation-title">방문일자</span>
                      <span
                        class="reservation-contents"><?php echo e(date("Y년m월d일 H시", strtotime($data->reservation_use_start_date))); ?> ~
                                        <?php if(date("Y년m월d일", strtotime($data->reservation_use_start_date)) == date("Y년m월d일", strtotime($data->reservation_use_end_date))): ?>
                          <?php echo e(date("H시", strtotime($data->reservation_use_end_date))); ?>

                        <?php elseif(date("Y년m월", strtotime($data->reservation_use_start_date)) == date("Y년m월", strtotime($data->reservation_use_end_date))): ?>
                          <?php echo e(date("d일 H시", strtotime($data->reservation_use_end_date))); ?>

                        <?php elseif(date("Y년", strtotime($data->reservation_use_start_date)) == date("Y년", strtotime($data->reservation_use_end_date))): ?>
                          <?php echo e(date("m월d일 H시", strtotime($data->reservation_use_end_date))); ?>

                        <?php else: ?>
                          <?php echo e(date("Y년m월d일 H시", strtotime($data->reservation_use_end_date))); ?>

                        <?php endif; ?>
                                    </span>
                    </div>
                  <?php endif; ?>
                  <div class="mb-1">
                    <button class="btn btn-primary w-100" onclick="detail(<?php echo e($data->reservation_idx); ?>)"
                            data-toggle="modal" data-target="#reservationModal">상세 보기
                    </button>
                  </div>





                  
                  
                  
                  
                  

                  <?php if(strtotime($data->reservation_use_end_date) > strtotime(date("Y-m-d h:i:s")) && ( $data->reservation_state == "예약완료" || $data->reservation_state == "예약대기" )): ?>
                    <div>
                      <button class="btn btn-danger w-100" onclick="cancle('<?php echo e($data->partner_idx); ?>','<?php echo e($data->reservation_idx); ?>')">예약 취소
                      </button>
                    </div>
                  <?php else: ?>
                    <div>
                      <button class="btn btn-danger w-100" disabled>예약 취소
                      </button>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
        <div class="container">
          <div class="reserve_none">
            <i>&nbsp;</i>
            <b>예약하신 내역이 없습니다.</b>- 모집 -
          </div>
        </div>
      <?php endif; ?>

    </div>
  </section>
  <!-- END section -->

  <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel1"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
      <div class="modal-content" id="detail">
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">후기 작성</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="padding: 0.25rem 0.75rem;">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="message" class="sr-only sr-only-focusable">Message</label>
            <textarea cols="30" rows="10" class="form-control" id="message" name="message"
                      placeholder="후기를 남겨주세요."></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">QR 코드 확인하기</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="padding: 0.25rem 0.75rem;">×</span>
          </button>
        </div>
        <div class="modal-body">
          <img src="//cloudfront.mo-zip.co.kr/mo-zip/images/qrcode_sample.png" class="qrcode-img" width="100%">
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="cancleModal" tabindex="-1" role="dialog" aria-labelledby="cancleModalLabel"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cancleModalLabel">예약 취소하기</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="padding: 0.25rem 0.75rem;">×</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="message" class="sr-only sr-only-focusable">Message</label>
          <textarea cols="30" rows="10" class="form-control" id="reservation_refund_way" name="reservation_refund_way"
                    placeholder="취소 사유를 남겨주세요."></textarea>
          <div class="m-3" id="canclerule">
          </div>
          <input type="hidden" id="cancleidx">
          <div class="m-3">
            <button type="button" class="btn btn-primary w-100" onclick="cancleInit()">예약 취소 요청
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script>
      function reserveAjax() {
          $.ajax({
              url: '/reservation',
              type: "get",
              dataType: "json", data: {
                  'json': true,
                  "_token": "<?php echo e(csrf_token()); ?>"
              },
          }).done(function (response) {
              var data = response.datas;
              $("#reserveList").html(data);
          });
      }

      function detail(idx) {
          $.ajax({
              url: '/reservation/show',
              type: "POST",
              dataType: "json", data: {
                  'reservation_idx': idx,
                  "_token": "<?php echo e(csrf_token()); ?>"
              },
          }).done(function (response) {
              var data = response.datas;
              $("#detail").html(data);
              $("#reservationModal").modal({backdrop: 'static'});
          });
      }
      function cancle(idx,re_idx) {
          $.ajax({
              url: '/reservation/cancle',
              type: "get",
              dataType: "json", data: {
                  'idx': idx,
              },
          }).done(function (response) {
              var data = response.datas;
              $("#cancleidx").val(re_idx);
              $("#canclerule").html(data);
              $("#cancleModal").modal({backdrop: 'static'});
          });
      }
      function cancleInit() {
          $.ajax({
              url: '/reservation/cancle',
              type: "POST",
              dataType: "json", data: {
                  'idx': $("#cancleidx").val(),
                  'reservation_refund_way' : $("#reservation_refund_way").val(),
                  "_token": "<?php echo e(csrf_token()); ?>"
              },
          }).done(function (response) {
              if(response.result == 0){
                  alert("예약 취소 신청에 실패 하셨습니다.");
              }else{
                  alert("예약 취소 신청에 성공 하셨습니다.");
                  $("#cancleModal").modal('hide');
                  reserveAjax();
              }
          });
      }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/isihyeon/Documents/GitHub/mo-zip/resources/views/my/reservation.blade.php ENDPATH**/ ?>