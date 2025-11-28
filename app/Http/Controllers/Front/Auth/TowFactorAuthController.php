<?php

namespace App\Http\Controllers\Front\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TowFactorAuthController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('front.auth.tow-factor-auth' ,compact('user'));
    }
}
