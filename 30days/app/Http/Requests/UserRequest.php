<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
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
            'name' => ['required', 'max:100'],
            'introduction' => ['max:1000'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'ユーザーネーム',
            'introduction' => '自己紹介',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ":attributeを入力してください",
            'name.max' => ":attributeは100文字以内で入力してください",
            'introduction.max' => ':attributeは1000文字以内で入力してください',
        ];
    }
}
