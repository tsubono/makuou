<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{

    protected $redirect = '/contact';

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
            'nameKana' => ['required', 'regex:/[ァ-ヶ]/u'],
            'email' => 'required|email|max:255',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須項目です',
            'email' => 'メールアドレスとして正しくありません',
            'email.max' => 'メールアドレスを255文字以内で入力してください。',
            'regex' => ':attributeとして正しくありません',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'nameKana' => 'フリガナ',
            'email' => 'メールアドレス',
            'content' => 'お問い合わせ内容',
        ];
    }

}
