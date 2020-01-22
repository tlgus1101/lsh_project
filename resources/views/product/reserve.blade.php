@extends('layouts.app')

@section('title')

@endsection

@section('style')
  <link rel="stylesheet" href="/css/swiper.min.css">
  <link rel="stylesheet" href="/css/product.css">

  <style>
    .btn-secondary {
      background-color: #8853c0bf;
      background-image: none;
      border-color: #8853c0bf;
    }

    .btn-group > .btn:focus, .btn-group > .btn:active, .btn-group > .btn.active,
    .btn-group-vertical > .btn:focus, .btn-group-vertical > .btn:active, .btn-group-vertical > .btn.active {
      z-index: 2;
      border-color: #8853c0bf;
    }

    .btn-secondary:active, .btn-secondary.active, .show > .btn-secondary.dropdown-toggle {
      background-color: #4E3188;
      background-image: none;
      border-color: #4E3188;
    }

    .btn:hover, .btn:active, .btn:focus {
      background-color: #4E3188;
      -webkit-box-shadow: 0 2px 4px 0 #4E3188bf;
      box-shadow: 0 2px 4px 0 #4E3188bf
    }

    .btn-secondary.disabled, .btn-secondary:disabled {
      background-color: #4E3188bf;
      border-color: #4E3188bf;
    }

    .list-group-item.active {
      z-index: 2;
      color: #fff;
      background-color: #4E3188;
      background-image: none;
      border-color: #4E3188;
    }
  </style>

@endsection

