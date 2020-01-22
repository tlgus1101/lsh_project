<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class VerifyController extends Controller
{
    public function index()
    {
        return view('auth.verify');
    }

    public function send(Request $request) {

        $email = $request->input('email');
        $name = DB::table('user')
            ->where('email', '=', $email)
            ->value('name');

        if ($name) {

            $ran_str  = Str::random(10);
            $now_time = strtotime(date('Y-m-d H:i:s'));
            $pw_token = $ran_str . $now_time;

            $data = array('token' => $pw_token);

            DB::table('user')
                ->where('email', '=', $email)
                ->update([
                    'password_token' => $pw_token,
                    'password_token_enrollment_date' => now()
                ]);

            $user = array(
                'email' => $email,
                'name' => $name
            );

            Mail::send('emails.verify', $data, function($message) use ($user) {



                $message->from('mozip@blueweb.co.kr', '모집');
                $message->to($user['email'], $user['name'])->subject('[모집] 비밀번호 재설정 URL입니다.');
            });

            return response()->json(['datas' => 'ok']);
        } else {
            return response()->json(['datas' => 'none']);
        }
    }
}