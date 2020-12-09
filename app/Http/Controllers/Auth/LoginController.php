<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Twitter認証へリダイレクトする
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToTwitterProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Twitter認証リダイレクトCallback
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleTwitterProviderCallback(){

        try {
            $user = Socialite::with("twitter")->user();
        }
        catch (\Exception $e) {
            return redirect('/login')->with('error-message', 'ログインに失敗しました');
        }

        $registerUser = User::firstOrCreate(
            [
                'twitter_token' => $user->token
            ],
            [
                'twitter_token' => $user->token,
                'name' => $user->nickname,
                'handle_name' => $user->name,
                'avatar_path' => $user->avatar_original,
                'background_path' => $user['profile_banner_url'],
                'introduction' => $user['description'],
                'email' => $user->email,
                'twitter_url' => "https://twitter.com/{$user->nickname}",
            ]
        );
        Auth::login($registerUser);

        return redirect()->to('/mypage/profile');
    }

    /**
     * ログアウト後の遷移先を指定
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function loggedOut()
    {
        return redirect(route('login'));
    }
}
