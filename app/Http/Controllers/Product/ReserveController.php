<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReserveController extends Controller
{
    public function index(Request $request)
    {
        DB::enableQueryLog();
        $now_date = date('Y-m-d');

        $in_date = $request->input('year')."-".$request->input('month')."-".$request->input('date');
        $out_date = $request->input('year')."-".$request->input('month')."-".$request->input('date');

        if (!$in_date) {
            $in_date = $now_date;
        }
        if (!$out_date) {
            $out_date = $now_date;
        }
        $room = DB::table('room')
            ->where('room_idx', $request->input('idx'))
            ->first();

//        if ($request->input('type') == 1) {//대실일경우
            $room_product = DB::table('room_product')
                ->select('*', DB::raw('SUM(room_product_sale_price) as sum_price, count(*) as count '))
                ->join('room', 'room.room_idx', '=', 'room_product.room_idx')
                ->where('room.room_idx', $request->input('idx'))
                ->whereDate('room_product_start_date', $in_date)
                ->where('room_product.room_product_sale_type', "대여")
                ->groupBy('room.room_idx')
        ->first();//->dd(DB::getQueryLog());
            $out_date = $in_date;
//        } else if ($request->input('type') == 2) {//숙박일 경우
//            $room_product = DB::table('room_product')
//                ->select('*', DB::raw('SUM(room_product_sale_price) as sum_price, count(*) as count '))
//                ->join('room', 'room.room_idx', '=', 'room_product.room_idx')
//                ->where('room.room_idx', $request->input('idx'))
//                ->whereBetween('room_product_start_date', [$in_date, $out_date])
//                ->where('room_product.room_product_sale_type', "숙박")
//                ->groupBy('room.room_idx')
//                ->first();//->dd(DB::getQueryLog());
//        } else {
//            $room_product = DB::table('room_product')
//                ->select('*', DB::raw('SUM(room_product_sale_price) as sum_price, count(*) as count '))
//                ->join('room', 'room.room_idx', '=', 'room_product.room_idx')
//                ->where('room.room_idx', $request->input('idx'))
//                ->whereDate('room_product_start_date', $in_date)
//                ->where('room_product.room_product_sale_type', "대여")
//                ->groupBy('room.room_idx')
//                ->first();//->dd(DB::getQueryLog());
//            $out_date = $request->input('start');
//        }

        $partner = DB::table('partner')
            ->where('id', $room_product->id)
            ->first();

        $contract_db = DB::table('partner_contract_information')
            ->where('id', $partner->id)
            ->first();

        $selectTime = [];
//        if ($request->input('type') != 2) {
//            $reservations = "";
//            if ($request->input('type') == 1) {
//                $reservations = DB::table('reservation')
//                    ->where('room_product_idx', $room_product->room_product_idx)
//                    ->whereDate('reservation_use_start_date', $in_date)
//                    ->where('reservation_type', "대실")
//                    ->get();
//            } else if ($request->input('type') == 3) {
                $reservations = DB::table('reservation')
                    ->where('room_product_idx', $room_product->room_product_idx)
                    ->whereDate('reservation_use_start_date', $in_date)
                    ->where('reservation_type', "대여")
                    ->get();
//            }
            if ($reservations) {
                foreach ($reservations as $reservation) {
                    $start = date("H", strtotime($reservation->reservation_use_start_date)) + 1 - 1;
                    $end = date("H", strtotime($reservation->reservation_use_end_date));
                    for ($i = $start; $i <= $end; $i++) {
                        array_push($selectTime, $i);
                    }
                }
            }
            if ($in_date == date("Ymd")) {
                $h = date("H");
                for ($i = 0; $i <= $h; $i++) {
                    array_push($selectTime, $i);
                }
            }
//        }

        $extras = DB::table('room_extra')
            ->where('id', $room->id)
            ->get();

        $addpeople = DB::table('room_people_add')
            ->where('id', $room->id)
            ->orderBy("room_people_add_name")
            ->get();
  
            return view('other.reserve', [
                'partner' => $partner, 'contract' => $contract_db, 'room' => $room_product, 'extras' => $extras, 'addpeople' => $addpeople,
                 'in' => $in_date, 'out' => $out_date, 'start' => $request->input('start') , 'end' => $request->input('end')
            ]);
    
    }


    // 예약 등록
    public function store(Request $request)
    {
        //날짜 시간 모텔코드
        $date = Date("ymd") . rand(0000, 9999) . $request->input('partner_code');

        if ($request->input('extra') != null || $request->input('extra') != " " || $request->input('extra') != NAN) {
            $extra_price = $request->input('reservation_extra_price');
        } else {
            $extra = "0개";
            $extra_price = 0;
        }

        $addpeople = "성인 : " . $request->input('add_adult') . "명 , 아동 : " . $request->input('add_child') . "명";

        $result = DB::table('reservation')
            ->insert([
                'reservation_payment_price' => $request->input("reservation_payment_price"),
                'reservation_people_add_price' => $request->input('reservation_people_add_price'),
                'reservation_extra_price' => $extra_price,
                'reservation_orderer_name' => $request->input('reservation_orderer_name'),
                'reservation_orderer_contact' => preg_replace("/[^0-9]*/s", "", $request->input('reservation_orderer_contact')),
                'reservation_payment_way' => $request->input('reservation_payment_way'),
                'reservation_orderer_visit_way' => $request->input('reservation_orderer_visit_way'),
                'reservation_state' => "예약대기",
                'reservation_use_start_date' => $request->input('reservation_use_start_date'),
                'reservation_use_end_date' => $request->input('reservation_use_end_date'),
                'reservation_extra_information' => $request->input('reservation_extra_information'),
                'reservation_people_add_information' => $addpeople,
                'reservation_number' => $date,
                'reservation_people' => $request->input('add_adult') + $request->input('add_child'),
                'reservation_discount_price' => $request->input('room_product_discount_price'),
                'reservation_partner_name' => $request->input('reservation_partner_name'),
                'reservation_partner_room_name' => $request->input('reservation_partner_room_name'),
                'reservation_partner_contact' => $request->input('reservation_partner_contact'),
                'partner_idx' => $request->input('partner_idx'),
                'reservation_type' => $request->input('reservation_type'),
                'room_product_idx' => $request->input('room_product_idx'),
                'room_idx' => $request->input('room_idx'),
                'reservation_partner_area' => $request->input('reservation_payment_price'),
                'reservation_use_time' => $request->input('reservation_use_time'),
                'reservation_enrollment_date' => now(),
                'reservation_product_price' => $request->input('reservation_product_price'),
                'user_id' => Auth::user()->id,
            ]);

        if ($result == 0) {
            return response()->json(array('result' => $result), 200);
        }

        if ($request->input('type') == 1) {
            $diff_date = (strtotime($request->input('reservation_use_end_date')) - strtotime($request->input('reservation_use_start_date'))) / 86400;
            for ($i = 0; $i < $diff_date; $i++) {
                $d = date('Y-m-d', strtotime($request->input('reservation_use_start_date') . "+" . $i . " day"));
                $quantity = DB::table('room_product')
                    ->where('room_idx', $request->input('room_idx'))
                    ->whereDate('room_product_start_date', $d)
                    ->first('room_product_sale_quantity');

                DB::table('room_product')
                    ->where('room_idx', $request->input('room_idx'))
                    ->whereDate('room_product_start_date', $d)
                    ->update(['room_product_sale_quantity' => $quantity->room_product_sale_quantity - 1]);//->dd(DB::getQueryLog());
            }
        }

        $data = DB::table('reservation')
            ->orderBy("reservation_idx", 'desc')
            ->first();
        if ($request->input("reservation_payment_way") == "무통장입금" || $request->input("reservation_payment_way") == "현장결제") {
            $request->session()->put('idx', $data->reservation_idx);
            ////문자 전달 부분
            $order_str = "[ %s 예약]
%s님의 %s 예약이 %s 되었습니다.
예약접수의 경우 업체에서 확인 후 완료 또는 불가 안내 예정입니다.

# 예약정보
업체명 : %s
유형 : %s
예약자명 : %s / %s
이용기간 : %s
입실일자 : %s
퇴실일자 : %s
방문형태 : %s
                
# 업체정보
업체 전화번호 : %s
                
# 참고사항
1.	예약대기의 경우 업주가 확인하에 완료 또는 취소처리가 될 예정이니 일정 시간이 지난 후에도 변경이 없는 경우 업체 전화로 확인 부탁드립니다.
2.	예약취소시 취소규정에 따라 취소수수료가 부가될 수 있습니다. 자세한 취소수수료는 업체 취소규정을 참고해주시기 바랍니다.
3.	만약 취소가 필요할 경우 취소요청은 업주에게 권한이 있으므로, 업주와 통화 후 처리요청해주시기 바랍니다.

홈페이지 및 예약창 플랫폼은 모집에서 제공하고 있습니다.
모집은 항상 고객님께 늘 좋은 플랫폼 서비스로 보답하겠습니다.";

            $start = date("Y년 m월 d일 H시", strtotime($data->reservation_use_start_date));
            $end = date("Y년 m월 d일 H시", strtotime($data->reservation_use_end_date));
            if ($data->reservation_type == "숙박") {
                $start = date("Y년 m월 d일", strtotime($data->reservation_use_start_date));
                $end = date("Y년 m월 d일", strtotime($data->reservation_use_end_date));
            }

            $order_data = sprintf($order_str,
                $data->reservation_partner_name
                , $data->reservation_orderer_name
                , $data->reservation_type
                , $data->reservation_state
                , $data->reservation_partner_room_name
                , $data->reservation_type
                , $data->reservation_partner_name
                , $data->reservation_partner_room_name
                , $data->reservation_use_time
                , $start
                , $end
                , $data->reservation_orderer_visit_way
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
            $partner_str = "[%s]
%s님의 %s 예약이 %s 되었습니다.
예약대기를 확인 후 완료처리 부탁드리며, 만실 등의 사유로 이용이 어려울 경우 고객님께 안내 후 취소처리 부탁드립니다.

# 예약정보
업체명 : %s
유형 : %s
예약자명 : %s / %s
이용기간 : %s
입실일자 : %s
퇴실일자 : %s
방문형태 : %s

# 결제정보
결제수단 : %s
결제금액 : %s원

# 참고사항
1.	만약 취소가 필요할 경우 취소요청은 업주에게 권한이 있으므로, 고객님과 확인 후 처리 부탁드리겠습니다.
2.	카드결제의 경우 자동으로 완료처리가 되오니 취소가 필요한 경우 고객님께 내용 전달 후 모집 고객센터로 전화 부탁드리겠습니다.
모집 고객센터 : 02-3429-1910

모집은 항상 사장님께 많은 홍보 및 고객 유입, 늘 좋은 플랫폼 서비스 제공을하도록 최선을 다하겠습니다.";

            $partner_data = sprintf($partner_str,
                $data->reservation_state
                , $data->reservation_orderer_name
                , $data->reservation_type
                , $data->reservation_state
                , $data->reservation_partner_room_name
                , $data->reservation_type
                , $data->reservation_partner_name
                , $data->reservation_orderer_contact
                , $data->reservation_use_time
                , $start
                , $end
                , $data->reservation_orderer_visit_way
                , $data->reservation_payment_way
                , number_format($data->reservation_payment_price)
            );

            $notice_info = DB::table('notice_information')
                ->where('id', $data->partner_idx)
                ->where('notice_information_reservation_notice_whether', "true")
                ->get();

            foreach ($notice_info as $info) {
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
                        , 'DEST_INFO' => $info->notice_information_name . "^" . $info->notice_information_contact
                    ]);
            }

            return redirect('confirm/');
            //view('product.reserve', ['idx' => $data->reservation_idx]);

        } else { ///카드일경우
            return redirect('confirm/')->with('idx', $data->reservation_idx);
            //return response()->json(array('result' => 2, 'idx' => $data->reservation_idx), 200);
        }
    }

    public function contactcheck(Request $request)
    {
        $number = DB::table('user')
            ->where('id', Auth::user()->id)
            ->first();

        if ($number->authentication_number == $request->input('contactcheck')) {
            DB::table('user')
                ->where('id', Auth::user()->id)
                ->update([
                    'authentication' => 'true',
                    'contact' => $request->input('reservation_orderer_contact')
                ]);
            return response()->json(array('result' => 1), 200);
        } else {
            return response()->json(array('result' => 0), 200);
        }
        //return response()->json(array('result' => $result), 200);
    }

    public function contactsend(Request $request)
    {

        $date = Date("YmdHis");
        $rand = rand(000000, 999999);

        $result = DB::table('SDK_SMS_SEND')
            ->insert([
                'USER_ID' => "blueweb10"
                , 'SCHEDULE_TYPE' => 0
                , 'SUBJECT' => "인증번호 전송입니다."
                , 'SMS_MSG' => "[모집]인증번호 " . $rand . "를 입력해주세요."
                , 'CALLBACK_URL' => ""
                , 'NOW_DATE' => Date("YmdHi")
                , 'SEND_DATE' => Date("YmdHi", strtotime(date("YmdHi") . "+1 minute"))
                , 'CALLBACK' => "0234291910"
                , 'DEST_INFO' => $request->input('reservation_orderer_name') . "^" . $request->input('reservation_orderer_contact')
            ]);

        DB::table('user')
            ->where('id', Auth::user()->id)
            ->update([
                'authentication_number' => $rand,
            ]);

        return response()->json(array('result' => $result), 200);
    }
}
