<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\UserRegister;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('front.register.index');
    }

    public function confirm(RegisterRequest $request)
    {
        $userData = [
            'name' => $request->input('name'),
            'nameKana' => $request->input('nameKana'),
            'email' => $request->input('email'),
            'mobileOne' => $request->input('mobileOne'),
            'mobileTwo' => $request->input('mobileTwo'),
            'mobileThree' => $request->input('mobileThree'),
            'telOne' => $request->input('telOne'),
            'telTwo' => $request->input('telTwo'),
            'telThree' => $request->input('telThree'),
            'zipCodeOne' => $request->input('zipCodeOne'),
            'zipCodeTwo' => $request->input('zipCodeTwo'),
            'prefecture' => $request->input('prefecture'),
            'addressOne' => $request->input('addressOne'),
            'addressTwo' => $request->input('addressTwo'),
            'password' => $request->input('password')
        ];
        return view('front.register.confirm')
            ->with('data', $userData);

    }

    public function store(RegisterRequest $request)
    {

        if ($request->session()->has('status') &&
            $request->session()->get('status') === 'register') {
            if ($request->input('submit', 0) === '1') {

                DB::beginTransaction();
                try {

                    $user = new User();
                    $user->name = $request->input('name');
                    $user->name_kana = $request->input('nameKana');
                    $user->email = $request->input('email');
                    $user->tel = $request->input('mobileOne') . $request->input('mobileTwo') . $request->input('mobileThree');
                    $user->fax = $request->input('telOne') . $request->input('telTwo') . $request->input('telThree');
                    $user->zip_code = $request->input('zipCodeOne') . $request->input('zipCodeTwo');
                    $user->pref_id = $request->input('prefecture');
                    $user->address1 = $request->input('addressOne');
                    $user->address2 = $request->input('addressTwo');
                    $user->password = $request->input('password');
                    $user->save();

                    //ログインは会員様が各自で行う
//                    Auth::guard('user')->login($user);

                    Mail::to($user->email)
                        ->queue(new UserRegister($user));

                    $request->session()->regenerateToken();
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    info($e);
                    return redirect('/register')->withInput()
                        ->withErrors(
                            ['exception' => '大変申し訳ございません。内部エラーが発生しました。お手数ですが初めからやり直して下さい']
                        );
                }
                return redirect('/');
            }
            return redirect('/register')->withInput();
        }
        return redirect('/register');
    }

}
