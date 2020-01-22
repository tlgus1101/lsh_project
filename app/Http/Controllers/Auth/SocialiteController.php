<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\SocialAccount;
use App\User;
use Illuminate\Auth\Events\Registered as RegisteredEvent;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return redirect('/login');
        }

        //DB::enableQueryLog();

        $existingUser = DB::table('user')
            ->where('email', '=', $user->email)
            ->where('route', '=', $provider)
            ->value('id');

        // 이미 가입 한 유저라면 로그인시킨다
        if ($existingUser) {

            if (Auth::loginUsingId($existingUser)) {
                return redirect()->intended('/');
            } else {
                return redirect('/login');
            }

            // 그렇지 않다면 소셜로그인으로 등록함
        } else {
            DB::table('user')
                ->insert([
                    'email'     => $user->email,
                    'name'      => $user->name,
                    'route'     => $provider,
                    'state'     => '정상',
                    'regist_at' => now(),
                    'update_at' => now()
                ]);

            if (Auth::loginUsingId($existingUser)) {
                return redirect()->intended('/');
            } else {
                return redirect('/login');
            }
        }

        return redirect()->to('/');
    }
}
