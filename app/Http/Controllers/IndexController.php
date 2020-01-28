<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;
use function Sodium\add;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        DB::enableQueryLog();
        $now_date = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime($now_date . "-7 day"));

        $datas = DB::table('community_category')
            //->inRandomOrder()
            ->orderBy('community_category_seq')
            ->get();//->dd(DB::getQueryLog());
        $new_datas = DB::table('community')
            ->where('community_enrollment_date','<=' ,$now_date)
            ->where('community_enrollment_date','>' ,$end_date)
            //->orderBy('community_enrollment_date','desc')
            ->inRandomOrder()
            ->take(10)
            ->get();//->dd(DB::getQueryLog());

        $cate = array();
        $contents[] = "";

        if (count($datas) > 0) {
            foreach ($datas as $key => $data) {
                $contents[$data->community_category_idx] = DB::table('community')
                    ->where('community_category', 'like', "%," . $data->community_category_idx . ",%")
                    ->inRandomOrder()
                    ->take(10)
                    ->get();

                if (count($contents[$data->community_category_idx]) > 0) {
                    array_push($cate, $data);
                }
            }
        }

        return view('index', ["cate" => $cate, "contents" => $contents, 'new_datas' => $new_datas ,'s3' => "//cloudfront.mo-zip.co.kr/mo-zip"]);
    }

    public function search(Request $request)
    {
        //DB::enableQueryLog();
        $first = DB::table('partner')
            ->select('name', 'partner_sido as sido', 'partner_sigungu as sigungu', 'partner_address as address', 'id as url')
            ->where("name", 'like', "%" . $request->input('query') . "%")
            ->orWhere("partner_address", 'like', "%" . $request->input('query') . "%")
            ->orWhere("partner_sido", 'like', "%" . $request->input('query') . "%")
            ->orWhere("partner_sigungu", 'like', "%" . $request->input('query') . "%")
            ->where('partner_use_whether','true');

        $datas = DB::table('community')
            ->select('community_name as name', 'community_sido as sido', 'community_sigungu as sigungu', 'community_address as address', 'community_link as url')
            ->where("community_name", 'like', "%" . $request->input('query') . "%")
            ->orWhere("community_address", 'like', "%" . $request->input('query') . "%")
            ->orWhere("community_sido", 'like', "%" . $request->input('query') . "%")
            ->orWhere("community_sigungu", 'like', "%" . $request->input('query') . "%")
            ->union($first)
            ->get();


        $str = "<div class=\"searchresultitem-item searchresultitem-item-searched\"><div onclick=\"window.open('%s', '%s');\">%s<span class=\"float-right probootstrap_text-gray-500\">%s %s</span></div></div>";

        $datas_rs = "";
        if (count($datas) > 0) {

            $datas_rs .= "<div class=\"searchresultitem-title\">검색결과</div><div class=\"searchresultitem-items searchresultitem-items-searched\">";

            foreach ($datas as $key => $value) {

                $name = $value->name;
                $name = str_replace($request->input('query'), "<b>" . $request->input('query') . "</b>", $name);
                $sido = $value->sido;
                $sido = str_replace($request->input('query'), "<b>" . $request->input('query') . "</b>", $sido);
                $sigungu = $value->sigungu;
                $sigungu = str_replace($request->input('query'), "<b>" . $request->input('query') . "</b>", $sigungu);

                if (is_numeric($value->url)) {
                    $url = "https://www.mo-zip.co.kr/detail?id=" . $value->url;
                    $target = "_self";
                } else {
                    $url = "http://" . $value->url;
                    $target = "_blank";
                }

                $datas_rs .= sprintf($str,
                    $url, $target, $name, $sido, $sigungu
                );
            }

            $datas_rs .= "</div>";
        } else {
            $datas_rs = "검색 결과가 없습니다.";
        }

        return response()->json(['datas' => $datas_rs]);
    }

    public function userinfosave(Request $request){
      $result = DB::table('user')
        ->where('id',Auth::user()->id)
        ->update([
          'email' => $request->input('email'),
          'contact' => $request->input('contact')
        ]);
      return response()->json(['result' => $result]);
    }


}
