<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    // LoginControllerではAuthenticatesUsersトレイトをuseしており、そこでuseされているThrottlesLoginsトレイトに、ログインロック機能が実装されています。
    protected $maxAttempts = 2;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/todo';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // logoutはログイン中の’guest’ミドルウェアからは除きますよ、って定義をしてあるようだ。だからログイン中にログアウトできるということ
        // guestのミドルウェアをコンストラクタで使用することにより、ログアウト(getLogout)以外のメソッド、つまり会員登録（getRegisterとpostRegister）とログイン（getLoginとpostLogin)のメソッドにおいて、すでにログインしているなら/homeにリダイレクトします。
        $this->middleware('guest')->except('logout');
    }

    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
}
