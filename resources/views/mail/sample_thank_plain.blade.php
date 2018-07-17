{{--
$templateはMailTemplateモデル
$dataはSampleモデル
--}}
{{$template->header}}


準備が完了次第、以下の住所にサンプルを発送いたします。


お名前
{{$data->name}} 様

おなまえ(フリガナ)
{{$data->name_kana}} 様

ご住所
〒{{$data->zip_code}}
{{config('pref')[$data->pref_id]}}{{$data->address1}}
{{$data->address2}}

携帯電話番号
@if($data->tel !== '')
{{$data->tel}}
@else
記入なし
@endif

自宅電話番号
@if($data->fax !== '')
{{$data->fax}}
@else
記入なし
@endif

備考
@if(preg_replace("/( |　)/", "", $data->remarks) !== '')
{{$data->remarks}}
@else
記入なし
@endif

{{$template->footer}}