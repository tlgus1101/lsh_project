<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $datas = DB::table('question')
            ->where('user_id', Auth::user()->id)
            ->get();

        if ($request->input("json") == "true") {
            $str = "
  <div class=\"row mb-3\">
    <div class=\"col-md-12\">
      <div class=\"question-media\" data-toggle=\"collapse\" href=\"#collapse%s\" role=\"button\"
           aria-expanded=\"false\" aria-controls=\"collapse%s\">
        <div class=\"w-100\">
          <span class=\"question-title float-left\"> %s</span> <span class=\"badge badge-pill badge-dark mb-1 float-right\">%s</span>
        </div>
        <div class=\"clear-both\"><span class=\"question-contents\">%s</span></div>
        <div class=\"question-info\">
          <span class=\"question-date float-left\">%s</span>
          <span class=\"question-state float-right collapseState\"><i class=\"ion-chevron-down\"></i></span>
        </div>
        <div class=\"collapse clear-both\" id=\"collapse%s\">
          <div class=\"p-2 bg-light\">
              %s
          </div>
        </div>
      </div>
    </div>
  </div>";

            $datas_ms = "";
            if (count($datas) > 0) {
                $i = 0;
                foreach ($datas as $key => $value) {
                    $datas_answer_ms = "";
                    if ($value->question_answer_whether == "답변완료") {
                        $datas_answer_ms = "";
                        $datas_answer = DB::table('question_answer')
                            ->where('question_idx', $value->question_idx)
                            ->orderBy('question_answer_enrollment_date', 'desc')
                            ->get();

                        foreach ($datas_answer as $key => $answer) {
                            $datas_answer_ms .= sprintf("<span class=\"question-contents\">[ 답변 ]</span><br>
                                <span class=\"question-contents\">%s</span><br><span class=\"question-date\">%s</span>",
                                $answer->question_answer_contents
                                , date("Y년m월d일 h시", strtotime($answer->question_answer_enrollment_date))
                            );
                        }
                    }
                    $datas_ms .= sprintf($str
                        , $i
                        , $i
                        , $value->question_type
                        , $value->question_answer_whether
                        , $value->question_contents
                        , date("Y년m월d일 h시", strtotime($value->question_enrollment_date))
                        , $i
                        , $datas_answer_ms
                    );

                    $i++;
                }
            } else {
                $datas_ms = "   <div class=\"container\">
              <div class=\"reserve_none\">
                  <i>&nbsp;</i>
                  <b>등록된 1:1 문의가 없습니다.</b>
                    모집은 회원님들의 소중한 의견에 귀 기울여 신속하고 정확하게 답변드리도록 하겠습니다.
              </div>
          </div>";
            }
            return response()->json(['datas' => $datas_ms]);
        }
        return view('my.question');
    }

    function store(Request $request)
    {
        $result = DB::table('question')
            ->insert([
                'question_category_type' => $request->input('question_category_type'),
                'question_type' => $request->input('question_type'),
                'question_contents' => $request->input('question_contents'),
                'question_enrollment_date' => now(),
                'question_answer_whether' => "문의등록",
                'user_id' => Auth::user()->id,
            ]);
        return response()->json(['result' => $result]);
    }
}
