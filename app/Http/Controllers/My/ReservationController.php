<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $partner_type = $request->input('type');
        if (!$request->input('type')) {
            $partner_type = '모텔';
        }

        $datas = DB::table('reservation')
            ->join('room', 'room.room_idx', 'reservation.room_idx')
            ->join('partner', 'partner.id', 'reservation.partner_idx')
            ->where('user_id', Auth::user()->id)
            ->orderBy('reservation_idx', 'desc')
            ->get();

        $str = "";
        if ($request->input('json') == 'true') {
            $str = "<div class=\"row mb-3\">
            <div class=\"col-md-12\">
              <div class=\"media probootstrap-media d-flex align-items-stretch mb-4\">
                <div class=\"probootstrap-media-image\"
                     style=\"background-image: url(%s)\">
                </div>
                <div class=\"media-body\">
                  <h5 class=\"mb-1 reservation-main\">%s</h5>
                  <div><span class=\"reservation-title\">객실정보</span> <span
                      class=\"reservation-contents\">%s</span>
                  </div>
                    <div class=\"mb-3\"><span class=\"reservation-title\">방문일자</span>
                      <span
                        class=\"reservation-contents\">%s
                            </span>
                    </div>
                  <div class=\"mb-1\">
                    <button class=\"btn btn-primary w-100\" onclick=\"detail(%s)\"
                            data-toggle=\"modal\" data-target=\"#reservationModal\">상세 보기
                    </button>
                  </div>";
//{{--                  <div class=\"mb-1\">--}}
//{{--                    <button class=\"btn btn-danger w-100\" onclick=\"review({{ $data->reservation_idx }})\"--}}
//{{--                            data-toggle=\"modal\" data-target=\"#exampleModal2\">후기 작성--}}
//{{--                    </button>--}}
//{{--                  </div>--}}
//                  {{--                  <div>--}}
//                  {{--                    <button class=\"btn btn-secondary w-100\" data-toggle=\"modal\"--}}
//                  {{--                            data-target=\"#exampleModal3\">QR코드 예약번호 확인--}}
//                  {{--                    </button>--}}
//                  {{--                  </div>--}}

            $str .= "<div>
                      <button class=\"btn btn-danger w-100\" %s onclick=\"cancle('%s','%s')\">예약 취소
                      </button>
                    </div>
                </div>
              </div>
            </div>
          </div>";

            $datas_rs = "";
            if (count($datas) > 0) {
                foreach ($datas as $data) {
                    $date = "";
                    if ($data->reservation_type == "숙박") {
                        $date = date("Y년m월d일", strtotime($data->reservation_use_start_date)) . " ~ "
                            . date("Y년m월d일", strtotime($data->reservation_use_end_date));
                    } else {
                        if (date("Y년m월d일", strtotime($data->reservation_use_start_date)) == date("Y년m월d일", strtotime($data->reservation_use_end_date))) {
                            $date = date("H시", strtotime($data->reservation_use_end_date));
                        } else if (date("Y년m월", strtotime($data->reservation_use_start_date)) == date("Y년m월", strtotime($data->reservation_use_end_date))) {
                            $date = date("d일 H시", strtotime($data->reservation_use_end_date));
                        } else if (date("Y년", strtotime($data->reservation_use_start_date)) == date("Y년", strtotime($data->reservation_use_end_date))) {
                            $date = date("m월d일 H시", strtotime($data->reservation_use_end_date));
                        } else {
                            $date = date("Y년m월d일 H시", strtotime($data->reservation_use_end_date));
                        }
                    }
                    $disabled = "disabled";
                    if (strtotime($data->reservation_use_end_date) > strtotime(date("Y-m-d h:i:s")) && ($data->reservation_state == "예약완료" || $data->reservation_state == "예약대기")) {
                        $disabled = "";
                    }
                    $datas_rs .= sprintf($str
                        , $data->room_rep_image_route . $data->room_rep_image_save_name
                        , $data->name
                        , $data->room_name
                        , $date
                        , $data->reservation_idx
                        , $disabled
                        , $data->partner_idx
                        , $data->reservation_idx
                    );
                }
            } else {
                $datas_rs = "<div class=\"container\">
          <div class=\"reserve_none\">
            <i>&nbsp;</i>
            <b>예약하신 내역이 없습니다.</b>- 모집 -
          </div>
        </div>";
            }
            return response()->json(['datas' => $datas_rs]);
        }

        return view('my.reservation', [
            'datas' => $datas
        ]);
    }

    public
    function show(Request $request)
    {
        DB::enableQueryLog();
        $datas = DB::table('reservation')
            ->where('reservation_idx', $request->input('reservation_idx'))
            ->get();//->dd(DB::getQueryLog());

        $str = "<div class=\"modal-header\">
                    <h5 class=\"modal-title\" id=\"exampleModalLabel\">예약번호 (%s)</h5>
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                        <span aria-hidden=\"true\" style=\"padding: 0.25rem 0.75rem;\">×</span>
                    </button>
                </div>
                <div class=\"modal-body\">
                    <div class=\"detail-title\"><span class=\"float-left\">예약자명</span><span
                            class=\"float-right detail-contents\">%s</span></div>
                    <br>
                    <div class=\"detail-title\"><span class=\"float-left\">예약자 연락처</span><span
                            class=\"float-right detail-contents\">%s</span>
                    </div>
                    <br>
                    <div class=\"detail-title\"><span class=\"float-left\">예약일시</span><span
                            class=\"float-right detail-contents\">%s</span>
                    </div>
                    <br>
                    <div class='detail-title'><span class='float-left'>예약상태</span><span
                     class='float-right detail-contents'>%s</span> 
                    </div>
                    <div class=\"black-line\"></div>
                    <div class=\"detail-title mt-2\"><span class=\"float-eft\">객실 정보 / 기간</span><span
                            class=\"float-right detail-contents\">%s / %s</span>
                    </div>
                    <div class=\"detail-title\"><span class=\"float-left\">숙박유형</span><span
                            class=\"float-right detail-contents\">%s</span>
                    </div>
                    <br>
                    <div class=\"detail-title\"><span class=\"float-left\">이용인원</span><span
                            class=\"float-right detail-contents\">%s</span>
                    </div>
                    <br>
                    %s
                    <div class=\"detail-title\"><span class=\"float-left\">체크인</span><span
                            class=\"float-right detail-contents\">%s</span>
                    </div>
                    <br>
                    <div class=\"detail-title\"><span class=\"float-left\">체크아웃</span><span
                            class=\"float-right detail-contents\">%s</span>
                    </div>
                    <div class=\"black-line\"></div>
                    <div class=\"detail_info\"><span><i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> 예약시 입력한 휴대폰번호는 숙소에 문자 전송됩니다.</span>
                    </div>
                    <div class=\"reservation-bill\">
                        <div class=\"bill-detail-title main-title mb-2\"><span class=\"float-left\">결제수단</span><span
                                class=\"float-right bill-detail-contents main-contents\">%s</span></div>
                        <br>
                        <div class=\"white-line\"></div>
                        %s
                        <div class=\"bill-detail-title\"><span class=\"float-left\">판매금액</span><span
                                class=\"float-right bill-detail-contents\">%s원</span></div>
                        <br>
                        <div class=\"bill-detail-title\"><span class=\"float-left\">결제금액</span><span
                                class=\"float-right bill-detail-contents\">%s원</span></div>
                        <br>
                        <div class=\"bill-detail-title\"><span class=\"float-left\">할인</span><span
                                class=\"float-right bill-detail-contents\">%s원</span></div>
                        <br>
                        <div class=\"reservation-bill-info\"><i>※</i><span>예약대기의 경우 업주가 확인이 아직 되지 않은 상태로 문자로 발송되 업주 번호로 확인부탁드립니다.</span></div>
                        <div class=\"reservation-bill-info\">
                            <i>※</i><span>취소수수료는 결제금액을 기준으로 계산됩니다.</span></div>
                        <div class=\"reservation-bill-info\"><i>※</i><span>자세한 취소수수료는 취소규정을 참고해주시기 바랍니다.</span>
                        </div>
                    </div>
             </div>";

        $datas_rs = "";
        if (count($datas) > 0) {
            foreach ($datas as $key => $value) {
                $in_date = date("Y년 m월 d일 h시", strtotime($value->reservation_use_start_date));
                $out_date = date("Y년 m월 d일 h시", strtotime($value->reservation_use_end_date));
                if ($value->reservation_type == "숙박") {
                    $in_date = date("Y년 m월 d일", strtotime($value->reservation_use_start_date));
                    $out_date = date("Y년 m월 d일", strtotime($value->reservation_use_end_date));
                }
                $contract = "";
                if ($value->reservation_payment_way == "무통장입금") {
                    $contract_db = DB::table('partner_contract_information')
                        ->where('id', $value->partner_idx)
                        ->first();

                    $contract = "<div class=\"bill-detail-title mt-2\"><span class=\"float-left\">계좌번호 / 은행</span><span
                            class=\"float-right bill-detail-contents\">" . $contract_db->partner_contract_accountnumber . " / " . $contract_db->partner_contract_bank . "</span>
                    </div><br>";
                }

                $extra = "";
                if ($value->reservation_extra_information) {
                    $extra = "<div class=\"detail-title\"><span class=\"float-left\">부가서비스</span><span
                            class=\"float-right detail-contents\"></span>
                    </div>
                    <br>";
                }

                $datas_rs .= sprintf($str,
                    $value->reservation_number
                    , $value->reservation_orderer_name
                    , $value->reservation_orderer_contact
                    , date("Y년 m월 d일 h시 i분", strtotime($value->reservation_enrollment_date))
                    , $value->reservation_state
                    , $value->reservation_partner_room_name
                    , $value->reservation_use_time
                    , $value->reservation_type
                    , $value->reservation_people_add_information
                    , $extra
                    , $in_date
                    , $out_date
                    , $value->reservation_payment_way
                    , $contract
                    , number_format($value->reservation_payment_price)
                    , number_format($value->reservation_payment_price - $value->reservation_discount_price)
                    , number_format($value->reservation_discount_price)
                );
            }
        } else {
            $datas_rs = "
            <div class=\"container\">
              <div class=\"reserve_none\">
                <i>&nbsp;</i>
                <b>예약하신 내역이 없습니다.</b>- 모집 -
              </div>
            </div>";
        }
        return response()->json(['datas' => $datas_rs]);
    }

    function cancle(Request $request)
    {
        DB::enableQueryLog();
        $refund_rule = DB::table('refund_rule_information')
            ->where('id', $request->input('idx'))
            ->get();//->dd(DB::getQueryLog());

        $str_rules = "<section class=\"mb-5\">
                  <div class=\"section_title\"><h4> 취소 및 환불 수수료</h4></div>
                  <div class=\"cancle_commission_table ml-3\">
                      %s
                  </div>
              </section>";

        $str_rule = "<div class=\"tbody tr\">
                          <div class=\"left text-black\">%s 수수료 %s</div>
                          <div class=\"right\"></div>
                   </div>";

        $datas_rule = "";
        foreach ($refund_rule as $key => $value) {
            $datas_rule .= sprintf($str_rule,
                $value->refund_rule_information_referencedate
                , $value->refund_rule_information_cancel_fees . '%'
            );
        }
        $datas_rules = sprintf($str_rules,
            $datas_rule);

        return response()->json(['datas' => $datas_rules]);
    }

    function store(Request $request)
    {
        $data = DB::table('reservation')
            ->where('reservation_idx', $request->input('idx'))
            ->first();
        $refund_date = (strtotime($data->reservation_use_start_date) - strtotime(date("Y-m-d h:i:s"))) / 86400;
        $str = "";
        if ($refund_date >= 1) {
            $str = "입실" . $refund_date . "일전";
        } else if ($refund_date == 0) {
            $str = "이용일 당일";
        }
        $rule = DB::table('refund_rule_information')
            ->where('id', $data->partner_idx)
            ->where('refund_rule_information_referencedate', $str)
            ->first();

        if ($rule == null) {
            $rule = DB::table('refund_rule_information')
                ->where('id', $data->partner_idx)
                ->where('refund_rule_information_referencedate', "기본 취소 수수료")
                ->first();
        }
        $fees = 0;
        if ($rule != null) {
            $fees = $data->reservation_payment_price - ($data->reservation_payment_price * $rule->refund_rule_information_cancel_fees);
        }

        $state = "취소요청";
        $reservation_refund_price = $fees;
        if ($data->reservation_state == "예약대기" && $data->reservation_payment_way != "카드결제") {
            $state = "예약취소";
            $reservation_refund_price = 0;
        }

        $result = DB::table('reservation')
            ->where('reservation_idx', $request->input('idx'))
            ->update([
                'reservation_state' => $state,
                'reservation_refund_price' => $reservation_refund_price,
                'reservation_refund_way' => $request->input('reservation_refund_way'),
                'reservation_cancel_apply_date' => now(),
            ]);

        if ($result != 0) {
            ////문자 전달 부분
            $order_str = "[ %s 예약]
%s님의 %s 예약 취소요청이 %s 되었습니다.
취소의 권한은 업체에게 있으며, 업체에서 확인 후 처리 예정입니다.
취소요청이 지연될 경우 업체에 전화를 통하여 문의 및 요청 부탁드립니다.

# 업체정보
업체 전화번호 : %s

# 참고사항
예약취소시 취소규정에 따라 취소수수료가 부가될 수 있습니다. 자세한 취소수수료는 업체 취소규정을 참고해주시기 바랍니다.

홈페이지 및 예약창 플랫폼은 모집에서 제공하고 있습니다.
모집은 항상 고객님께 늘 좋은 플랫폼 서비스로 보답하겠습니다.
";
            $start = date("Y년 m월 d일 H시", strtotime($data->reservation_use_start_date));
            if ($data->reservation_type == "숙박") {
                $start = date("Y년 m월 d일", strtotime($data->reservation_use_start_date));
            }
            $order_data = sprintf($order_str,
                $data->reservation_partner_name
                , $data->reservation_orderer_name
                , $data->reservation_type
                , $data->reservation_state == "취소요청" ? "접수" : "완료"
                , $data->reservation_partner_contact
            );
            // 고객에게 전달
            $result = DB::table('SDK_MMS_SEND')
                ->insert([
                    'USER_ID' => "blueweb10"
                    , 'SCHEDULE_TYPE' => 0
                    , 'SUBJECT' => "예약확인 안내 전송입니다."
                    , 'MMS_MSG' => $order_data
                    , 'NOW_DATE' => Date("YmdHi")
                    , 'SEND_DATE' => Date("YmdHi", strtotime(date("YmdHi") . "+1 minute"))
                    , 'CALLBACK' => "0234291910"
                    , 'DEST_INFO' => $data->reservation_orderer_name . "^" . $data->reservation_orderer_contact
                ]);
            $partner_str = "[ 예약취소요청 ]
%s의 %s 예약 취소가 %s 되었습니다.
해당 사유를 확인하시어 취소 부탁드리며, 해당 %s의 취소수수료를 참고하여 취소 부탁드립니다. 

# 예약정보
유형 : %s 
예약자명 : %s / %s
입실일자 : %s

# 결제정보
결제수단 : %s
결제금액 : %s원

# 취소수수료
결제일 %s일 기준 %s원

# 참고사항
1.	예약취소의 경우 업주의 권한으로 이루어지며, 모집에서는 직접 취소를 하지 않습니다.
2.	카드결제 취소의 경우 모집 고객센터로 전화를 주셔야만 취소가 가능합니다. 카드결제 건 취소의 경우 꼭 모집으로 연락 부탁드리겠습니다.
모집 고객센터 : 02-3429-1910

모집은 항상 사장님께 많은 홍보 및 고객 유입, 늘 좋은 플랫폼 서비스 제공을 하도록 최선을 다하겠습니다.
";

            $partner_data = sprintf($partner_str,
                $data->reservation_orderer_name
                , $data->reservation_type
                , "접수"
                , $data->reservation_partner_name
                , $data->reservation_type
                , $data->reservation_orderer_name
                , $data->reservation_orderer_contact
                , $start
                , $data->reservation_payment_way
                , number_format($data->reservation_payment_price)
                , $refund_date == 0 ? '당' : $refund_date
                , number_format($fees)
            );

            //업체에게 전달
            $result = DB::table('SDK_MMS_SEND')
                ->insert([
                    'USER_ID' => "blueweb10"
                    , 'SCHEDULE_TYPE' => 0
                    , 'SUBJECT' => "예약확인 안내 전송입니다."
                    , 'MMS_MSG' => $partner_data
                    , 'NOW_DATE' => Date("YmdHi")
                    , 'SEND_DATE' => Date("YmdHi", strtotime(date("YmdHi") . "+1 minute"))
                    , 'CALLBACK' => "0234291910"
                    , 'DEST_INFO' => $data->reservation_partner_name . "^" . $data->reservation_partner_contact
                ]);
        }

        return response()->json(['result' => $result]);
    }
}
