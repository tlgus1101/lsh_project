@extends('layouts.layout')

@section('title')

@endsection

@section('style')
  <link rel="stylesheet" href="/css/product.css">
@endsection

@section('content')

  <section class="probootstrap-cover overflow-hidden relative"
           style="background-image: url('//cloudfront.mo-zip.co.kr/mo-zip/images/bg.jpg'); padding: 2em 0 0"
           data-stellar-background-ratio="0.5"
           id="section-home">
    <div class="overlay"></div>
    <div class="container top-container">
      <div class="row align-items-center text-center">
        <div class="col-md">
          <h2 class="heading mb-2 display-5 font-light probootstrap-animate">예약이 완료되었습니다!​</h2>
        </div>
      </div>
    </div>
  </section>

  <!-- END section -->
  <section class="probootstrap_section probootstrap_lg_pt-50" id="section-city-guides">
    <div class="container">
      <div class="row mb-3">
        <div class="col-md-12">
          <div class="d-flex probootstrap-animate">
            <div class="card p-4" style="margin: auto">
              <div class="detail-title"><span class="float-left">예약자명</span><span
                  class="float-right detail-contents">{{ $data->reservation_orderer_name }}</span>
              </div>
              <div class="detail-title"><span class="float-left">예약자 연락처</span><span
                  class="float-right detail-contents">{{ $data->reservation_orderer_contact }}</span>
              </div>
              <div class="detail-title"><span class="float-left">예약일시</span><span
                  class="float-right detail-contents">{{ date("Y년m월d일 H시i분s초", strtotime($data->reservation_enrollment_date)) }}</span>
              </div>
              <div class='detail-title'><span class='float-left'>예약상태</span><span
                  class='float-right detail-contents'>{{ $data->reservation_state }}</span>
              </div>
              @if($data->reservation_payment_way =="무통장입금" )
                <div class="detail-title"><span class="float-eft">계좌번호 / 은행 / 예금주</span><span
                    class="float-right detail-contents">{{ $contract->partner_contract_accountnumber." / ".$contract->partner_contract_bank." / ".$contract->partner_contract_accountholder  }}</span>
                </div>
                <div class="detail-title text-red ml-1"> *무통장 입금일 경우 2시간 안에 입금 부탁드립니다. 미입금시 자동 취소 됩니다.</div>
              @endif
              <div class="black-line"></div>
              <div class="detail-title" style="margin-top: 1rem"><span class="float-eft">객실 정보 / 기간</span><span
                  class="float-right detail-contents">{{ $data->reservation_partner_room_name }} / {{ $data->reservation_use_time }}</span>
              </div>
              <div class="detail-title"><span class="float-left">숙박유형</span><span
                  class="float-right detail-contents">{{ $data->reservation_type }}</span>
              </div>
              <div class="detail-title"><span class="float-left">이용인원</span><span
                  class="float-right detail-contents">{{ $data->reservation_people_add_information }}</span>
              </div>
              @if($data->reservation_extra_information)
              <div class="detail-title"><span class="float-left">부가서비스</span><span
                  class="float-right detail-contents">{{ $data->reservation_extra_information }}</span>
              </div>
              @endif
              @if( $data->reservation_type == '숙박' )
                <div class="detail-title"><span class="float-left">체크인</span><span
                    class="float-right detail-contents">{{ date("Y년m월d일", strtotime($data->reservation_use_start_date)) }}</span>
                </div>
                <div class="detail-title"><span class="float-left">체크아웃</span><span
                    class="float-right detail-contents">{{ date("Y년m월d일", strtotime($data->reservation_use_end_date)) }}</span>
                </div>
              @else
                <div class="detail-title"><span class="float-left">체크인</span><span
                    class="float-right detail-contents">{{ date("Y년m월d일 H시", strtotime($data->reservation_use_start_date)) }}</span>
                </div>
                <div class="detail-title"><span class="float-left">체크아웃</span><span
                    class="float-right detail-contents">{{ date("Y년m월d일 H시", strtotime($data->reservation_use_end_date)) }}</span>
                </div>
              @endif
              <div class="black-line"></div>
              <div class="detail_info"><span><i class="fa fa-info-circle" aria-hidden="true"></i> 예약시 입력한 휴대폰번호 {{ $data->reservation_orderer_contact }} 은(는) 안심번호로 숙소에 전달되며, 퇴실 후 5일간 보관됩니다.</span>
              </div>
              <div class="reservation-bill">
                <div class="bill-detail-title main-title mb-2
                                        "><span class="float-left">결제수단</span><span
                    class="float-right bill-detail-contents main-contents">{{ $data->reservation_payment_way }}</span>
                </div>
                <br>
                <div class="white-line"></div>
                <div class="bill-detail-title mt-2
                                    "><span class="float-left">판매금액</span><span
                    class="float-right bill-detail-contents">{{ number_format($data->reservation_payment_price + $data->reservation_discount_price ) }}원</span>
                </div>
                <br>
                <div class="bill-detail-title"><span class="float-left">결제금액</span><span
                    class="float-right bill-detail-contents">{{ number_format($data->reservation_payment_price) }}원</span>
                </div>
                <br>
                <div class="bill-detail-title"><span class="float-left">할인</span><span
                    class="float-right bill-detail-contents">{{ number_format($data->reservation_discount_price) }}원</span>
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
@endsection

@section('scripts')

@endsection
