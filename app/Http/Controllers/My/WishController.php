<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishController extends Controller
{
    public function index(Request $request)
    {
        DB::enableQueryLog();
        $partners = DB::table('wish')
            ->join('partner', 'partner.id', 'wish.partner_id')
            ->where('wish.id', Auth::user()->id)
            ->where('partner.partner_use_whether', 'true')
            ->get();//->dd(DB::getQueryLog());

        $timestamp = strtotime("+1 hours");
        $now_date = date('Y-m-d H:i:s', $timestamp);

        if ($request->input('json') == true) {

            $img = "<div class=\"swiper-slide\"><img
                  src=\"%s\"  style=\"height: 240px;\" onerror=\"this.src='/images/no_image.png'\"
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
              <div class=\"col-lg-8\" >
          <div class=\"p-3\">
              <h5 class=\"mb-1\">%s - %s%s</h5>
              <div class=\"good-card-text-wrapper\">
                <div class=\"good-card-sub\">%s</div>
                <div class=\"good-card-contents\">%s</div>
                <div class=\"good-card-contact\"><i class=\"simple-icon-phone\"></i> %s</div>
                <div class=\"good-card-place\"><i class=\"simple-icon-location-pin\"></i> %s</div>
                <div class=\"row\">
                        %s <!-- 버튼 하고 내용 등 중간부분에 들어갈것 -->
                </div>
              </div>
            </div>
          </div>
        </div>";

            $partner_button = "<div class=\"col-6 pr-0 good-card\">
                    <button type=\"button\" class=\"btn btn-primary w-100\" onclick = \"roomDetail('%s')\">예약하기</button>
                   </div>
                   <div class=\"col-6 pr-0 good-card\">
                     <button type=\"button\" class=\"btn btn-primary w-100\" onclick=\"homepageLink('%s')\">홈페이지</button>
                  </div>";

            $datas_rs = "";
            if (count($partners) > 0) {
                foreach ($partners as $key => $partner) {
                    $datas_img = "";

                    $rooms = DB::table('room')
                        ->where('id', '=', $partner->id)
                        ->where('room_exposure_whether', '=', 'true')
                        ->orderBy('room.room_idx')
                        ->get();//->dd(DB::getQueryLog());

                    $room_lodgment_price = 0;
                    $room_renting_price = 0;
                    $room_rent_price = 0;

                    foreach ($rooms as $key => $value) {
                        if ($value->room_lodgment_price < $room_lodgment_price) {
                            $room_lodgment_price = $value->room_lodgment_price;
                        }

                        if ($room_lodgment_price == 0) {
                            $room_lodgment_price = $value->room_lodgment_price;
                        }

                        if ($value->room_renting_price < $room_renting_price) {
                            $room_renting_price = $value->room_renting_price;
                        }

                        if ($room_renting_price == 0) {
                            $room_renting_price = $value->room_renting_price;
                        }

                        if ($value->room_rent_price < $room_rent_price) {
                            $room_rent_price = $value->room_rent_price;
                        }

                        if ($room_rent_price == 0) {
                            $room_rent_price = $value->room_rent_price;
                        }

                        $datas_img .= sprintf($img,
                            $value->room_rep_image_route . $value->room_rep_image_save_name
                        );

                        $product_use_date = "";
                        $room_product = DB::table('room_product')
                            ->where('room_idx', '=', $value->room_idx)
                            ->where('room_product_sale_quantity', '>', 0)
                            ->whereDate('room_product_start_date', ' >= ', $now_date)
                            ->orderBy('room_product_start_date')
                            ->first();//->dd(DB::getQueryLog());

                        if ($room_product) {
                            if (date("m월 d일", strtotime($product_use_date)) == date("m월 d일", strtotime($now_date))) {
                                $product_use_date = date("m월 d일 H시", strtotime($now_date . "+1 hours")) . "부터 예약가능";
                            } else {
                                $product_use_date = date("m월 d일", strtotime($room_product->room_product_start_date)) . "부터 예약가능";
                            }
                        }
                    }

                    $partner_type = $partner->partner_type;
                    if ($partner_type == "모텔") {
                        $price_info = "대실 " . number_format($room_renting_price) . " / 숙박 " . number_format($room_lodgment_price);
                    } else if ($partner_type == "호텔") {
                        $price_info = "숙박 " . number_format($room_lodgment_price);
                    } else if ($partner_type == "펜션") {
                        $price_info = "숙박 " . number_format($room_lodgment_price);
                    } else if ($partner_type == "글램핑") {
                        $price_info = "숙박 " . number_format($room_lodgment_price);
                    } else if ($partner_type == "공간대여") {
                        $price_info = "대여 " . number_format($room_rent_price);
                    }

                    $button = sprintf($partner_button,
                        $partner->id
                        , $partner->partner_homepage_link
                    );

                    $html = "<span id=\"wish%s\"><span class=\"float-right wish\" onclick=\"addWishlist('%s','%s','%s');\">%s</span></span>";

                    $wish = 'false';
                    $heart = "<i class=\"fa fa-heart-o\" aria-hidden=\"true\"></i>";
                    $rs_html = sprintf($html, $partner->id,'false', $wish, $partner->id, $heart);

                    if (Auth::check()) {
                        $user_wish = DB::table('wish')
                            ->where('partner_id', '=', $partner->id)
                            ->where('id', '=', Auth::user()->id)
                            ->value('wish_idx');

                        if ($user_wish) {
                            $wish = 'true';
                            $heart = "<i class=\"fa fa-heart\" aria-hidden=\"true\"></i>";
                        }

                        $rs_html = sprintf($html, $partner->id, 'true', $wish, $partner->id, $heart);
                    }

                    $datas_rs .= sprintf($str,
                        $datas_img
                        , $partner->partner_type
                        , $partner->name
                        , $rs_html
                        , $product_use_date
                        , $price_info
                        , $partner->partner_contact
                        , $partner->partner_sido . "시 " . $partner->partner_sigungu
                        , $button
                    );
                }
            }

            if (count($partners) == 0) {
                $datas_rs = "<div class=\"container\">
            <div class=\"reserve_none\">
              <i>&nbsp;</i>
              <b>추가하신 위시리스트가 없습니다.</b>자주가는 호텔을 추가하여 편하게 예약하세요~
            </div>
                            </div>";
            }

            return response()->json(['datas' => $datas_rs]);
        }
        return view('my.wishlist');
    }
}
