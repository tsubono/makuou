{{--
$templateはMailTemplateモデル
$dataはUserモデル
--}}
{{$template->header}}


[登録情報]

お名前
{{$data->name}} 様

メールアドレス
{{$data->email}}

携帯電話番号
@if($data->tel) !== '')
{{$data->tel}}
@else
    記入なし
@endif

自宅電話番号
@if( $data->fax) !== '')
{{$data->fax}}
@else
    記入なし
@endif

ご住所
〒{{$data->zip_code}}
{{config('pref')[$data->pref_id]}}{{$data->address1}}
{{$data->address2}}


{{$template->footer}}