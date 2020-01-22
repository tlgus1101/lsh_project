<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $name  = $request->input('name');
        $email = $request->input('email');
        $pass  = $request->input('password');
        $allow = $request->input('agree');

        if ($validator->passes()) {
            DB::table('user')
                ->insert([
                    'name'  => $name,
                    'email' => $email,
                    'password' => Hash::make($pass),
                    'route' => 'mozip',
                    'state' => '정상',
                    'allow' => $allow,
                    'regist_at' => now(),
                    'update_at' => now(),
                ]);

            if (Auth::attempt([
                'email' => $email,
                'password' => $pass])
            ) {
                return response()->json(array(
                    'status' => 'OK'), 200);
            }
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }
}
