<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Socialite;

class AuthController extends Controller
{
    public function SocialSignup($provider)
    {
        // Socialite will pick response data automatic 
        $user = Socialite::driver($provider)->stateless()->user();
 
        return response()->json($user);
    }
}
