<?php

namespace App\Http\Controllers\Shell;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ShellController extends Controller
{

  public function index(Request $request)
  {
    DB::enableQueryLog();
    $now_date = date('Y-m-d h:i:s');

    $datas = DB::table('reservation')
      ->where('reservation_enrollment_date', "<=", date('Y-m-d h:i:00', strtotime($now_date . "-2 hours")))
      ->where('reservation_state', "예약대기")
      ->where('reservation_payment_way', "무통장입금")
      ->get();//->dd(DB::getQueryLog());

    $order_str = "[ %s 예약]
%s님의 %s 예약이 자동 취소 되었습니다.
무통장입금시 2시간 안에 입금 확인이 되지 않아 자동 취소 되었습니다.
문제가 있을 경우 업체로 연락 후 확인 부탁드립니다.

# 업체정보
업체 전화번호 : %s

홈페이지 및 예약창 플랫폼은 모집에서 제공하고 있습니다.
모집은 항상 고객님께 늘 좋은 플랫폼 서비스로 보답하겠습니다.
";

    foreach ($datas as $data) {
      $result = DB::table('reservation')
        ->where('reservation_idx', $data->reservation_idx)
        ->update([
          'reservation_state' => "예약취소"
        ]);//->dd(DB::getQueryLog());

      $start = date("Y년 m월 d일 H시", strtotime($data->reservation_use_start_date));
      if ($data->reservation_type == "숙박") {
        $start = date("Y년 m월 d일", strtotime($data->reservation_use_start_date));
      }
      $order_data = sprintf($order_str,
        $data->reservation_partner_name
        , $data->reservation_orderer_name
        , $data->reservation_type
        , $data->reservation_partner_contact
      );

      // 고객에게 전달
      $result = DB::table('SDK_MMS_SEND')
        ->insert([
          'USER_ID' => "blueweb10"
          , 'SCHEDULE_TYPE' => 0
          , 'SUBJECT' => "예약취소 안내 전송입니다."
          , 'MMS_MSG' => $order_data
          , 'NOW_DATE' => Date("YmdHi")
          , 'SEND_DATE' => Date("YmdHi", strtotime(date("YmdHi") . "+1 minute"))
          , 'CALLBACK' => "0234291910"
          , 'DEST_INFO' => $data->reservation_orderer_name . "^" . $data->reservation_orderer_contact
        ]);

      $partner_str = "[ 입금 미완료 예약취소 ]
%s의 %s 예약이 자동 취소 되었습니다.
확인 부탁드립니다.

# 예약정보
유형 : %s 
예약자명 : %s / %s
입실일자 : %s

# 결제정보
결제수단 : %s
결제금액 : %s원

모집은 항상 사장님께 많은 홍보 및 고객 유입, 늘 좋은 플랫폼 서비스 제공을 하도록 최선을 다하겠습니다.
";

      $partner_data = sprintf($partner_str,
        $data->reservation_orderer_name
        , $data->reservation_type
        , $data->reservation_type
        , $data->reservation_orderer_name
        , $data->reservation_orderer_contact
        , $start
        , $data->reservation_payment_way
        , number_format($data->reservation_payment_price)
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
  }
}
