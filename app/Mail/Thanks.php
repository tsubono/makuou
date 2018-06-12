<?php

namespace App\Mail;

use App\Models\MailTemplate;
use App\Models\Shop;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Thanks extends Mailable
{
    use Queueable, SerializesModels;

    public $template;
    public $data;
    private $viewName;

    /**
     * Create a new message instance.
     *
     * @param MailTemplate $template
     * @param Model $data
     * @param string $viewName
     */
    public function __construct(MailTemplate $template, Model $data, string $viewName)
    {
        $this->template = $template;
        $this->data = $data;
        $this->viewName = $viewName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = Shop::find(1)->email_from;
        return $this->subject($this->template->title)
            ->from(env('MAIL_FROM','tsubono@ga-design.jp'),'幕王')
            ->text($this->viewName);
    }
}
