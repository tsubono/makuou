{{--
$templateはMailTemplateモデル
$dataはContactモデル
--}}
{{$template->header}}


お名前
{{$data->name}}  様

おなまえ(フリガナ)
{{$data->name_kana}}  様

メールアドレス
{{$data->email}}

お問い合わせ内容
{{$data->content}}

{{$template->footer}}