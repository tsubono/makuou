<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    protected function guard()
    {
        return Auth::guard('user');
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return view('front.logout');
    }
}
