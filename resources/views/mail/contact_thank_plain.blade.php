{{--
$templateはMailTemplateモデル
$dataはContactモデル
--}}
{{$template->header}}


氏名
{{$data->name}}  様

メールアドレス
{{$data->email}}

お問い合わせ内容

{{$data->content}}

{{$template->footer}}