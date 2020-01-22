<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        return view('my.information');
    }

    public function show(Request $request)
    {
        if (Hash::check($request->input('password'), Auth::user()->password) || $request->input('confirm') == "ok") {
            $datas_rs = "";
            $str = '
        <div class="container">
            <div class="row join-row">
                <div class="col-md-12" style="z-index:9">
                    <form class="probootstrap-form probootstrap-form-box mb60 text-center">
                        <h4 class="mb-5">정보 변경</h4>
                        <div class="form-group">
                            <label for="name" class="sr-only sr-only-focusable">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="이름"
                                   value="%s" disabled>
                            <span id="name_text" class="login-info-text"></span>
                        </div>
              
                        %s
                        <div class="form-group">
                            <label for="email" class="sr-only sr-only-focusable">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="이메일 주소"
                                   value="%s" disabled>
                            <span id="email_text" class="login-info-text"></span>
                        </div>
                        <div class="form-group" id="pwupdate"> 
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" 
                                       placeholder="비밀번호" disabled>
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary input-group-btn" onclick="passwdupdate()" type="button">수정하기</button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <a class="leave-btn" onclick="openLeaveModal()">회원탈퇴</a>
                    </form>
                </div>
                
            </div>
        </div>
        ';

            $con_com = "";

            if (Auth::user()->contact == null) {
                $con_com = "<div class=\"form-group\"> 
                                <div class=\"input-group mb-3\">
                                    <input type=\"text\" class=\"form-control\" id=\"contact\"
                                       name=\"contact\" placeholder=\"휴대전화번호\"
                                       aria-label=\"휴대전화번호\" onkeypress='inputPhoneNumber(this)' 
                                       aria-describedby=\"basic-addon2\">
                                    <div class=\"input-group-append\">
                                        <button class=\"btn btn-secondary input-group-btn\" onclick='CertificationNumber()'  type=\"button\">인증번호 발송</button>
                                    </div>
                                </div>
                            </div><div class=\"form-group\" id='ct_confirm'></div>";
            } else {
                $con_com = "<div class=\"form-group\" id='contact_confirm'> 
                                <div class=\"input-group mb-3\">
                                    <input type=\"text\" class=\"form-control\" id=\"contact\"
                                       name=\"contact\" placeholder=\"휴대전화번호\"value='" . Auth::user()->contact . "'
                                     disabled >
                                    <div class=\"input-group-append\">
                                        <button class=\"btn btn-secondary input-group-btn\" onclick='contactupdate()' type=\"button\">수정하기</button>
                                    </div>
                                </div>
                            </div>";
            }

            $datas_rs .= sprintf($str,
                Auth::user()->name
                , $con_com
                , Auth::user()->email
            );
            return response()->json(array('result' => 1, 'datas' => $datas_rs), 200);
        }
        return response()->json(array('result' => 0), 200);
    }

    function update(Request $request)
    {
        if ($request->input("type") == "password") {
            if (Hash::check($request->input("old_password"), Auth::user()->password)) {
                $result = DB::table('user')
                    ->where('id', Auth::user()->id)
                    ->update([
                        'password' => Hash::make($request->input('password')),
                        'update_at' => now()
                    ]);
                return response()->json(array('result' => $result, 'data' => "비밀번호 수정"), 200);
            } else {
                return response()->json(array('result' => 0, 'data' => "비밀번호가 틀렸습니다."), 200);
            }
        } else {
            $result = DB::table('user')
                ->where('id', Auth::user()->id)
                ->update([
                    'contact' => $request->input("contact"),
                    'update_at' => now()
                ]);
            if ($result == 1) {
                return response()->json(array('result' => $result, 'data' => "전화번호 수정 성공"), 200);
            } else {
                return response()->json(array('result' => 0, 'data' => "전화번호 수정 실패"), 200);
            }
        }
    }

    function delete(Request $request)
    {
        if (Hash::check($request->input("password"), Auth::user()->password)) {
            $result = DB::table('user')
                ->where('id', Auth::user()->id)
                ->update([
                    'state' => '탈퇴',
                    'update_at' => now()
                ]);
            return response()->json(array('result' => $result), 200);
        } else {
            return response()->json(array('result' => 0), 200);
        }
    }

    public function contactcheck(Request $request)
    {
        $number = DB::table('user')
            ->where('id', Auth::user()->id)
            ->first();
        if($number->authentication_number == $request->input('contact_confirm')){
            DB::table('user')
                ->where('id', Auth::user()->id)
                ->update([
                    'authentication' => 'true',
                    'contact' => $request->input('contact')
                ]);
            return response()->json(array('result' => 1), 200);
        }else{
            return response()->json(array('result' => 0), 200);
        }
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
                , 'DEST_INFO' => Auth::user()->name . "^" . $request->input('contact')
            ]);

        DB::table('user')
            ->where('id', Auth::user()->id)
            ->update([
                'authentication_number' => $rand,
            ]);

        return response()->json(array('result' => $result), 200);
    }

}
