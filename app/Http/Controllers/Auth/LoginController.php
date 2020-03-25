<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// https://qiita.com/washio12/items/59f5cde23b4205973c6b
// vendor/laravel/framework/src/Illuminate/Fundation/Auth/AuthenticatesUsers.phpが実際の表記
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

    // 何故treitを見に行くのか
    // メソッドを探す順序
    use AuthenticatesUsers;

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
        $this->middleware('guest')->except('logout');
    }

    protected function loggedOut(Request $request)
    {
        // dd(redirect('/login'));
        // RedirectResponseインスタンス
        return redirect('/login');
    }
}
