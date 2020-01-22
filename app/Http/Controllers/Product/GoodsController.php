<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    public function index(Request $request)
    {        DB::enableQueryLog();
        $partner_type = $request->input('type');
        if (!$request->input('type')) {
            $partner_type = '모텔';
        }
        $partner_sido = $request->input('partner_sido');
        $partner_sigungu = $request->input('partner_sigungu');
        if(!$request->input('partner_sido')){
            $partners = DB::table('partner')
                ->where('partner_type', '=', $partner_type)
                ->get();
        }else{
            $partners = DB::table('partner')
                ->where('partner_type', '=', $partner_type)
                ->where('partner_sido', '=', $partner_sido)
                ->where('partner_sigungu', '=', $partner_sigungu)
                ->get();//->dd(DB::getQueryLog());
        }

        $now_date = date('Y-m-d');




        if ($request->input('json') == true) {

            $img = "<div class=\"swiper-slide\"><img
                  src=\"%s\"  style=\"height: 240px;\" onerror=\"this.src='/images/no_image.png'\"
                  class=\"w-100\"></div>";

            $str = "  <div class=\"row mb-3 probootstrap-media\"> 
            <div class=\"col-md-4\">
            <!-- Swiper -->
            <div class=\"swiper-container\">
            <div class=\"swiper-wrapper\">
              %s
            </div>
            <!-- Add Pagination -->
            <div class=\"swiper-pagination\"></div>
          </div>
        </div>
              <div class=\"col-md-8\" onclick = \"roomDetail('%s')\">
          <div class=\"p-3\">
              <h5 class=\"mb-1\">%s</h5>
              <div class=\"good-card-text-wrapper\">
                <div class=\"good-card-available-date\">%s 부터 예약가능</div>
                <!--div class=\"good-card-title\">현장결제시 무한대실</div-->
                <div class=\"row\">
              %s
                </div>
                <div class=\"good-card-buy-cnt\">%s</div>
              </div>
            </div>
          </div>
        </div>";
            $renting =
                "<div class=\"col-6 pr-0 good-card-price-section-left\" onclick=\"reserve('renting', '%s');\">
                    <div class=\"p-1 good-card-price-title\">대실 <span class=\"good-card-price-sub-title\">(%s시간)</span></div>
                    <div class=\"good-card-original-price\"> %s</div>
                    <div class=\"good-card-price\">₩ %s
                    </div>
                  </div>";

            $lodgment = "<div class=\"col-6 pr-0 good-card-price-section-right\" onclick=\"reserve('lodgment', '%s');\">
                    <div class=\"p-1 good-card-price-title\">숙박</div>
                    <div class=\"good-card-original-price\"> %s</div>
                    <div class=\"good-card-price\">₩ %s
                    </div>
                  </div>";
            $rent = "<div class=\"col-6 pr-0 good-card-price-section-right\" onclick=\"reserve('lodgment', '%s');\">
                    <div class=\"p-1 good-card-price-title\">대여</div>
                    <div class=\"good-card-original-price\"> %s</div>
                    <div class=\"good-card-price\">₩ %s
                    </div>
                  </div>";


            $datas_rs = "";
            if (count($partners) > 0) {
                foreach ($partners as $key => $partner) {
                    $datas_pro = "";
                    $datas_img = "";

                    $rooms = DB::table('room')
                        ->where('id', '=', $partner->id)
                        ->where('room_exposure_whether', '=', 'true')
                        ->orderBy('room.room_idx')
                        ->get();//->dd(DB::getQueryLog());

                    foreach ($rooms as $key => $value) {
                        $datas_img .= sprintf($img,
                            $value->room_rep_image_route . $value->room_rep_image_save_name
                        );
                    }
                    $room_product = "";
                    $room_product = DB::table('room')
                        ->join('room_product', 'room_product.room_idx', '=', 'room.room_idx')
                        ->where('id', '=', $partner->id)
                        ->where('room.room_exposure_whether', '=', 'true')
                        //->where('room_product.room_product_sale_type', '=', '숙박')
                        ->orderBy('room_product.room_product_sale_type',"asc","room_product.room_product_sale_price","asc")
                        ->groupBy('room_product.room_product_sale_type','room_product_sale_price')
                        ->get();//->dd(DB::getQueryLog());
                    $type = "";
                    foreach ($room_product as $key => $value2) {
                        if($type != $value2->room_product_sale_type){
                            if ($value2->room_product_sale_type == "대실") {
                                $datas_pro .= sprintf($renting,
                                    $value2->room_idx
                                    , $value2->room_renting_use_time
                                    , $value2->room_product_price >= $value2->room_product_sale_price ? "₩" . number_format($value2->room_product_price) : ""
                                    , number_format($value2->room_product_sale_price)
                                );
                            } else if ($value2->room_product_sale_type == "숙박") {
                                // if ($diff_date < 2) {
                                $datas_pro .= sprintf($lodgment,
                                    $value2->room_idx
                                    , $value2->room_product_price > $value2->room_product_sale_price ? "₩" . number_format($value2->room_product_price) : ""
                                    , number_format($value2->room_product_sale_price)
                                );
                            } else {
                                $datas_pro .= sprintf($rent,
                                    $value2->room_idx
                                    , $value2->room_product_price > $value2->room_product_sale_price ? "₩" . number_format($value2->room_product_price) : ""
                                    , number_format($value2->room_product_sale_price)
                                );
                            }
                            $type = $value2->room_product_sale_type;
                        }
                    }

                    if (count($rooms) == 0) {
                        $datas_img = "<div class=\"swiper-slide\"><img
                  src=\"\"  style=\"height: 240px;\" onerror=\"this.src='/images/no_image.png'\"
                  class=\"w-100\"></div>";
                    }


                    $datas_rs .= sprintf($str,
                        $datas_img
                        , $partner->id
                        , $partner->name
                        , date("m월 d일", strtotime($now_date))
                        , $datas_pro
                        , $partner->partner_sido . "시 " . $partner->partner_sigungu
                    );

                }
            } else {
                $datas_rs = "<div class=\"container\">
            <div class=\"reserve_none\">
              <i>&nbsp;</i>
              <b>선택하신 지역에 예약 가능한 객실이 없습니다.</b>이용에 불편을 드려 죄송합니다.
<!--              <b>선택하신 날짜에 예약 가능한 객실이 없습니다.</b>날짜를 변경하세요.-->
            </div>
                            </div>";
            }
            return response()->json(['datas' => $datas_rs]);
        }

        return view('product.goods', [
            'now_date' => $now_date
            , 'type' => $partner_type
        ]);
    }

}
