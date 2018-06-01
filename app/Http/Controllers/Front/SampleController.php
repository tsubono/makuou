<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\SampleRequest;
use App\Mail\Thanks;
use App\Models\MailTemplate;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.sample.index');
    }

    public function confirm(SampleRequest $request)
    {

        //input要素から受け取ったデータをconfirmページへ受け流す
        return view('front.sample.confirm')
            ->with('data', $request->only([
                'name',
                'nameKana',
                'email',
                'mobileOne',
                'mobileTwo',
                'mobileThree',
                'telOne',
                'telTwo',
                'telThree',
                'zipCodeOne',
                'zipCodeTwo',
                'prefecture',
                'addressOne',
                'addressTwo',
                'remarks'
            ]));

    }

    public function store(SampleRequest $request)
    {

        //confirmページからの繊維であれば処理を開始
        if ($request->session()->has('status') &&
            $request->session()->get('status') === 'sample') {
            //完了ボタン押下時
            if ($request->input('submit', 0) === '1') {

                DB::beginTransaction();
                try {
                    $sample = new Sample();
                    $sample->name = $request->input('name');
                    $sample->name_kana = $request->input('nameKana');
                    $sample->email = $request->input('email');
                    $sample->tel = $request->input('mobileOne') . $request->input('mobileTwo') . $request->input('mobileThree');
                    $sample->fax = $request->input('telOne') . $request->input('telTwo') . $request->input('telThree');
                    $sample->zip_code = $request->input('zipCodeOne') . $request->input('zipCodeTwo');
                    $sample->pref_id = $request->input('prefecture');
                    $sample->address1 = $request->input('addressOne');
                    $sample->address2 = $request->input('addressTwo');
                    $sample->remarks = $request->input('remarks');
                    $sample->save();

                    $template = MailTemplate::find(1);
                    Mail::to($sample->email)
                        ->queue(new Thanks($template, $sample, 'mail.sample_thank_plain'));

                    //2重送信防止
                    $request->session()->regenerateToken();
                    DB::commit();
                } catch (\Exception $e) {
                    //エラー発生時はDBをロールバックして入力画面へリダイレクト
                    DB::rollBack();
                    return redirect('/sample')->withInput()
                        ->withErrors(
                            ['exception' => '大変申し訳ございません。内部エラーが発生しました。お手数ですが初めからやり直して下さい']
                        );
                }
                return view('front.sample.thanks');
            }
            //戻るボタン押下時
            return redirect('/sample')->withInput();
        }
        //不正な遷移
        return redirect('/sample');
    }
}
