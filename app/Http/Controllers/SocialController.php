<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class SocialController extends Controller
{

    public function index($provider)
    {
        $user = auth()->user();

      $provider_user =  Socialite::driver($user->provider)->userFromToken($user->provider_token);

      dd($provider_user);
    }
}
