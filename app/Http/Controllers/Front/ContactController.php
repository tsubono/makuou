<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\Thanks;
use App\Models\Contact;
use App\Models\MailTemplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
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
        return view('front.contact.index');
    }

    public function confirm(ContactRequest $request)
    {

        return view('front.contact.confirm')
            ->with('data', $request->all([
                'name',
                'nameKana',
                'email',
                'content',
            ]));

    }

    public function store(ContactRequest $request)
    {

        if ($request->session()->has('status') &&
            $request->session()->get('status') === 'contact') {
            if ($request->input('submit', 0) === '1') {

                DB::beginTransaction();
                try {
                    $contact = new Contact();
                    $contact->name = $request->input('name');
                    $contact->name_kana = $request->input('nameKana');
                    $contact->email = $request->input('email');
                    $contact->content = $request->input('content');
                    $contact->save();

                    $template = MailTemplate::find(2);
                    Mail::to($contact->email)
                        ->queue(new Thanks($template,$contact,'mail.contact_thank_plain'));

                    $request->session()->regenerateToken();
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    info($e);
                    return redirect('/contact')->withInput()
                        ->withErrors(
                            ['exception' => '大変申し訳ございません。内部エラーが発生しました。お手数ですが初めからやり直して下さい']
                        );
                }
                return view('front.contact.thanks');
            }
            return redirect('/contact')->withInput();
        }
        return redirect('/contact');
    }
}
