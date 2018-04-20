<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ShopController extends Controller
{
    private $shop;

    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }

    /**
     * ショップ情報表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shop = $this->shop->first();

        return view('admin.shop.index', compact('shop'));
    }

    /**
     * ショップ情報新規作成表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * ショップ情報新規作成
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * ショップ情報詳細
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //
    }

    /**
     * ショップ情報編集表示
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //
    }

    /**
     * ショップ情報編集
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $shop = $this->shop->findOrFail($id);
        $validator = Validator::make($request->input('shop'), $this->getRules($shop->id), $this->getMessages());

        if ($validator->fails()) {
            return redirect()->route('admin.shop.index')
                ->withErrors($validator)
                ->withInput();
        }

        $update = $this->getDataForDB($request);

        $shop->update($update);

        return redirect()->route('admin.shop.index')->with('success', 'ショップ情報を更新しました。');
    }

    /**
     * ショップ情報削除
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
    }

    /**
     * DB保存用データを返す
     *
     * @param  \Illuminate\Http\Request $request
     * @return $res
     */
    protected function getDataForDB($request)
    {

        $res = $request->input('shop');

        // 郵便番号
        $res["zip_code"] = $res["zip01"] . "-" . $res["zip02"];
        // 電話番号
        $res["tel"] = $res["tel01"] . "-" . $res["tel02"] . "-" . $res["tel03"];
        // fax番号
        $res["fax"] = $res["fax01"] . "-" . $res["fax02"] . "-" . $res["fax03"];

        return $res;
    }

    private function getRules($ignoreId = null)
    {
        return [
            'company_name_kana' => 'regex:/[ァ-ヶ]/u',
            'shop_name_kana' => 'regex:/[ァ-ヶ]/u',
            'zip01' => 'digits:3',
            'zip02' => 'digits:4',
            'email_from' => [
                'required',
                'email',
                'max:255',
            ]
        ];
    }

    private function getMessages()
    {
        return [
            'company_name_kana.regex' => '全角カタカナで入力してください。',
            'shop_name_kana.regex' => '全角カタカナで入力してください。',
            'zip01.digits' => '3文字で入力してください。',
            'zip02.digits' => '4文字で入力してください。',
            'email_from.required' => 'メールアドレスを入力してください。',
            'email_from.email' => 'メールアドレスを正しく入力してください。',
            'email_from.max' => 'メールアドレスを255文字以内で入力してください。'
        ];
    }
}
