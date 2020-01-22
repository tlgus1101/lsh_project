<?php $__env->startSection('title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <style>
        .detail-title {
            width: 100%;
            font-size: 13px;
        }

        .detail-contents {
            color: #000;
            font-weight: 500;
        }

        .bill-detail-title {
            width: 100%;
            color: #fff;
            font-weight: 500;
            font-size: 13px;
        }

        .bill-detail-contents {
            color: #fff;
            font-weight: 500;
        }

        .main-title {
            font-size: 16px;
        }

        .main-contents {
            font-size: 16px;
            color: #00CA4C;
        }

        .black-line {
            background: #000;
            height: 0.1rem;
            width: 100%;
            margin-top: 2rem;
        }

        .white-line {
            background: #fff;
            height: 0.1rem;
            width: 100%;
        }

        .detail_info span {
            display: inline-block;
            font-size: 12px;
            padding-top: 0.5rem;
            vertical-align: middle;
        }

        .detail_info .icon {
            background: url(//yaimg.yanolja.com/joy/sunny/static/images/ico-tip.svg) no-repeat;
            display: inline-block;
            height: 1rem;
            vertical-align: middle;
            width: 1rem;
        }

        .reservation-bill {
            background: #595f63;
            margin-top: 1rem;
            padding: 1rem 2rem 2rem 2rem;
            width: 100%;
        }

        .reservation-bill-info > span {
            color: #CCC;
            display: inline-block;
            font-size: 12px;
            line-height: 1.6rem;
            padding-left: 0.3rem;
            vertical-align: middle;
            width: calc(100% - 1.5rem);
        }
    </style>
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
                    <p class="lead mb-5 probootstrap-animate" style="margin: 0 !important;"><a href="#" target="_blank"
                                                                                               class="basic-a-color">다른정보
                            보기 <i
                                class="fa fa-angle-down"></i></a></p>
                    <h2 class="heading mb-2 display-5 font-light probootstrap-animate">예약내역</h2>
                </div>
            </div>
        </div>

    </section>
    <!-- END section -->
    <section class="probootstrap_section probootstrap_lg_pt-50" id="section-city-guides">
        <div class="container">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="media probootstrap-media d-flex align-items-stretch mb-4 probootstrap-animate">
                                <div class="card p-4">
                                    <div class="detail-title"><span class="float-left">예약자명</span><span
                                            class="float-right detail-contents"><?php echo e($data->reservation_orderer_name); ?></span>
                                    </div>
                                    <div class="detail-title"><span class="float-left">예약자 연락처</span><span
                                            class="float-right detail-contents"><?php echo e($data->reservation_orderer_contact); ?></span>
                                    </div>
                                    <div class="detail-title"><span class="float-left">예약일시</span><span
                                            class="float-right detail-contents"><?php echo e(date("Y년m월d일 H시i분s초", strtotime($data->reservation_enrollment_date))); ?></span>
                                    </div>
                                    <div class='detail-title'><span class='float-left'>예약상태</span><span
                                            class='float-right detail-contents'><?php echo e($data->reservation_state); ?></span>
                                    </div>
                                    <?php if($data->reservation_payment_way =="무통장입금" ): ?>
                                        <div class="detail-title"><span class="float-eft">계좌번호 / 은행</span><span
                                                class="float-right detail-contents"><?php echo e($contract->partner_contract_accountnumber." / ".$contract->partner_contract_bank); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="black-line"></div>
                                    <div class="detail-title" style="margin-top: 2rem"><span class="float-eft">객실 정보 / 기간</span><span
                                            class="float-right detail-contents"><?php echo e($data->reservation_partner_room_name); ?> / <?php echo e($data->reservation_use_time); ?></span>
                                    </div>
                                    <div class="detail-title"><span class="float-left">숙박유형</span><span
                                            class="float-right detail-contents"><?php echo e($data->reservation_type); ?></span>
                                    </div>
                                    <?php if( $data->reservation_type == '숙박' ): ?>
                                    <div class="detail-title"><span class="float-left">체크인</span><span
                                            class="float-right detail-contents"><?php echo e(date("Y년m월d일", strtotime($data->reservation_use_start_date))); ?></span>
                                    </div>
                                    <div class="detail-title"><span class="float-left">체크아웃</span><span
                                            class="float-right detail-contents"><?php echo e(date("Y년m월d일", strtotime($data->reservation_use_end_date))); ?></span>
                                    </div>
                                    <?php else: ?>
                                        <div class="detail-title"><span class="float-left">체크인</span><span
                                                class="float-right detail-contents"><?php echo e(date("Y년m월d일 H시", strtotime($data->reservation_use_start_date))); ?></span>
                                        </div>
                                        <div class="detail-title"><span class="float-left">체크아웃</span><span
                                                class="float-right detail-contents"><?php echo e(date("Y년m월d일 H시", strtotime($data->reservation_use_end_date))); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="black-line"></div>
                                    <div class="detail_info"><span><i class="icon"></i>예약시 입력한 휴대폰번호 <?php echo e($data->reservation_orderer_contact); ?> 은(는) 안심번호로 숙소에 전달되며, 퇴실 후 5일간 보관됩니다.</span>
                                    </div>
                                    <div class="reservation-bill">
                                        <div class="bill-detail-title main-title mb-2
                                        "><span class="float-left">결제수단</span><span
                                                class="float-right bill-detail-contents main-contents"><?php echo e($data->reservation_payment_way); ?></span>
                                        </div>
                                        <br>
                                        <div class="white-line"></div>
                                        <div class="bill-detail-title mt-2
                                    "><span class="float-left">판매금액</span><span
                                                class="float-right bill-detail-contents"><?php echo e(number_format($data->reservation_payment_price + $data->reservation_discount_price )); ?>원</span>
                                        </div>
                                        <br>
                                        <div class="bill-detail-title"><span class="float-left">결제금액</span><span
                                                class="float-right bill-detail-contents"><?php echo e(number_format($data->reservation_payment_price)); ?>원</span>
                                        </div>
                                        <br>
                                        <div class="bill-detail-title"><span class="float-left">할인</span><span
                                                class="float-right bill-detail-contents"><?php echo e(number_format($data->reservation_discount_price)); ?>원</span>
                                        </div>
                                        <br>
                                        <div class="reservation-bill-info"><i>※</i><span>취소수수료는 판매금액을 기준으로 계산됩니다.</span>
                                        </div>
                                        <div class="reservation-bill-info">
                                            <i>※</i><span>사용하신 쿠폰의 유효기간이 잔여할 경우, 취소수수료 발생여부와 관계없이 반환됩니다.</span></div>
                                        <div class="reservation-bill-info">
                                            <i>※</i><span>자세한 사항은 취소규정을 참고해주시기 바랍니다.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </section>
    <!-- END section -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/isihyeon/Documents/GitHub/mo-zip/resources/views/my/reserveconfirm.blade.php ENDPATH**/ ?>