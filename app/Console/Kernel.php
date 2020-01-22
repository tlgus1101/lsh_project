<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//      $schedule->call(function () {
//
//        DB::enableQueryLog();
//        $now_date = date('Y-m-d h:i:s');
//
//        $datas = DB::table('reservation')
//          ->where('reservation_enrollment_date', "<=", date('Y-m-d h:i:00', strtotime($now_date . "-2 hours")))
//          ->where('reservation_state', "예약대기")
//          ->where('reservation_payment_way', "무통장입금")
//          ->get();//->dd(DB::getQueryLog());
//
//        $order_str = "[ %s 예약]
//%s님의 %s 예약 취소 되었습니다.
//취소의 권한은 업체에게 있으며, 업체에서 확인 후 처리 예정입니다.
//취소요청이 지연될 경우 업체에 전화를 통하여 문의 및 요청 부탁드립니다.
//
//# 업체정보
//업체 전화번호 : %s
//
//# 참고사항
//예약취소시 취소규정에 따라 취소수수료가 부가될 수 있습니다. 자세한 취소수수료는 업체 취소규정을 참고해주시기 바랍니다.
//
//홈페이지 및 예약창 플랫폼은 모집에서 제공하고 있습니다.
//모집은 항상 고객님께 늘 좋은 플랫폼 서비스로 보답하겠습니다.
//";
//
//        foreach ($datas as $data) {
//          $result = DB::table('reservation')
//            ->where('reservation_idx', $data->reservation_idx)
//            ->update([
//              'reservation_state' => "예약취소"
//            ]);//->dd(DB::getQueryLog());
//
//          $start = date("Y년 m월 d일 H시", strtotime($data->reservation_use_start_date));
//          if ($data->reservation_type == "숙박") {
//            $start = date("Y년 m월 d일", strtotime($data->reservation_use_start_date));
//          }
//          $order_data = sprintf($order_str,
//            $data->reservation_partner_name
//            , $data->reservation_orderer_name
//            , $data->reservation_type
//            , $data->reservation_partner_contact
//          );
//
//          // 고객에게 전달
//          $result = DB::table('SDK_MMS_SEND')
//            ->insert([
//              'USER_ID' => "blueweb10"
//              , 'SCHEDULE_TYPE' => 0
//              , 'SUBJECT' => "예약취소 안내 전송입니다."
//              , 'MMS_MSG' => $order_data
//              , 'NOW_DATE' => Date("YmdHi")
//              , 'SEND_DATE' => Date("YmdHi", strtotime(date("YmdHi") . "+1 minute"))
//              , 'CALLBACK' => "0234291910"
//              , 'DEST_INFO' => $data->reservation_orderer_name . "^" . $data->reservation_orderer_contact
//            ]);
//
//          $partner_str = "[ 입금 미완료 예약취소 ]
//%s의 %s 예약이 취소 되었습니다.
//확인 부탁드립니다.
//
//# 예약정보
//유형 : %s
//예약자명 : %s / %s
//입실일자 : %s
//
//# 결제정보
//결제수단 : %s
//결제금액 : %s원
//
//모집은 항상 사장님께 많은 홍보 및 고객 유입, 늘 좋은 플랫폼 서비스 제공을 하도록 최선을 다하겠습니다.
//";
//
//          $partner_data = sprintf($partner_str,
//            $data->reservation_orderer_name
//            , $data->reservation_type
//            , $data->reservation_type
//            , $data->reservation_orderer_name
//            , $data->reservation_orderer_contact
//            , $start
//            , $data->reservation_payment_way
//            , number_format($data->reservation_payment_price)
//          );
//
//          //업체에게 전달
//          $result = DB::table('SDK_MMS_SEND')
//            ->insert([
//              'USER_ID' => "blueweb10"
//              , 'SCHEDULE_TYPE' => 0
//              , 'SUBJECT' => "예약확인 안내 전송입니다."
//              , 'MMS_MSG' => $partner_data
//              , 'NOW_DATE' => Date("YmdHi")
//              , 'SEND_DATE' => Date("YmdHi", strtotime(date("YmdHi") . "+1 minute"))
//              , 'CALLBACK' => "0234291910"
//              , 'DEST_INFO' => $data->reservation_partner_name . "^" . $data->reservation_partner_contact
//            ]);
//        }
//      })->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
