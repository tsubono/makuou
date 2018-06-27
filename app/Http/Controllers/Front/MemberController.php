<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index(Request $request){

        //トークン生成
        $length = 78;
        $token = bin2hex(random_bytes($length));
        $request->session()->put('member_token', $token);
        $user = Auth::user();
        return view('front.member.index')
            ->with([
                'user'=>$user,
                'token'=>$token
                ]);
    }

    public function confirm(MemberRequest $request){

        //indexから遷移したかどうか
        $token = $request->input('member_token','');
        if($token !== $request->session()->pull('member_token')){
            return redirect('/member');
        }else{
            //トークン生成
            $length = 78;
            $token = bin2hex(random_bytes($length));
            $request->session()->put('member_confirm_token', $token);
            return view('front.member.confirm')
                ->with([
                    'data'=>$request->all(),
                    'token'=>$token
                ]);
        }
    }

    public function store(Request $request){
        //indexから遷移したかどうか
        $token = $request->input('member_confirm_token','');
        if($token !== $request->session()->pull('member_confirm_token')){
            return redirect('/member');
        }else{

                //完了ボタン押下時
                if ($request->input('submit', 0) === '1') {

                    DB::beginTransaction();
                    try {
                        $user = Auth::user();
                        $user->name = $request->input('name');
                        $user->name_kana = $request->input('nameKana');
                        $user->email = $request->input('email');
                        if ($request->input('mobileOne') &&
                            $request->input('mobileTwo') &&
                            $request->input('mobileThree')) {
                            $user->tel = $request->input('mobileOne') . '-' . $request->input('mobileTwo') . '-' . $request->input('mobileThree');
                        }else{
                            $user->tel = null;
                        }
                        if ($request->input('telOne') &&
                            $request->input('telTwo') &&
                            $request->input('telThree')) {
                            $user->fax = $request->input('telOne') . '-' . $request->input('telTwo') . '-' . $request->input('telThree');
                        }else{
                            $user->fax = null;
                        }
                        $user->zip_code = $request->input('zipCodeOne') . '-' . $request->input('zipCodeTwo');
                        $user->pref_id = $request->input('prefecture');
                        $user->address1 = $request->input('addressOne',null);
                        $user->address2 = $request->input('addressTwo',null);
                        $user->password = bcrypt($request->input('password'));
                        $user->save();

                        //2重送信防止
                        $request->session()->regenerateToken();
                        DB::commit();
                    } catch (\Exception $e) {
                        //エラー発生時はDBをロールバックして入力画面へリダイレクト
                        DB::rollBack();
                        return redirect('/member')->withInput()
                            ->withErrors(
                                ['exception' => '大変申し訳ございません。内部エラーが発生しました。お手数ですが初めからやり直して下さい']
                            );
                    }
                    return view('front.member.thanks');
                }else{
                    //戻るボタン押下時
                    return redirect('/member')->withInput();
                }
        }
    }

}
