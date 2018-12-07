<?php
namespace App\Modules\Frontend\Controllers\Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Modules\Frontend\Services\SocialAccountService;
use Illuminate\Support\Facades\Log;
use Socialite;
use App\User;
use App\Modules\Frontend\Controllers\Controller;
class SocialAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->user(), $social);
        auth()->login($user);

        return redirect()->to('/');
    }
}