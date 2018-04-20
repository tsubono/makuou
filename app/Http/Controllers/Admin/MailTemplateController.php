<?php

namespace App\Http\Controllers\Admin;

use App\Models\MailTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MailTemplateController extends Controller
{
    private $mailTemplate;

    public function __construct(MailTemplate $mailTemplate)
    {
        $this->mailTemplate = $mailTemplate;
    }

    /**
     * メールテンプレート表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mail_templates = $this->mailTemplate->orderBy('created_at', 'desc')->get();

        $id = session('id', 0);
        $request->session()->forget('id');

        return view('admin.mail_templates.index', compact('mail_templates', 'id'));
    }

    /**
     * メールテンプレート新規作成表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * メールテンプレート新規作成
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * メールテンプレート詳細
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
     * メールテンプレート編集表示
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
     * メールテンプレート編集
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $mail_template = $this->mailTemplate->findOrFail($id);
        $mail_template->update($request->input('mail_template'));

        session(['id' => $id]);
        return redirect()->route('admin.mail-templates.index')->with('success', 'メールテンプレートを更新しました。');
    }

    /**
     * メールテンプレート削除
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
    }

    /*
     * メールテンプレート情報取得
     */
    public function ajaxLoadData(Request $request) {
        $mail_template = $this->mailTemplate->findOrFail($request->get('id'));
        echo json_encode($mail_template);
    }
}