@section('content')

  <section class="probootstrap-cover overflow-hidden relative"
           style="background-image: url('{{ $partner->partner_image_route . $partner->partner_image_save_name }}'); padding: 2em 0 0"
           data-stellar-background-ratio="0.5"
           id="section-home">
    <div class="overlay"></div>
    <div class="container top-container">
      <div class="row align-items-center text-center">
        <div class="col-md">
          <h2 class="heading mb-2 display-5 font-light probootstrap-animate">{{ $partner->name }}</h2>
        </div>
      </div>
    </div>
  </section>
  <!-- END section -->

  <section class="probootstrap_section bg-light">
    <form action="/reserve/save" method="post" onsubmit="return checked();" id="insertFrom">
      @csrf
      <input type="hidden" id="type" name="type" value="{{ $type }}">
      <input type="hidden" id="reservation_partner_name" name="reservation_partner_name"
             value="{{ $partner->name }}">
      <input type="hidden" id="reservation_partner_contact" name="reservation_partner_contact"
             value="{{ $partner->partner_contact }}">
      <input type="hidden" id="partner_code" name="partner_code"
             value="{{ $partner->partner_code }}">
      <input type="hidden" id="reservation_partner_area" name="reservation_partner_area"
             value="{{ $partner->partner_sido." ".$partner->partner_sigungu }}">
      <input type="hidden" id="partner_idx" name="partner_idx" value="{{ $partner->id }}">
      <input type="hidden" id="reservation_partner_room_name" name="reservation_partner_room_name"
             value="{{ $room->room_name }}">
      <input type="hidden" id="room_idx" name="room_idx" value="{{ $room->room_idx }}">
      <input type="hidden" id="room_product_idx" name="room_product_idx"
             value="{{ $room->room_product_idx }}">
      <input type="hidden" id="reservation_product_price" name="reservation_product_price"
             value="{{ $room->room_product_price }}">
      <input type="hidden" id="room_product_discount_price" name="room_product_discount_price"
             value="{{ $room->room_product_discount_price }}">
      <input type="hidden" id="room_product_add_price" name="room_product_add_price"
             value="{{ $room->room_product_add_price }}">
      <input type="hidden" id="reservation_payment_price" name="reservation_payment_price"
             value="{{ $room->room_product_sale_price }}">
      <input type="hidden" id="reservation_people_add_price" name="reservation_people_add_price"
             value="0">
      <input type="hidden" id="reservation_extra_price" name="reservation_extra_price" value="0">
      <input type="hidden" id="reservation_extra_information" name="reservation_extra_information">
      <input type="hidden" id="reservation_add_time_price" name="reservation_add_time_price">
      <input type="hidden" id="reservation_orderer_visit_way"
             name="reservation_orderer_visit_way">
      <input type="hidden" id="reservation_type" name="reservation_type"
             value="{{ $room->room_product_sale_type }}">
      <input type="hidden" id="reservation_use_start_date" name="reservation_use_start_date"
             value="{{ date('Y-m-d', strtotime($in)) }}">
      <input type="hidden" id="reservation_use_end_date" name="reservation_use_end_date"
             value="{{ date('Y-m-d', strtotime($out)) }}">
      @if($room->room_product_sale_type == "대실")
        <input type="hidden" id="reservation_use_time" name="reservation_use_time"
               value="{{ $room->room_renting_use_time }}시간">
      @elseif($room->room_product_sale_type == "대여")
        <input type="hidden" id="reservation_use_time" name="reservation_use_time"
               value="{{ $room->room_rent_use_time }}시간">
      @else
        <input type="hidden" id="reservation_use_time" name="reservation_use_time"
               value="{{ $diff_date = (strtotime($out) - strtotime($in)) / 86400 }}박">
      @endif
      <input type="hidden" id="reservation_payment_way" name="reservation_payment_way">
      <input type="hidden" id="add_child" name="add_child" value="0">
      <input type="hidden" id="add_adult" name="add_adult" value="{{ $room->room_standard_people }}">
      <input type="hidden" id="add_child_price" name="add_child_price">
      <input type="hidden" id="add_adult_price" name="add_adult_price">
      <input type="hidden" id="phone_ck" name="phone_ck" value="false">
      <input type="hidden" id="max_people" name="max_people" value="{{ $room->room_maximum_people }}">
      <input type="hidden" id="room_standard_people" name="room_standard_people"
             value="{{ $room->room_standard_people }}">

      <div class="container">
        @if($room->room_product_sale_type == "대실")
          <div class="row">
            <div class="col-12 probootstrap-animate text-center">
              <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">이용정보</h2>
              <div class="probootstrap-form probootstrap-form-box mb60">
                <div class="row mb-4">
                  <div class="col-12">
                <span class="contents ml-3 float-right display-6">최대 <span
                    class="text-red display-5">{{ $room->room_renting_use_time }}시간</span> 이용 가능</span><span
                      class="m-0 float-right">이용시간 </span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="select_time">
                      @for($i=$room->room_renting_use_start_date  , $j = 1 ;$i<=$room->room_renting_use_end_date ;$i++ ,$j++)
                        <div class="time">
                          @if($i<10)
                            <div class="time">
                              <input class="time" type="checkbox" name="time"
                                     id="time{{ $i }}" onclick="timeclick('{{ $i }}')">
                              <label for="time{{ $i }}">0{{ $i }}:00</label>
                            </div>
                          @else
                            <div class="time">
                              <input class="time" type="checkbox" name="time"
                                     id="time{{ $i }}" onclick="timeclick('{{ $i }}')">
                              <label for="time{{ $i }}">{{ $i }}:00</label>
                            </div>
                          @endif
                        </div>
                      @endfor
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @elseif($room->room_product_sale_type == "대여")
          <div class="row">
            <div class="col-12 probootstrap-animate text-center">
              <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">이용정보</h2>
              <div class="probootstrap-form probootstrap-form-box mb60">
                <div class="row mb-4">
                  <div class="col-12">
                <span class="contents ml-3 float-right display-6">최대 <span
                    class="text-red display-5">{{ $room->room_rent_use_time }}시간</span> 이용 가능</span><span
                      class="m-0 float-right">이용시간 </span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="select_time">
                      @for($i=$room->room_rent_use_start_date  , $j = 1 ;$i<=$room->room_rent_use_end_date ;$i++ ,$j++)
                        <div class="time">
                          @if($i<10)
                            <div class="time">
                              <input class="time" type="checkbox" name="time"
                                     id="time{{ $i }}" onclick="timeclick('{{ $i }}')">
                              <label for="time{{ $i }}">0{{ $i }}:00</label>
                            </div>
                          @else
                            <div class="time">
                              <input class="time" type="checkbox" name="time"
                                     id="time{{ $i }}" onclick="timeclick('{{ $i }}')">
                              <label for="time{{ $i }}">{{ $i }}:00</label>
                            </div>
                          @endif
                        </div>
                      @endfor
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif


        <div class="row">
          <div class="col-md-7 probootstrap-animate text-center">
            <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">예약정보</h2>
            <div class="probootstrap-form probootstrap-form-box mb60">
              <button type="button" class="btn btn-secondary w-100 mb-3" onclick="myInfo()">내정보 가져오기
              </button>
              <div class="form-group">
                <label for="name" class="sr-only sr-only-focusable">예약자 이름</label>
                <input type="text" class="form-control" id="reservation_orderer_name"
                       name="reservation_orderer_name" placeholder="예약자 이름">
              </div>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="reservation_orderer_contact"
                       maxlength="11"
                       name="reservation_orderer_contact" placeholder="휴대전화번호"
                       aria-label="휴대전화번호" onkeypress="inputPhoneNumber(this)"
                       aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-secondary input-group-btn" type="button"
                          onclick="sendContact()">인증번호 발송
                  </button>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="contactcheck" name="contactcheck"
                       placeholder="인증번호"
                       aria-label="인증번호 확인"
                       aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-secondary input-group-btn" type="button"
                          onclick="checkContact()" id="contactcheck_btn" disabled="true">인증번호 확인
                  </button>
                </div>
              </div>
              <div class="btn-group btn-group-toggle w-100 mt-custom" data-toggle="buttons">
                <label class="btn btn-secondary active w-50">
                  <input type="radio" name="options" id="walk" autocomplete="off" checked> 차량미이용
                </label>
                <label class="btn btn-secondary w-50">
                  <input type="radio" name="options" id="car" autocomplete="off"> 차량이용
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-5 probootstrap-animate text-center">
            <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">예약확인</h2>
            <div class="probootstrap-form probootstrap-form-box mb60 text-left">
              <p class="m-0">숙소이름</p>
              <p class="contents">{{ $partner->name }}</p>
              <p class="m-0">객실정보/ 기간</p>
              @if($room->room_product_sale_type == "대실")
                <p class="contents div-line">{{ $room->room_name }} / <span
                    id="ck_time">{{ $room->room_renting_use_time }}</span>
                  시간</p>
              @elseif($room->room_product_sale_type == "대여")
                <p class="contents div-line">{{ $room->room_name }} / <span
                    id="ck_time">{{ $room->room_rent_use_time }}</span>
                  시간</p>
              @else
                <p class="contents div-line">{{ $room->room_name }}
                  / {{ $diff_date = (strtotime($out) - strtotime($in)) / 86400 }}
                  박</p>
              @endif

              <p class="m-0">체크인</p>
              <p class="contents" id="re_in">11.22 금 </p>
              <p class="m-0">체크아웃</p>
              <p class="contents m-0" id="re_out">11.23 토 </p>
            </div>
          </div>
        </div>


        <div class="row">
          @if( $room->room_product_extra_whether == 'true' && Count($extras) > 0)
            @if( $room->room_product_people_add_whether == 'true' && Count($addpeople) > 0)
              <div class="col-lg-7 probootstrap-animate text-center mb-5 extra-section">
                @else
                  <div class="col-12 probootstrap-animate text-center mb-5">
                    @endif
                    <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">부가 서비스</h2>
                    <!-- Swiper -->
                    <div class="swiper-container">
                      <div class="swiper-wrapper">
                        @foreach($extras as $extra)
                          <div class="swiper-slide">
                            <div class="media probootstrap-media d-block align-items-stretch probootstrap-animate">
                              <img src="{{ $extra->room_extra_route . $extra->room_extra_save_name }}"
                                   alt="Free Template by uiCookies" class="img-fluid extra-img">
                            </div>
                            <div class="media-body extra-contents">
                              <div class="input-group count-group">
                                <div class="input-group-append">
                                  <button type="button" class="btn btn-secondary count-left active"
                                          name="extra_minus_{{ $extra->room_extra_idx }}"
                                          id="extra_minus_{{ $extra->room_extra_idx}}" value="0"
                                          onclick="extraClick('{{ $extra->room_extra_idx }}','-','{{ $extra->room_extra_name }}','{{ $extra->room_extra_price }}')"
                                          disabled
                                  ><i class="fa fa-minus" aria-hidden="true"></i></button>
                                </div>
                                <input class="form-control count-span" value="0"
                                       id="extra{{ $extra->room_extra_idx }}" name="extra{{ $extra->room_extra_idx }}"
                                       readonly>
                                <div class="input-group-append">
                                  <button type="button" class="btn btn-secondary count-right active"
                                          name="extra_plus_{{ $extra->room_extra_idx }}"
                                          id="extra_plus_{{ $extra->room_extra_idx}}"
                                          value="{{ $extra->room_extra_quantity }}"
                                          onclick="extraClick('{{ $extra->room_extra_idx }}','+','{{ $extra->room_extra_name }}','{{ $extra->room_extra_price }}')">
                                    <i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                              </div>
                              <span class="">{{ $extra->room_extra_name }}</span>
                              <span class=""> ( {{ number_format($extra->room_extra_price) }} 원) </span>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                    @endif
                  </div>


                  @if( $room->room_product_people_add_whether == 'true' && Count($addpeople) > 0)
                    @if( $room->room_product_extra_whether == 'true' && Count($extras) > 0)
                      <div class="col-lg-5 probootstrap-animate text-center extra-section">
                        @else
                          <div class="col-12 probootstrap-animate text-center">
                            @endif
                            <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">인원 추가</h2>
                            <div class="probootstrap-form probootstrap-form-box mb60">
                              <div class="row mb-4">
                                <div class="col-12">
                                  <span class="contents ml-3 float-right display-6">최대
                                    <span class="text-red display-5">{{ $room->room_maximum_people }}명</span> 이용 가능
                                  </span>
                                </div>
                              </div>
                              @foreach($addpeople as $people)
                                @if($people->room_people_add_name == "성인")
                                  <div class="row mb-4" style="margin: auto;">
                                    <div class="col-12 count-contents">
                                      <div class="count-title">성인</div>
                                      <div class="input-group count-group">
                                        <div class="input-group-append">
                                          <button type="button" class="btn btn-secondary count-left active"
                                                  id="adult_minus_people"
                                                  name="adult_minus_people"
                                                  onclick="adultclick('-')"
                                                  disabled><i
                                              class="fa fa-minus"
                                              aria-hidden="true"></i>
                                          </button>
                                        </div>
                                        <input class="form-control count-span" value="{{ $room->room_standard_people }}"
                                               readonly id="adult_people"
                                               name="adult_people">
                                        <div class="input-group-append">
                                          <button type="button" class="btn btn-secondary count-right active"
                                                  id="adult_plus_people"
                                                  name="adult_plus_people"
                                                  onclick="adultclick('+')">
                                            <i class="fa fa-plus"
                                               aria-hidden="true"></i>
                                          </button>
                                        </div>
                                        <input type="hidden"
                                               value="{{ $people->room_people_add_price }}"
                                               id="adult_price">
                                      </div>
                                    </div>
                                  </div>
                                @elseif($people->room_people_add_name == "아동")
                                  <div class="row" style="margin: auto;">
                                    <div class="col-12 count-contents">
                                      <div class="count-title">아동</div>
                                      <div class="input-group count-group">
                                        <div class="input-group-append">
                                          <button type="button" class="btn btn-secondary count-left active"
                                                  id="child_minus_people" disabled
                                                  name="child_minus_people"
                                                  onclick="childclick('-')">
                                            <i
                                              class="fa fa-minus"
                                              aria-hidden="true"></i>
                                          </button>
                                        </div>
                                        <input class="form-control count-span" value="0" readonly id="child_people"
                                               name="child_people">
                                        <div class="input-group-append">
                                          <button type="button" class="btn btn-secondary count-right active"
                                                  id="child_plus_people"
                                                  name="child_plus_people"
                                                  onclick="childclick('+')">
                                            <i class="fa fa-plus"
                                               aria-hidden="true"></i>
                                          </button>
                                        </div>
                                      </div>
                                      <input type="hidden"
                                             value="{{ $people->room_people_add_price }}"
                                             id="child_price">
                                    </div>
                                  </div>
                                @endif
                              @endforeach
                            </div>
                          </div>
                        @endif
                      </div>

                      <div class="row">
                        <div class="col-md-7 probootstrap-animate text-center">
                          {{--                        onclick="payClick('card_pay','카드결제')"   onclick="payClick('bank_pay','계좌이체')"  onclick="payClick('site_pay','현장결제')"--}}
                          <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">결제수단</h2>
                          <div class="probootstrap-form probootstrap-form-box mb60 text-left">
                            <p>결제 수단 선택</p>
                            <div class="list-group mb-3">
                              <a href="#none"
                                 class="list-group-item list-group-item-action active"><input
                                  type="radio" name="pay" id="card_pay" value="카드결제"
                                  checked> <span
                                  class="float-right"><i class="iconsminds-credit-card mr-1"></i> 카드결제</span></a>
                              <a href="#none"
                                 class="list-group-item list-group-item-action"><input type="radio" id="bank_pay"
                                                                                       name="pay" value="무통장입금">
                                <span
                                  class="float-right"><i
                                    class="iconsminds-mail-money mr-1"></i> 무통장입금</span></a>
                              <a href="#none"
                                 class="list-group-item list-group-item-action"><input type="radio" id="site_pay"
                                                                                       name="pay" value="현장결제">
                                <span
                                  class="float-right"><i
                                    class="iconsminds-financial mr-1"></i> 현장결제</span></a>
                            </div>
                            <div id="pay_detail"></div>
                            <div class="info">(주)블루웹 통신판매중개자로서, 통신판매의 당사자가 아니라는 사실을 고지하며 상품의 예약, 이용 및 환불 등과 관련한 의무와
                              책임은
                              각 판매자에게 있습니다.
                            </div>
                          </div>
                        </div>
                        <div class="col-md-5 probootstrap-animate text-center">
                          <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">결제하기</h2>
                          <div class="probootstrap-form probootstrap-form-box mb60 text-left">
                            <p class="contents m-0">총 결제금액(VAT 포함)</p>
                            <p class="price div-line"><span
                                id="all_price">{{ number_format($room->sum_price) }}</span>원
                              <button class="btn btn-secondary float-right" type="button" id="detail_show">
                                상세보기
                              </button>
                            </p>
                            <div class="container show active check-section" id="check">
                              <div>
                                <lable><input type="checkbox" id="check_all"> 전체동의</lable>
                              </div>
                              <div class="items">
                                <input class="typeCk" type="checkbox" id="check_1"> <span
                                  class="text-red">(필수)</span> <a href="#" onclick="terms(1)"> 숙소
                                  이용 및 취소 / 환불규정 </a> 동의
                              </div>
                              <div class="items">
                                <input class="typeCk" type="checkbox" id="check_2"> <span
                                  class="text-red">(필수)</span> <a href="#" onclick="terms(2)"> 개인정보
                                  수집 및 이용</a>
                                동의
                              </div>
                              <div class="items">
                                <input class="typeCk" type="checkbox" id="check_3"> <span
                                  class="text-red">(필수)</span> <a href="#" onclick="terms(3)"> 개인정보
                                  제 3자 제공</a>
                                동의
                              </div>
                              <div class="items">
                                <input class="typeCk" type="checkbox" id="check_4"> <span
                                  class="text-red">(필수)</span> <a href="#" onclick="terms(4)"> 만 18세 이상입니다.</a> 동의
                              </div>
                            </div>
                            <div class="container detail-section" id="detail">
                              <p class="mb-2">+ 상품가격
                                <span> {{ number_format($room->room_product_price + $room->room_product_add_price) }}</span>원
                              </p>
                              <p class="mb-2 text-red">-
                                할인금액 {{ number_format($room->room_product_discount_price) }}원</p>
                              <p class="mb-1">+ 부가서비스 <span id="extra"> 0</span>원</p>
                              <p class="mb-2">+ 인원추가 <span id="people"> 0</span>원</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary w-100 mb-3">결제하기</button>
              </div>
        </div>
      </div>
    </form>
  </section>


  <div class="modal fade" id="agree1" tabindex="-1" role="dialog" aria-labelledby="agree1"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">숙소이용 및 취소/ 환불규정 동의</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="padding: 0.25rem 0.75rem;">×</span>
          </button>
        </div>
        <div class="modal-body">
                    <span
                      class="display-6 text-black">올바른 예약문화 정착을 위하여 각 숙박업소별 적용하는 이용규칙 및 취소/환불 규정을 제시하고 있습니다.</span><br><br>
          1) 객실 요금은 기준 인원 입실 기준이며, 인원추가시 추가요금이 발생됩니다.<br>
          2) 객실 이용은 최대인원 까지만 입실 가능하며, 최대인원 초과시 입실 불가합니다.<br>
          3) 예약대기의 경우 취소수수료가 별도로 발생되지 않으나 올바른 예약문화 정착을 위하여 신중히 예약부탁드립니다.<br>
          4) 예약완료 후 취소 시 취소수수료 발생됩니다.<br>
          5) 이용 당일 예약 후 취소한 경우에도 이용 당일 취소이므로 환불이 불가합니다.<br>
          6) 추가적인 이용규칙은 각 해당업체 정보를 확인해주시기 바랍니다.<br>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="agree2" tabindex="-1" role="dialog" aria-labelledby="agree2"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">개인정보 수집 및 이용 동의</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="padding: 0.25rem 0.75rem;">×</span>
          </button>
        </div>
        <div class="modal-body">
          <span class="display-6 text-black">(주)모집'는 (이하 '회사'는) 고객님의 개인정보보호를 매우 중요시하며, "정보통신망 이용촉진 및 정보보호"에 관한 법률을 준수하고 있습니다.</span><br><br>
          수집하는 개인정보 항목<br>
          1) 구매자 (예약자)<br>
          - 수집항목 : 이름, 휴대전화번호, 로그인ID , 비밀번호 , 생년월일 , 이메일 , 서비스 이용 / 결제기록<br>
          - 개인정보 수집방법 : 홈페이지(회원가입,주문,예약)<br>
          2) 판매자 (가맹점, 업주)<br>
          - 수집항목 : 업소명 , 로그인ID , 비밀번호 , 담당자 및 신청인 정보 , 연락처 , 홈페이지주소 , 사업자정보(세무신고 관련정보 일체) , 계좌정보<br>
          - 개인정보 수집방법 : 홈페이지 (가맹접수, 계약) 및 서류접수 (FAX / 우편)<br>
          개인정보의 수집 및 이용목적<br>
          회사는 수집한 개인정보를 다음의 목적을 위해 활용합니다.<br>
          - 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산<br>
          구매 및 요금 결제<br>
          - 예약 관리<br>
          숙박업소 이용 및 사후 관리에 필요한 차원의 본인확인 및 식별<br>
          - 가맹 관리<br>
          입점 계약 진행 및 가맹점 관리 차원<br>
          개인정보의 보유 및 이용기간<br>
          회사는 개인정보 수집 및 이용목적이 달성된 후에는 예외 없이 해당 정보를 지체 없이 파기합니다.<br>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="agree3" tabindex="-1" role="dialog" aria-labelledby="agree3"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">개인정보 제3자 제 동의</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="padding: 0.25rem 0.75rem;">×</span>
          </button>
        </div>
        <div class="modal-body">
          <span class="display-6 text-black">이용자의 경우</span><br><br>
          1) 개인정보를 제공받는 자 : 이용하고자 하는 해당 업소<br>
          2) 제3자의 개인정보 이용 목적 : 숙박업소를 이용하는 고객의 본인확인 및 미성년자, 혼숙 여부를 확인하고 연락을 유지하기 위함<br>
          3) 제공하는 개인정보의 항목 : 이름, 휴대전화번호, 이메일, 생년월일, 예약정보<br>
          4) 보유기간 : 이용완료 후 5년<br>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="agree4" tabindex="-1" role="dialog" aria-labelledby="agree4"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">만 18세 이상입니다.</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="padding: 0.25rem 0.75rem;">×</span>
          </button>
        </div>
        <div class="modal-body">
          1) 미성년자는 투숙 불가하며 미성년자에 의한 예약에 대한 숙소의 입실거부 시 취소/환불이 불가합니다.<br>
          2) 숙박업소는 법적으로 청소년 혼숙이 금지되어 있으며, 발견시 퇴실조치 및 취소/환불 불가합니다.<br>
        </div>
      </div>
    </div>
  </div>

  <!-- END section -->


