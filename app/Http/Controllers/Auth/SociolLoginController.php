<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class SociolLoginController extends Controller
{


    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

     $provider_user = Socialite::driver($provider)->stateless()->user();

   $user = User::where([
    'provider' => $provider,
    'provider_id' => $provider_user->id,

   ])->first();

   if (! $user) {
    $user = User::create([
        'name' => $provider_user->getName(),
        'email' => $provider_user->getEmail(),
        'provider' => $provider,
        'provider_id' => $provider_user->getId(),
        'password' => Hash::make(Str::random(8)),
        'provider_token' => $provider_user->token,
    ]);

    }

    auth()->login($user, true);
    return redirect()->route('home');
}
}
