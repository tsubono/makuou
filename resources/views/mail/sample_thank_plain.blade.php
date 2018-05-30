{{--
$templateはMailTemplateモデル
$dataはSampleモデル
--}}
{{$template->header}}


準備が完了次第、以下の住所にサンプルを発送いたします。


{{$data->name}} 様

〒{{$data->zip_code}}
{{config('pref')[$data->pref_id]}}{{$data->address1}}
{{$data->address2}}

備考
@if(preg_replace("/( |　)/", "", $data->remarks) !== '')
    {{$data->remarks}}
@else
    記入なし
@endif

{{$template->footer}}