@endsection

@section('scripts')
  <script src="/js/swiper.min.js"></script>
  <script>
      var check = false;
      var detail_show = false;
      $(function () {
          $("#detail").hide();
          if ("{{ $room->room_product_sale_type }}" != "숙박") {
            @foreach( $selectTime as $time)
            $("#time" + "{{ $time }}").attr("disabled", true);
            @endforeach
          }
          var yoil = ["일", "월", "화", "수", "목", "금", "토"];
          $("#re_in").html('{{ date('Y.m.d', strtotime($in)) }}' + " (" + yoil[new Date('{{ date('Y.m.d', strtotime($in)) }}').getDay()] + ")");
          $("#re_out").html('{{ date('Y.m.d', strtotime($out)) }}' + " (" + yoil[new Date('{{ date('Y.m.d', strtotime($out)) }}').getDay()] + ")");


          if(Number($("#adult_people").val())+Number($("#child_people").val()) == Number($("#max_people").val()) ){
              $("#child_plus_people").prop("disabled", true);
              $("#adult_plus_people").prop("disabled", true);
          }

          //전체선택
          $("#check_all").change(function (e) {
              e.preventDefault();
              e.stopPropagation();

              if (check == false) {
                  $('.typeCk').prop("checked", true);
                  check = true;
              } else {
                  $('.typeCk').prop("checked", false);
                  check = false;
              }
          });

          $("#detail_show").on("click", function (e) {
              if (detail_show) {
                  $("#detail").hide();
                  $("#check").show();
                  detail_show = false;
              } else {
                  // $("#extra").html($("#reservation_extra_price").val());
                  // $("#people").html(Number($("#add_child_price").val()) +  Number($("#add_adult_price").val()));

                  $("#check").hide();
                  $("#detail").show();
                  detail_show = true;
              }
              $str = "상세보기";
              if (detail_show) {
                  $str = "약관보기";
              }
              $("#detail_show").html($str);
          });

          $(".list-group-item").on("click", function (e) {
              $(".list-group-item").removeClass("active");
              $(this).addClass("active");
              $("input[name = pay]").attr("checked", false);
              $(this).children("input[name = pay]").attr("checked", true);
              if ($(this).children("input[name = pay]").val() == "카드결제") {
                  $("#pay_detail").html("");
              } else if ($(this).children("input[name = pay]").val() == "무통장입금") {
                  $("#pay_detail").html("<span class='text-red'> 입급계좌정보   &nbsp&nbsp&nbsp    {{ $contract->partner_contract_accountnumber." / ".$contract->partner_contract_bank." / ".$contract->partner_contract_accountholder  }}</span>");
              } else {
                  $("#pay_detail").html("<span class='text-red'>현장에 방문하시어 직접 결제 부탁드립니다.</span>");
              }
          });

          $("#card_pay").on("click", function () {

          });
          $("#site_pay").on("click", function () {

          });
          $("#bank_pay").on("click", function () {

          });

      });

      function timeclick(id) {
          timeClick = 0;
          if ("{{ $room->room_product_sale_type }}" == "대실") {
            @for ($i =$room->room_renting_use_start_date ; $i <$room->room_renting_use_end_date+1 ; $i++)
            $("#time" + "{{ $i }}").prop("checked", false);
            @endfor
              @for ($i = 0; $i <$room->room_renting_use_time; $i++)
            if ($("#time" + (Number(id) + {{ $i }})).prop("disabled") == false) {
                $("#time" + (Number(id) + {{ $i }})).prop("checked", true);
                timeClick++;
            }
            @endfor
          } else {
            @for ($i = $room->room_rent_use_start_date; $i < $room->room_rent_use_end_date+1; $i++)
            $("#time" + "{{ $i }}").prop("checked", false);
            @endfor
              @for ($i = 0; $i <$room->room_rent_use_time; $i++)
            if ($("#time" + (Number(id) + {{ $i }})).prop("disabled") == false) {
                $("#time" + (Number(id) + {{ $i }})).prop("checked", true);
                timeClick++;
            }
            @endfor
          }

          $("#ck_time").html(timeClick); //결과 창에 시간 넣음
          $("#reservation_use_time").val(timeClick + "시간"); //input에 시간 값 넣음

          $("#reservation_use_start_date").val('{{ date('Y-m-d', strtotime($in)) }}' + " " + (Number(id)) + ":00");
          $("#reservation_use_end_date").val('{{ date('Y-m-d', strtotime($out)) }}' + " " + (Number(id) + timeClick) + ":00");

          var yoil = ["일", "월", "화", "수", "목", "금", "토"];
          $("#re_in").html('{{ date('Y.m.d', strtotime($in)) }}' + " (" + yoil[new Date('{{ date('Y.m.d', strtotime($in)) }}').getDay()] + ")" + " " + (Number(id)) + ":00");
          $("#re_out").html('{{ date('Y.m.d', strtotime($out)) }}' + " (" + yoil[new Date('{{ date('Y.m.d', strtotime($out)) }}').getDay()] + ")" + " " + (Number(id) + timeClick) + ":00");
      }

      var people = 0;

      function childclick(plus_minus) {
          // adult_minus_people  adult_people adult_plus_people
          if (plus_minus == "-") {
              $("#child_people").val(Number($("#child_people").val()) - 1);
              $("#child_plus_people").removeAttr('disabled');
              if ($("#child_people").val() <= 0) {
                  $("#child_minus_people").prop("disabled", true);
              }
          } else {
              $("#child_people").val(Number($("#child_people").val()) + 1);
              $("#child_minus_people").removeAttr('disabled');
              if (Number($("#child_people").val()) >= Number($("#max_people").val())) {
                  $("#child_plus_people").prop("disabled", true);
              }
          }
          $("#add_child").val($("#child_people").val());
          $("#add_child_price").val($("#child_price").val() * $("#child_people").val());

          people = Number($("#add_child").val()) + Number($("#add_adult").val());
          if ($("#max_people").val() <= people) {
              $("#child_plus_people").prop("disabled", true);
              $("#adult_plus_people").prop("disabled", true);
          } else {
              $("#child_plus_people").removeAttr('disabled');
              $("#adult_plus_people").removeAttr('disabled');
          }
          settingPrice();
      }

      function adultclick(plus_minus) {
          // adult_minus_people  adult_people adult_plus_people
          if (plus_minus == "-") {
              $("#adult_people").val(Number($("#adult_people").val()) - 1);
              $("#adult_plus_people").removeAttr('disabled');
              if (Number($("#adult_people").val()) <= Number($("#room_standard_people").val())) {
                  $("#adult_minus_people").prop("disabled", true);
              }
          } else {
              $("#adult_people").val(Number($("#adult_people").val()) + 1);
              $("#adult_minus_people").removeAttr('disabled');
              if (Number($("#adult_people").val()) >= Number($("#max_people").val())) {
                  $("#adult_plus_people").prop("disabled", true);
              }
          }
          $("#add_adult").val($("#adult_people").val());
          $("#add_adult_price").val($("#adult_price").val() * (Number($("#adult_people").val()) - $("#room_standard_people").val()));

          people = Number($("#add_child").val()) + Number($("#add_adult").val());
          if ($("#max_people").val() <= people) {
              $("#child_plus_people").prop("disabled", true);
              $("#adult_plus_people").prop("disabled", true);
          } else {
              $("#child_plus_people").removeAttr('disabled');
              $("#adult_plus_people").removeAttr('disabled');
          }
          settingPrice();
      }

      var extra = new Array();

      function extraClick(idx, plus_minus, name, price) {  //부가서비스 클릭시
          $price = 0;
          $count = 0;
          if (extra[name] != null) {
              if (plus_minus == "-") {
                  $count = Number($("#extra" + idx).val()) - 1;
                  $("#extra" + idx).val($count);
                  $("#reservation_extra_price").val(Number($("#reservation_extra_price").val()) - Number(price));
                  $("#extra_plus_" + idx).removeAttr('disabled');
                  if ($count <= 0) {
                      $("#extra_minus_" + idx).prop("disabled", true);
                  }
              } else if (plus_minus == "+") {
                  $count = Number($("#extra" + idx).val()) + 1;
                  $("#extra" + idx).val($count);
                  $("#reservation_extra_price").val(Number($("#reservation_extra_price").val()) + Number(price));
                  $("#extra_minus_" + idx).removeAttr('disabled');
                  if ($count >= $("#extra_plus_" + idx).val()) {
                      $("#extra_plus_" + idx).prop("disabled", true);
                  }
              }
          } else {
              $("#reservation_extra_price").val(Number($("#reservation_extra_price").val()) + Number(price));
              $("#extra" + idx).val(1);
              $("#extra_minus_" + idx).removeAttr('disabled');
              if (1 >= $("#extra_plus_" + idx).val()) {
                  $("#extra_plus_" + idx).prop("disabled", true);
              }
          }
          extra[name] = $count;
          settingPrice();
      }

      function myInfo() {//내정보 불러오기 클릭시
          $("#reservation_orderer_name").val("{{ Auth::user()->name }}");
          $("#reservation_orderer_contact").val("{{ Auth::user()->contact }}");
      }

      function settingPrice() { //총가격 변경하는 부분
          $("#reservation_people_add_price").val(Number($("#add_child_price").val()) + Number($("#add_adult_price").val()));
          $("#all_price").html(Number($("#reservation_payment_price").val()) + Number($("#reservation_people_add_price").val()) + Number($("#reservation_extra_price").val()));
          $("#all_price").html($("#all_price").html().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

          $("#extra").html($("#reservation_extra_price").val().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
          $("#people").html($("#reservation_people_add_price").val().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
      }


      function checked() {
          if ($("#reservation_orderer_name").val() == "") {
              $("#reservation_orderer_name").focus();
              alert("이름을 입력 해주세요.");
              return false;
          }
          if ($("#reservation_orderer_contact").val() == "") {
              $("#reservation_orderer_contact").focus();
              alert("전화번호를 입력 해주세요.");
              return false;
          }

          if ($("#phone_ck").val() != "true") {
              $("#contactcheck").focus();
              alert("인증번호를 확인 해주세요.");
              return false;
          }
          if ("{{ $room->room_product_sale_type }}" != "숙박") {
              if ($("input[name=time]:checked").val() == null) {
                  alert("시간을 선택해 주세요.");
                  return false;
              }
          }
          $("#reservation_payment_way").val($("input[name=pay]:checked").val());
          $("#reservation_payment_price").val($("#all_price").html().replace(",", ""));

          if ($("#walk").prop("checked"))
              $("#reservation_orderer_visit_way").val("차량미이용");
          else
              $("#reservation_orderer_visit_way").val("차량이용");

          $("#add_child").val($("#child_people").val());
          $("#add_adult").val($("#adult_people").val());

          //부가 서비스 정보 저장
          $extra_str = "";
          for ($ex in extra) {
              $extra_str += $ex + " : " + extra[$ex] + " 개 ,";
          }
          $("#reservation_extra_information").val($extra_str);
          if ($("#check_1").prop("checked") && $("#check_2").prop("checked") && $("#check_3").prop("checked") && $("#check_4").prop("checked")) {
              return true;
          }
          return false;
      }

      // function save(type) {
      //     if ($("#check_1").prop("checked") && $("#check_2").prop("checked") && $("#check_3").prop("checked") && $("#check_4").prop("checked")) {
      //         if ($("#walk").prop("checked"))
      //             $("#reservation_orderer_visit_way").val("도보");
      //         else
      //             $("#reservation_orderer_visit_way").val("차량");
      //
      //         var formData = $("#insertFrom").serialize();
      //         //alert(formData);
      //         $.ajax({
      //             url: '/reserve/save',
      //             type: "POST",
      //             dataType: "json",
      //             data: formData,
      //             error: function (request, status, error) {
      //                 //alert("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
      //             }
      //         }).done(function (response) {
      //             if (!$.isEmptyObject(response.error)) {
      //                 alert(response.error[0]);
      //             } else {
      //                 if (response.result == 0) {
      //                     alert("예약을 실패 하였습니다.");
      //                 } else if (response.result == 2) {
      //                     var idx = response.idx;
      //                     alert("예약을 성공 하였습니다.");
      //                     location.href = "/confirm?idx="+idx;
      //                 }
      //             }
      //         });
      //     } else {
      //         alert("취소/환불규정을 동의 해주세요.");
      //         return false;
      //     }
      // }

      function terms(id) {
          $("#agree" + id).modal("show");
      }


      function sendContact() {
          if ($("#reservation_orderer_contact").val() != null) {
              $.ajax({
                  url: '/reserve/contact/send',
                  type: "POST",
                  dataType: "json",
                  data: {
                      "reservation_orderer_name": $("#reservation_orderer_name").val(),
                      "reservation_orderer_contact": $("#reservation_orderer_contact").val(),
                      "_token": "{{{ csrf_token() }}}"
                  },
                  error: function (request, status, error) {
                      alert("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
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
              url: '/reserve/contact/check',
              type: "POST",
              dataType: "json",
              data: {
                  "contactcheck": $("#contactcheck").val(),
                  "reservation_orderer_contact": $("#reservation_orderer_contact").val(),
                  "_token": "{{{ csrf_token() }}}"
              },
          }).done(function (response) {
              if (response.result == 0) {
                  alert("인증번호가 틀렸습니다.");
              } else {
                  alert("인증을 성공 하였습니다.");
                  $("#phone_ck").val("true");
              }
          });
      }

      // 휴대폰번호
      function inputPhoneNumber(obj) {
          $("#phone_ck").val("false");
          var number = $(obj).val().replace(/[^0-9]/g, "");
          var phone = "";
          $(obj).val(number.replace(/[^0-9]/g, ""));
          $("#contactcheck_btn").attr('disabled', 'disabled');

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


      var swiper = new Swiper('.swiper-container', {
          breakpoints: {
              0: {
                  slidesPerView: 1.3,
                  spaceBetween: 10
              },
              // when window width is >= 320px
              600: {
                  slidesPerView: 1.3,
                  spaceBetween: 10
              },
              // when window width is >= 480px
              800: {
                  slidesPerView: 2.2,
                  spaceBetween: 10
              },
              // when window width is >= 640px
              1000: {
                  slidesPerView: 2.2,
                  spaceBetween: 10
              }
          },
          freeMode: true
      });
  </script>
@endsection
