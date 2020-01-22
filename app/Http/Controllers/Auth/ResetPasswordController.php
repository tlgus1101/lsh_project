<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ReSetPasswordController extends Controller
{
    public function index(Request $request)
    {
      $data = DB::table('user')
        ->where('password_token',$request->input('token'))
        ->first();

      if(strtotime(date('y-m-d h:i:s')) - strtotime($data->password_token_enrollment_date) > 1800){
        echo "<script> alert('잘못된 접근입니다.'); </script>";
        return redirect('/verify');
      }
        return view('auth.passwords.reset',['data' => $data]);
    }

    public function update(Request $request)
    {
      $result= DB::table('user')
        ->where('password_token',$request->input('token'))
        ->update([
          'password' => Hash::make($request->input('password'))
          ]);
      return redirect('/login');
    }
}
