<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tradelaw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TradelawController extends Controller
{
    private $tradelaw;

    public function __construct(Tradelaw $tradelaw)
    {
        $this->tradelaw = $tradelaw;
    }

    /**
     * 特定商取引法表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tradelaw = $this->tradelaw->first();

        return view('admin.tradelaw.index', compact('tradelaw'));
    }

    /**
     * 特定商取引法新規作成表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * 特定商取引法新規作成
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 特定商取引法詳細
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
     * 特定商取引法編集表示
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
     * 特定商取引法編集
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $tradelaw = $this->tradelaw->findOrFail($id);
        $validator = Validator::make($request->input('tradelaw'), $this->getRules($tradelaw->id), $this->getMessages());

        if ($validator->fails()) {
            return redirect()->route('admin.tradelaw.index')
                ->withErrors($validator)
                ->withInput();
        }

        $update = $this->getDataForDB($request);

        $tradelaw->update($update);

        return redirect()->route('admin.tradelaw.index')->with('success', '特定商取引法を更新しました。');
    }

    /**
     * 特定商取引法削除
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
        $res = $request->input('tradelaw');

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
            'zip01' => 'digits:3',
            'zip02' => 'digits:4',
            'email' => [
                'required',
                'email',
                'max:255',
            ]
        ];
    }

    private function getMessages()
    {
        return [
            'zip01.digits' => '3文字で入力してください。',
            'zip02.digits' => '4文字で入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスを正しく入力してください。',
            'email.max' => 'メールアドレスを255文字以内で入力してください。'
        ];
    }
}
