<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    private $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * 支払い方法ー一覧
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payments = $this->payment->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * 支払い方法新規作成表示
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * 支払い方法新規作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->payment->create($request->input('payment'));

        return redirect()->route('admin.payments.index')->with('success', '支払い方法を登録しました。');
    }

    /**
     * 親支払い方法詳細
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //
    }

    /**
     * 支払い方法編集表示
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //
    }

    /**
     * 支払い方法編集
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $payment = $this->payment->findOrFail($id);
        $payment->update($request->input('payment'));

        return redirect()->route('admin.payments.index')->with('success', '支払い方法を更新しました。');
    }

    /**
     * 支払い方法削除
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $payment = $this->payment->findOrFail($id);
        $payment->delete();

        return redirect()->route('admin.payments.index')->with('success', '支払い方法を削除しました。');
    }

}
