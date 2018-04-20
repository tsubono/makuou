<?php

namespace App\Http\Controllers\Admin;

use App\Models\CustomerAgreement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerAgreementController extends Controller
{
    private $customerAgreement;

    public function __construct(CustomerAgreement $customerAgreement)
    {
        $this->customerAgreement = $customerAgreement;
    }

    /**
     * 利用規約表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customer_agreement = $this->customerAgreement->first();

        return view('admin.customer_agreement.index', compact('customer_agreement'));
    }

    /**
     * 利用規約新規作成表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * 利用規約新規作成
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 利用規約詳細
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
     * 利用規約編集表示
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
     * 利用規約編集
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $customer_agreement = $this->customerAgreement->findOrFail($id);
        $customer_agreement->update($request->input('customer_agreement'));

        return redirect()->route('admin.customer-agreement.index')->with('success', '利用規約を更新しました。');
    }

    /**
     * 利用規約削除
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
    }

}
