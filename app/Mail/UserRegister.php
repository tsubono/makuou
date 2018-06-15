<?php

namespace App\Mail;

use App\Models\MailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegister extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param MailTemplate $template
     * @param Model $data
     * @param string $viewName
     */
    public function __construct(Model $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('ご登録ありがとうございます')
            ->from(env('MAIL_FROM', 'tsubono@ga-design.jp'), '幕王')
            ->text('mail.register_thank_plain');
    }
}
