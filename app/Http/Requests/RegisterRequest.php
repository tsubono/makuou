<?php

namespace App\Http\Requests;

use App\Rules\TelRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    protected $redirect = '/register';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'regex:/^[ぁ-んァ-ヶー一-龠]+$/'],
            'nameKana' => ['required', 'regex:/^[あ-ん゛゜ぁ-ぉゃ-ょー「」、]+/'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->whereNull('deleted_at')],
            'mobile' => new TelRule(),
            'tel' => new TelRule(),
            'zipCodeOne' => 'required|digits:3',
            'zipCodeTwo' => 'required|digits:4',
            'prefecture' => 'required|integer|between:1,48',
            'addressOne' => 'required',
            'addressTwo' => '',
            'password' => ['required', 'min:6','regex:/^\S*$/'],
        ];
    }

    //携帯電話番号,自宅電話番号をそれぞれまとめてバリデーションにかけるため、一まとまりの配列を作成
    //実際のバリデーションは$this->rules()の new TelRule()
    protected function validationData()
    {
        return array_merge($this->all(), [
            'mobile' => [
                $this->input('mobileOne', ''),
                $this->input('mobileTwo', ''),
                $this->input('mobileThree', ''),
            ],
            'tel' => [
                $this->input('telOne', ''),
                $this->input('telTwo', ''),
                $this->input('telThree', ''),
            ]
        ]);
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須項目です。',
            'email' => 'メールアドレスとして正しくありません。',
            'email.max' => 'メールアドレスを255文字以内で入力してください。',
            'email.unique' => '既に使用されているメールアドレスです。',
            'regex' => ':attributeとして正しくありません。',
            'integer' => ':attributeを選択して下さい。',
            'between' => ':attributeとして正しくありません。',
            'digits' => ':attributeとして正しくありません。',
            'password.min' => 'パスワードを6文字以上で入力して下さい。'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'nameKana' => 'ふりがな',
            'email' => 'メールアドレス',
            'zipCodeOne' => '郵便番号',
            'zipCodeTwo' => '郵便番号',
            'prefecture' => '都道府県',
            'addressOne' => '住所1（市町村名・番地）',
            'addressTwo' => '住所2（建物名・マンション名）',
            'password' => 'パスワード',
        ];
    }
}
