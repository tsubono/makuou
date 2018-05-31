<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TelRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $one = preg_replace("/( |　)/", "", $value[0]);
        $two = preg_replace("/( |　)/", "", $value[1]);
        $three = preg_replace("/( |　)/", "", $value[2]);
        //全て空ならバリデーションにかけない
        if ($one === '' && $two === '' && $three === '') {
            return true;
        } else if ($one !== '' && $two !== '' && $three !== '') {
            //各input要素からの値が正しいかどうか
            if (preg_match('/^0\d{1,3}$/', $one) &&
                preg_match('/^\d{1,4}$/', $two) &&
                preg_match('/^\d{3,4}$/', $three)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '正しく入力して下さい';
    }
}
