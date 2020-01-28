<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{

  public function index(Request $request)
  {
    // $partner_type = $request->input('id');

    $partner = DB::table('partner')
      ->where('id', '=', $request->input('id'))//$request->input('id')
      ->first();

    $now_date = date('Y-m-d');

    $in_date = $request->input('room_product_start_date');
    $out_date = $request->input('room_product_end_date');

    if (!$in_date) {
      $in_date = $now_date;
    }
    if (!$out_date) {
      $out_date = $now_date;
    }
    // 일수 차이 계산
    $diff_date = (strtotime($out_date) - strtotime($in_date)) / 86400;
    if ($diff_date == 0) {
      $out_date = date('Y-m-d', strtotime($out_date . "+1 day"));
    }

    DB::enableQueryLog();

    if ($request->input('json') == true) {
      $img = "
        <div class=\"swiper-slide\"><img
                  src=\"%s\" style=\"height: 240px;\" onerror=\"this.src='/images/no_image.png'\"
                  class=\"w-100\"></div>";

      $str = "  <div class=\"row mb-3 probootstrap-media\"> 
            <div class=\"col-lg-4\">
            <!-- Swiper -->
              <div class=\"swiper-container\">
                <div class=\"swiper-wrapper\">
                  %s
                </div>
            <!-- Add Pagination -->
                <div class=\"swiper-pagination\"></div>
              </div>
            </div>
            <div class=\"col-lg-8\">
              <div class=\"p-3\">
                <h5 class=\"mb-1\">%s (%s ㎡)</h5>
                기준 %s명  / 최대 %s명 
                <div class=\"good-card-text-wrapper\">
                  <div class=\"row pt-1\">
                    %s
                  </div>
                  </div>
                </div>
              </div>
            </div>";
        
        $list = "";
        $list_temp = "";
        $str_list = "<div class='room_idx' style='margin: 5px'><div class='room'>%s</div></div>";
        
        $str_list_de = "<div class='room'>
                        <input class='room' type='radio' name='room'
                               id='room_idx%s' value='%s'/>
                            <label for='room_idx%s'>%s</label>
                       </div>";
      
                                
      $renting =
        "<div class=\"col-6 p-2 good-card-price-section-left\">
                    <div class=\"pb-2 good-card-price-title\">대실</div>
                    <div class=\"float-left\">
                    <div class=\"good-card-sub\">이용<span class=\"d-none d-lg-inline-block\">시간</span>&nbsp;%s시간</div>
                    <div class=\"good-card-sub\">운영<span class=\"d-none d-lg-inline-block\">시간</span>&nbsp;%s</div>
                    </div>
                    <div class=\"float-right\">
                    <div class=\"good-card-original-price\"> %s</div>
                    <div class=\"good-card-price\">%s원</div>
                    </div>
                    <button type=\"button\" class=\"btn btn-primary w-100 mt-4\"  onclick=\"reserve('renting', '%s');\">대실 예약하기</button>
                  </div>";
      $lodgment = "<div class=\"col-6 p-2 good-card-price-section-right\">
                    <div class=\"pb-2 good-card-price-title\">숙박</div>
                    <div class=\"float-left\">
                    <div class=\"good-card-sub\">체크인  %s시</div>
                    <div class=\"good-card-sub\">체크아웃  %s시</div>
                    </div>
                    <div class=\"float-right\">
                    <div class=\"good-card-original-price\"> %s</div>
                    <div class=\"good-card-price\">%s원</div>
                    </div>
                    <button type=\"button\" class=\"btn btn-primary w-100 mt-4\"  onclick=\"reserve('lodgment', '%s');\">숙박 예약하기</button>
                  </div>";
      $rent = "<div class=\"col-6 p-2 good-card-price-section-right\">
                    <div class=\"pb-2 good-card-price-title\">대여</div>
                    <div class=\"float-left\">
                    <div class=\"good-card-sub\">이용<span class=\"d-none d-lg-inline-block\">시간</span>&nbsp;%s시간</div>
                    <div class=\"good-card-sub\">운영<span class=\"d-none d-lg-inline-block\">시간</span>&nbsp;%s</div>
                    </div>
                    <div class=\"float-right\">
                    <div class=\"good-card-original-price\"> %s</div>
                    <div class=\"good-card-price\">%s원</div>
                    </div>
                    <button type=\"button\" class=\"btn btn-primary w-100 mt-4\"  onclick=\"reserve('rent', '%s');\">대여 예약하기</button>
                  </div>";

      if ($diff_date < 2)
        $out_date = date('Y-m-d', strtotime($out_date . "-1 day"));
      else
        $out_date = $request->input('room_product_end_date');

      $datas_rs = "";

      $rooms = DB::table('room')
        ->where('id', '=', $request->input('id'))//$request->input('id')
        ->join('room_product', 'room_product.room_idx', '=', 'room.room_idx')
        ->where('room_exposure_whether', '=', 'true')
        ->whereBetween('room_product_start_date', [$in_date, $out_date])
        ->where('room_product_sale_quantity', '>', 0)
        ->groupBy('room.room_idx')
        ->orderBy('room.room_idx')
        ->get();//->dd(DB::getQueryLog());

      if (count($rooms) > 0) {

        foreach ($rooms as $key => $value) {
          $datas_pro = "";
          $datas_img = "";

          $room_product = DB::table('room')
            ->select('*', DB::raw('MIN(room_product_sale_price) as min_price, count(*) as count '))
            ->join('room_product', 'room_product.room_idx', '=', 'room.room_idx')
            ->where('room_exposure_whether', '=', 'true')
            ->whereBetween('room_product_start_date', [$in_date, $out_date])
            ->where('room.room_idx', '=', $value->room_idx)
            ->where('room_product_sale_quantity', '>', 0)
            ->groupBy('room_product.room_product_sale_type')
            ->get();//->dd(DB::getQueryLog());

          $imgs = DB::table('room_image')
            ->where('room_idx', $value->room_idx)
            ->get();

          $datas_img .= sprintf($img,
            $value->room_rep_image_route . $value->room_rep_image_save_name
          );

          foreach ($imgs as $key => $value2) {
            $datas_img .= sprintf($img,
              $value2->room_image_route . $value2->room_image_save_name
            );
          }

          foreach ($room_product as $key => $value2) {
            if ($diff_date <= $value2->count) {

//              if ($value2->room_product_sale_type == "대여") {
//                $datas_pro .= sprintf($renting
//                  , $value2->room_renting_use_time
//                  , $value2->room_renting_use_start_date . "시~" . $value2->room_renting_use_end_date . "시"
//                  , $value2->room_product_price >= $value2->room_product_sale_price ? "₩" . number_format($value2->room_product_price) : " "
//                  , number_format($diff_date < 2 ? $value2->room_product_sale_price : $value2->min_price)
//                  , $value2->room_idx
//                );
//              } else if ($value2->room_product_sale_type == "숙박") {
//                // if ($diff_date < 2) {
//                $datas_pro .= sprintf($lodgment
//                  , $value2->room_lodgment_use_start_date
//                  , $value2->room_lodgment_use_end_date
//                  , $value2->room_product_price > $value2->room_product_sale_price ? "₩" . number_format($value2->room_product_price) : " "
//                  , number_format($diff_date < 2 ? $value2->room_product_sale_price : $value2->min_price)
//                  , $value2->room_idx
//                );
//              } else {
                $datas_pro .= sprintf($rent
                  , $value2->room_rent_use_time
                  , $value2->room_rent_use_start_date . "~" . $value2->room_rent_use_end_date
                  , $value2->room_product_price > $value2->room_product_sale_price ? "₩" . number_format($value2->room_product_price) : " "
                  , number_format($diff_date < 2 ? $value2->room_product_sale_price : $value2->min_price)
                  , $value2->room_idx
                );
//              }
            }
          }
          $list_temp .= sprintf($str_list_de
                                       , $value->room_idx
                                       , $value->room_idx
                                       , $value->room_idx
                                       , $value->room_name);
          $datas_rs .= sprintf($str
            , $datas_img
            , $value->room_name
            , $value->room_size
            , $value->room_standard_people
            , $value->room_maximum_people
            , $datas_pro
          );
        }
      } else {
        $datas_rs = "<div class=\"container\">
            <div class=\"reserve_none\">
              <i>&nbsp;</i>
              <b>선택하신 날짜에 예약 가능한 객실이 없습니다.</b>날짜를 변경하세요.
            </div>
                            </div>";
      }
      $list.= sprintf($str_list,$list_temp);
      return response()->json(['datas' => $datas_rs ,'list' => $list]);
    }

    return view('other.index', [
      'id' => $request->input('id'),
      'partner' => $partner
    ]);
  }

  public function info(Request $request)
  {
    //DB::enableQueryLog();
    $str = "<section class=\"mb-5\">
                        <h4>-숙소 소개</h4>
                        <pre class=\"ml-3\" style=\"font-size: 100%%;\">%s</pre>
                        </section>
                        <section class=\"mb-5\">
                        <h4>- 편의시설 및 서비스</h4>
                        %s
                        </section>
                        %s
                        <section class=\"mb-5\">
                        <h4>- 찾아오시는 길</h4>
                        <pre class=\"ml-3\" style=\"font-size: 100%%;\">%s</pre>
                        </section>
                        <section class=\"mb-5\">
                        <h4>- 업체지도</h4>
                        <pre class=\"ml-3\" style=\"font-size: 100%%;\">%s</pre>
                        <div id=\"map\" style=\"width:100%%;height:400px;\"></div>
                         
                        
                        </section>";

    $str_rules = "<section class=\"mb-5\">
                  <div class=\"section_title\"><h4>- 취소 및 환불규정</h4></div>
                  <div class=\"cancle_commission_table ml-3\">
                      %s
                  </div>
              </section>";

    $str_rule = "<div class=\"tbody tr\">
                          <div class=\"left text-black\">%s %s</div>
                          <div class=\"right\"></div>
                      </div>";


    $facilit_str = "<div class='tag ml-3 text-black'>
                                  <i class='%s'></i>  %s
                              </div>";

    $datas_rs = "";

    $datas_facilities = "";
    $datas_rule = "";

    $partner = DB::table('partner')
      ->where('id', $request->input('id'))
      ->first();

    $room_facilities = DB::table('partner_facilities')
      ->join('facilities', 'facilities.facilities_idx', 'partner_facilities.facilities_idx')
      ->where('partner_facilities.partner_facilities_exposure_whether', 'true')
      ->where('facilities.facilities_exposure_whether', 'true')
      ->where('partner_facilities.id', $request->input('id'))
      ->get();

    foreach ($room_facilities as $key => $value) {
      $datas_facilities .= sprintf($facilit_str,
        $value->facilities_icon
        , $value->facilities_name
      );
    }
    $room_rule = DB::table('refund_rule_information')
      ->where('id', '=', $request->input('id'))
      ->get();


    foreach ($room_rule as $key => $value) {
      $datas_rule .= sprintf($str_rule,
        $value->refund_rule_information_referencedate
        , $value->refund_rule_information_cancel_fees . '%'
      );
    }
    $datas_rules = sprintf($str_rules,
      $datas_rule);


    $datas_rs .= sprintf($str
      , $partner->partner_introduce
      , $datas_facilities
      , $datas_rules
      , $partner->partner_road_information
      , $partner->partner_businessman_address
    );

    return response()->json(['datas' => $datas_rs, 'address' => $partner->partner_businessman_address, 'name' => $partner->name]);
  }
 public function timeList(Request $request){
        $str = '<tr align="center">
                    <td>
                        <a class="btn-link" >
                        <span> %s </span>
                        </a>
                    </td>
                   <td width="70%%">
                        <div class="select_time" style="margin: 5px">
                            %s
                        </div>
              
                  </td>
                </tr>';
     
        $btn_list = "";
        $datas_rs = "";
        $btn = '<div class="time">
                        <input class="time" type="checkbox" name="time"
                                id="time%s" onclick="timeclick(%s)">
                            <label for="time%s"> %s:00 </label>
                </div>';
   

        $datas_facilities = "";
        $datas_rule = "";

        $partner = DB::table('partner')
          ->where('id', $request->input('id'))
          ->first();

        $in_date =$request->input('year')."-".$request->input('month')."-".$request->input('date');
        $room = DB::table('room')
            ->where('room_idx', $request->input('idx'))
            ->first();
        
//        if ($request->input('type') == 1) {//대실일경우

     DB::enableQueryLog();
            $room_product = DB::table('room_product')
                ->join('room', 'room.room_idx', '=', 'room_product.room_idx')
                ->where('room.room_idx', $request->input('room_idx'))
                ->whereDate('room_product_start_date', $in_date)
                ->where('room_product.room_product_sale_type', "대여")
                ->groupBy('room.room_idx')
     ->first();//->dd(DB::getQueryLog());
          
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
     
            for ($i = $room_product->room_rent_use_start_date; $i < $room_product->room_rent_use_end_date; $i++){
                if($i < 10){
            $btn_list .= sprintf($btn
                                                   , "0".$i
                                                                , "0".$i
                                                                , "0".$i
                                                                 , "0".$i);
                }else{
                    $btn_list .= sprintf($btn
                                                                  , $i
                                                                  , $i
                                                                  , $i
                                                                   , $i);
                }
              
            }
            
            $datas_rs .= sprintf($str
              , $room_product->room_name
                                 ,$btn_list
                                 
            );
     
 
         return response()->json(['datas' => $datas_rs]);
    }
    
}
